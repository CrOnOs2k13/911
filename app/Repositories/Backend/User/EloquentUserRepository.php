<?php namespace App\Repositories\Backend\User;

use App\User;
use App\productos;
use App\Repositories\Frontend\Auth\AuthenticationContract;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use App\Exceptions\Backend\Access\User\UserNeedsRolesException;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentUserRepository implements UserContract {
	use  SoftDeletes;

	/**
	 * @var RoleRepositoryContract
	 */
	protected $role;

	/**
	 * @var AuthenticationContract
	 */
	protected $auth;

	/**
	 * @param RoleRepositoryContract $role
	 * @param AuthenticationContract $auth
	 */
	public function __construct(RoleRepositoryContract $role, AuthenticationContract $auth) {
		$this->role = $role;
		$this->auth = $auth;
	}

	/**
	 * @param $id
	 * @param bool $withRoles
	 * @return mixed
	 * @throws GeneralException
	 */
	public function findOrThrowException($id, $withRoles = false) {
		if ($withRoles)
			$user = User::with('roles')->withTrashed()->find($id);
		else
			$user = User::withTrashed()->find($id);

		if (! is_null($user)) return $user;

		throw new GeneralException('Ese provedor no existe');
	}

	/**
	 * @param $per_page
	 * @param string $order_by
	 * @param string $sort
	 * @param int $status
	 * @return mixed
	 */
	public function getUsersPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc') {
		return User::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
	}

	/**
	 * @param $per_page
	 * @return \Illuminate\Pagination\Paginator
	 */
	public function getDeletedUsersPaginated($per_page) {
		return User::onlyTrashed()->paginate($per_page);
	}

	/**
	 * @param string $order_by
	 * @param string $sort
	 * @return mixed
	 */
	public function getAllUsers($order_by = 'id', $sort = 'asc') {
		return User::orderBy($order_by, $sort)->get();
	}

	/**
	 * @param $input
	 * @param $roles
	 * @param $permissions
	 * @return bool
	 * @throws GeneralException
	 * @throws UserNeedsRolesException
	 */
	public function create($input, $roles, $permissions) {
		$user = $this->createUserStub($input);
		$user->razon_social = $input['razon_social'];
		$user->encargado = $input['encargado'];
		if ($user->save()) {
			//User Created, Validate Roles
			$this->validateRoleAmount($user, $roles['assignees_roles']);

			//Attach new roles
			$user->attachRoles($roles['assignees_roles']);

			//Attach other permissions
			$user->attachPermissions($permissions['permission_user']);

			//Send confirmation email if requested
			if (isset($input['confirmation_email']) && $user->confirmed == 0)
				$this->auth->resendConfirmationEmail($user->id);

			return true;
		}

		throw new GeneralException('Se encontro un problema creando este provedor. Intente nuevamente.');
	}

	/**
	 * @param $id
	 * @param $input
	 * @param $roles
	 * @return bool
	 * @throws GeneralException
	 */
	public function update($id, $input, $roles, $permissions) {
		$user = $this->findOrThrowException($id);
		$this->checkUserByEmail($input, $user);

		if ($user->update($input)) {
			//For whatever reason this just wont work in the above call, so a second is needed for now
			$user->status = isset($input['status']) ? 1 : 0;
			$user->confirmed = isset($input['confirmed']) ? 1 : 0;
			$user->patrocinados = isset($input['patrocinados']) ? 1 : 0;
			$user->razon_social = $input['razon_social'];
			$user->encargado = $input['encargado'];

			//Cambiar el estado de patrocinio de todos los productos asociados a este provedor
			\App\productos::where('user_id',$user->id)->update(['patrocinado'=>$user->patrocinados]);
			$user->save();

			$this->checkUserRolesCount($roles);
			$this->flushRoles($roles, $user);
			$this->flushPermissions($permissions, $user);

			return true;
		}

		throw new GeneralException('Se encontro un problema actualizado este provedor. Intente nuevamente.');
	}

	/**
	 * @param $id
	 * @param $input
	 * @return bool
	 * @throws GeneralException
	 */
	public function updatePassword($id, $input) {
		$user = $this->findOrThrowException($id);

		//Passwords are hashed on the model
		$user->password = $input['password'];
		if ($user->save())
			return true;

		throw new GeneralException('Se encontro un problema actualizado la contraseña. Intente nuevamente');
	}

	/**
	 * @param $id
	 * @return bool
	 * @throws GeneralException
	 */
	public function destroy($id) {
		if (auth()->id() == $id)
			throw new GeneralException("No puedes borrarte tu mismo");

		$user = $this->findOrThrowException($id);
	//	dd($user->productos()->count());
			$fecha= \Carbon\Carbon::now();
			$productos =$user->productos()->get();
//			dd($productos);
			foreach ( $productos as $key ) {
				$key->delete();
			}
  		if ($user->delete())
			return true;
		throw new GeneralException("Se encontro un problema borrando este provedor. Intente nuevamente.");
	}

	/**
	 * @param $id
	 * @return boolean|null
	 * @throws GeneralException
	 */
	public function delete($id) {
		$user = $this->findOrThrowException($id, true);

		//Detach all roles & permissions
		$user->detachRoles($user->roles);
		$user->detachPermissions($user->permissions);

		try {
			$user->forceDelete();
		} catch (\Exception $e) {
			throw new GeneralException($e->getMessage());
		}
	}

	/**
	 * @param $id
	 * @return bool
	 * @throws GeneralException
	 */
	public function restore($id) {
		$user = $this->findOrThrowException($id);

		if ($user->restore())
		{
			$productos =\DB::table('productos')->where('user_id',$user->id)->whereNotNull('deleted_at')->get();
				//dd($productos);
			foreach ( $productos as $key ) {
				$producto= \App\productos::findOrFail($key->id);
				$producto->deleted_at=null;
				//dd($producto);
				$producto->save();
			}
		return true;
	  }

		throw new GeneralException("Se encontro un problema restaurando este provedor. Intente nuevamente.");
	}

	/**
	 * @param $id
	 * @param $status
	 * @return bool
	 * @throws GeneralException
	 */
	public function mark($id, $status) {
		if (auth()->id() == $id && ($status == 0 || $status == 2))
			throw new GeneralException("Imposible completar la operacion.");

		$user = $this->findOrThrowException($id);
		$user->status = $status;

		if ($user->save())
			return true;

		throw new GeneralException("Se encontro un problema actualizado este provedor. Intente nuevamente.");
	}

	/**
	 * Check to make sure at lease one role is being applied or deactivate user
	 * @param $user
	 * @param $roles
	 * @throws UserNeedsRolesException
	 */
	private function validateRoleAmount($user, $roles) {
		//Validate that there's at least one role chosen, placing this here so
		//at lease the user can be updated first, if this fails the roles will be
		//kept the same as before the user was updated
		if (count($roles) == 0) {
			//Deactivate user
			$user->status = 0;
			$user->save();

			$exception = new UserNeedsRolesException();
			$exception->setValidationErrors('Debes escoger al menos un rol. El provedor se ha creado pero esta desactivado');

			//Grab the user id in the controller
			$exception->setUserID($user->id);
			throw $exception;
		}
	}

	/**
	 * @param $input
	 * @param $user
	 * @throws GeneralException
	 */
	private function checkUserByEmail($input, $user)
	{
		//Figure out if email is not the same
		if ($user->email != $input['email'])
		{
			//Check to see if email exists
			if (User::where('email', '=', $input['email'])->first())
				throw new GeneralException('Esta dirección de email ya esta en uso.');
		}
	}

	/**
	 * @param $roles
	 * @param $user
	 */
	private function flushRoles($roles, $user)
	{
		//Flush roles out, then add array of new ones
		$user->detachRoles($user->roles);
		$user->attachRoles($roles['assignees_roles']);
	}

	/**
	 * @param $permissions
	 * @param $user
	 */
	private function flushPermissions($permissions, $user)
	{
		//Flush permissions out, then add array of new ones if any
		$user->detachPermissions($user->permissions);
		if (count($permissions['permission_user']) > 0)
			$user->attachPermissions($permissions['permission_user']);
	}

	/**
	 * @param $roles
	 * @throws GeneralException
	 */
	private function checkUserRolesCount($roles)
	{
		//User Updated, Update Roles
		//Validate that there's at least one role chosen
		if (count($roles['assignees_roles']) == 0)
			throw new GeneralException('Debes seleccionar al menos un rol');
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	private function createUserStub($input)
	{
		$user = new User;
		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->password = $input['password'];
		$user->status = isset($input['status']) ? 1 : 0;
		$user->confirmation_code = md5(uniqid(mt_rand(), true));
		$user->confirmed = isset($input['confirmed']) ? 1 : 0;
		return $user;
	}
}
