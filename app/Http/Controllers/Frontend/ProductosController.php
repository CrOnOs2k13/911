<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\User;
use File;
// use Illuminate\Http\Request;
use App\Repositories\Frontend\Auth\AuthenticationContract;
// use App\Exceptions\GeneralException;
use App\productos;
use Illuminate\Http\Request;
use Input;
use Maatwebsite\Excel\Facades\Excel;


/**
 * Class Resultados
 * @package App\Http\Controllers
 */
class ProductosController extends Controller {

  public function __construct(AuthenticationContract $auth)
	{
		$this->auth = $auth;
	}

   /**
 	* @return \Illuminate\View\View
 	*/
  public function index(){
    $todos= $this->auth->user()->productos;
    return View('frontend.user.productos')->with('prod', $todos);
  }
  public function borrar($id_prod){

    $borrar = \App\productos::find($id_prod);
    $borrar->delete();
    return back()->withFlashSuccess("Producto eliminado.". $borrar->id . $borrar->producto);
  }

  public function editar($id_prod){
    $editar = \App\productos::find($id_prod);
    return view('frontend.user.editar')->with('producto',$editar)->with('titulo','Actualizar información del producto');

  }
  public function actualizar(Request $request,$id){

    $this->validate($request, [
        'producto' => 'required',
        'codigo' => 'required',
        'precio' => 'required',
        'unidad' => 'required',
        'categoria' => 'required',
    ]);
    $datos = Input::all();
    $actualizar = \App\productos::find($id);
    $actualizar->producto = $datos['producto'];
    $actualizar->codigo = $datos['codigo'];
    $actualizar->precio = $datos['precio'];
    $actualizar->unidad = $datos['unidad'];
    $actualizar->categoria = $datos['categoria'];
    $actualizar->patrocinado = $this->auth->user()->patrocinados;
    $actualizar->save();

        return redirect()->route('productos')->withFlashSuccess("Producto actualizado.");
  }

  public function crear(){
    return  view('frontend.user.agregar');
  }

public function guardar(Request $request){
  $this->validate($request, [
      'producto' => 'required',
      'codigo' => 'required',
      'precio' => 'required',
      'categoria' => 'required',
  ]);
  $datos = Input::all();
  $guardar = new productos;
  $guardar->user_id= $this->auth->user()->id;
  $guardar->producto = $datos['producto'];
  $guardar->codigo = $datos['codigo'];
  $guardar->precio = $datos['precio'];
  $guardar->unidad = $datos['unidad'];
  $guardar->categoria = $datos['categoria'];
  $guardar->patrocinado = $this->auth->user()->patrocinados;
  $guardar->save();
  return redirect()->route('productos')->withFlashSuccess("Producto agregado.");
}

  public function subirArchivo(){
    return view('frontend.user.farchivo');
  }

  public function verificarArchivo(Request $request){
    // $this->validate($request, [
    //     'producto' => 'required',
    //     'codigo' => 'required',
    //     'precio' => 'required',
    //     'categoria' => 'required',
    // ]);
    $GLOBALS['er']= false;
    $GLOBALS['mensaje']= 'Se encontraron codigos de producto repetidos, el archivo se detuvo. ';
    if (Input::hasFile('productos') ) {
      $ruta = base_path() . '/public/file/' ;
      $nombreArchivo = Input::file('productos')->getClientOriginalName();
      $archivo = Input::file('productos')->move( $ruta, $nombreArchivo);
      $file=$ruta . $nombreArchivo;
      $x=Excel::load($file, 'UTF-8');
      //dd($x->take(100)->get());
       //$ex=Excel::load($ruta . $nombreArchivo, 'UTF-8', function($archivo2) {
      //  $resultado = $archivo2->get();
      $resultado = $x->get();
        $duplicados = new productos;
        //dd($resultado);
        foreach ($resultado as $key => $value) {
          if ($value->has('producto')) {
            if (! $duplicados->where('codigo',$value->__get('codigo') )
              ->where('id',$this->auth->user()->id)
              ->count()) {
                $guardar = new productos;
                $guardar->user_id= $this->auth->user()->id;
                $guardar->producto = $value->__get('producto');

              $guardar->codigo = $value->__get('codigo');
              $guardar->precio = $value->__get('precio');
              $guardar->unidad = $value->__get('unidad');
              $guardar->categoria = $value->__get('categoria');
              $guardar->patrocinado =  $this->auth->user()->patrocinados;
              $guardar->save();
            }else{
              $GLOBALS['mensaje']= $GLOBALS['mensaje'] . ', ' . $value->__get('codigo') ;
               $GLOBALS['er'] = true;
            }

          }
        }
        File::delete($file);
//  });

    if ($GLOBALS['er']) {
      return redirect()->route('productos')->withFlashDanger($GLOBALS['mensaje']. ' estos productos no fueron agregados.');
    } else {
      return redirect()->route('productos')->withFlashSuccess("Archivo agregado.");
    }


    }
    else {
      return redirect()->route('productos')->withFlashWarning("Error al subir el archivo");
    }

  }
  public function archivoactualizarview(){
    return view('frontend.user.factualiza');
  }

  public function procesarUpdate(Request $request){

      // $this->validate($request, [
      //     'producto' => 'required',
      //     'codigo' => 'required',
      //     'precio' => 'required',
      //     'categoria' => 'required',
      // ]);
      $GLOBALS['er']= false;
      $GLOBALS['mensaje']= 'Se encontro un error en los siguientes codigos de producto ';
      if (Input::hasFile('productos') ) {
        $ruta = base_path() . '/public/file/' ;
        $nombreArchivo = Input::file('productos')->getClientOriginalName();
        $archivo = Input::file('productos')->move( $ruta, $nombreArchivo);
        $ex=Excel::load($ruta . $nombreArchivo , function($archivo2){
          $resultado = $archivo2->get();
          foreach ($resultado as $key => $value) {
            $duplicados = new productos;
            $codigo =$value->__get('codigo');
            $precio =$value->__get('precio');
            $duplicados = productos::where('codigo',$codigo)->where('user_id',$this->auth->user()->id)->get();
            if ($duplicados->codigo= $codigo) {
                $duplicados = productos::where('codigo',$codigo)->where('user_id',$this->auth->user()->id)->update(['precio'=>$precio]);
            }else{
                $GLOBALS['mensaje']= $GLOBALS['mensaje'] . ', ' . $codigo ;
                $GLOBALS['er'] = true;
            }
          }
        });

      if ($GLOBALS['er']) {
        return redirect()->route('productos')->withFlashDanger($GLOBALS['mensaje']. ' su precio no fue actualizado.');
      }else{
        return redirect()->route('productos')->withFlashSuccess("Actualizacion exitosa.");
      }
    }
    else {
        return redirect()->route('productos')->withFlashWarning("Error al subir el archivo");
    }
  }
  public function procesarArchivo($archivo){
//     $archivo = base_path() .'/public/file/EJEMPLO 911.xlxs';
//     Excel::load('file.xls', function($archivo) {
//       $archivo->all()->dd();
// });

  }
}
