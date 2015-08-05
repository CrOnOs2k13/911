<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;



class UserTableSeeder extends Seeder {

	public function run() {

		//Add the master administrator, user id of 1
		DB::table(config('auth.table'))->truncate();

		$user = array(
			'name' => 'Admin Istrator',
			'razon_social' => 'Admin Istrator',
			'encargado' => 'encargado administrador',
			'direccion' => ' Direccion del Admin Istrator',
			'telefono' => '443-658-9549',
			'patrocinados' => 1,
			'email' => 'admin@admin.com',
			'password' => bcrypt('1234'),
			'confirmation_code' => md5(uniqid(mt_rand(), true)),
			'confirmed' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		);

		DB::table(config('auth.table'))->insert($user);

		$user = array(
			'name' => 'The Home Depot',
			'razon_social' => 'Admin Istrator',
			'encargado' => 'Home depot, S.A. DE C.V.',
			'direccion' => 'Direccion de Home Depot',
			'telefono' => '01 800 004 6633',
			'patrocinados' => 0,
			'email' => 'home@homedepot.com',
			'password' => bcrypt('1234'),
			'confirmation_code' => md5(uniqid(mt_rand(), true)),
			'confirmed' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		);

		DB::table(config('auth.table'))->insert($user);

		$user = array(
			'name' => 'Provedor1',
			'direccion' => 'Direccion de Provedor1',
			'razon_social' => 'Provedor1 SA CV',
			'encargado' => 'Encargado Interceramic',
			'telefono' => '01 477 717 7777',
			'patrocinados' => 0,
			'email' => 'provedor1@provedor1.com',
			'password' => bcrypt('1234'),
			'confirmation_code' => md5(uniqid(mt_rand(), true)),
			'confirmed' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		);

		DB::table(config('auth.table'))->insert($user);

		$user = array(
			'name' => 'Cordillera1',
			'direccion' => 'Direccion de Cordillera1',
			'razon_social' => 'Cordillera1 SA CV',
			'encargado' => 'Encargado Cordillera',
			'telefono' => '(562) 2387 4200',
			'patrocinados' => 2,
			'email' => 'cordillera@cordillera.com',
			'password' => bcrypt('1234'),
			'confirmation_code' => md5(uniqid(mt_rand(), true)),
			'confirmed' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		);

		DB::table(config('auth.table'))->insert($user);
	}
}
