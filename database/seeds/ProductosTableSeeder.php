<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\productos;
use Carbon\Carbon as Carbon;

class ProductosTableSeeder extends Seeder {

	public function run() {
 		DB::table('productos')->delete();
		//modificar para que se inserten varios productos
		// for ($i = 0; $i < 5; ++$i) {
 	// 		DB::table('productos')->insert(array(['user_id' => '3','producto' => 'producto2',	'codigo' => '45a4s65a4s','precio' => '125','categoria' => 'cat1','patrocinado'->'true']));
		// }
		// for ($i = 0; $i < 5; ++$i) {
		// 	DB::table('productos')->insert(array(['user_id' => '1','producto' => 'producto1',	'codigo' => '862153864','precio' => '200','categoria' => 'cat2','patrocinado'->'false']));
		// }
		// for ($i = 0; $i < 5; ++$i) {
		// 	DB::table('productos')->insert(array(['user_id' => '2','producto' => 'producto3',	'codigo' => '5asd5aas4d','precio' => '500','categoria' => 'cat6','patrocinado'->'false']));
		// }
		$producto = array('user_id' => '1',
				'producto' => 'PISO BLACK RED 60X60',
				'codigo' => 'PBMRED60X60M2',
				'precio' => '905.25',
				'categoria' => 'ACABADOS',
				'patrocinado' => '1',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()			);
		DB::table('productos')->insert($producto);

		$producto = array('user_id' => '1',
			'producto' => 'PISO BLACK TONER 50X50',
			'codigo' => 'PBT50x50M2',
			'precio' => '790.25',
			'categoria' => 'ACABADOS',
			'patrocinado' => '1',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()	);
		DB::table('productos')->insert($producto);

	$producto = array('user_id' => '1',
		'producto' => 'ANKARA BLACK MATTE 60X60',
		'codigo' => 'ABM60X60M2',
		'precio' => '958.25',
		'categoria' => 'ACABADOS',
		'patrocinado' => '1',
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now());
	DB::table('productos')->insert($producto);

		$producto= array('user_id' => '2',
		'producto' => 'PISO BLACK MATTE 60X60 RECTIFICADO, M2',
		'codigo' => 'PBMR60x60M2',
		'precio' => '890.85',
		'categoria' => 'ACABADOS',
		'patrocinado' => '0',
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now());
	DB::table('productos')->insert($producto);

	$producto= array('user_id' => '2',
		'producto' => 'PISO BLACK MATTE 60X60',
		'codigo' => 'PBM60x60M2',
		'precio' => '799.25',
		'categoria' => 'ACABADOS',
		'patrocinado' => '0',
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now());
	DB::table('productos')->insert($producto);

	$producto= array('user_id' => '2',
		'producto' => 'PISO BLACK RED 60X60',
		'codigo' => 'PBMRED60X60M2','precio' => '905.25',
		'categoria' => 'ACABADOS',
		'patrocinado' => '0',
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now());
	DB::table('productos')->insert($producto);

		$producto= array('user_id' => '3',
			'producto' => 'PISO BLACK MATTE 60X60 RECTIFICADO, M2',
			'codigo' => 'PBMR60x60M2',
			'precio' => '890.85',
			'categoria' => 'ACABADOS',
			'patrocinado' => '0',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()	);
		DB::table('productos')->insert($producto);

		$producto= array('user_id' => '3',
			'producto' => 'PISO BLACK MATTE 60X60',
			'codigo' => 'PBM60x60M2',
			'precio' => '799.25',
			'categoria' => 'ACABADOS',
			'patrocinado' => 'false',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()	);
		DB::table('productos')->insert($producto);

		$producto= array('user_id' => '3',
			'producto' => 'PISO BLACK RED 60X60',
			'codigo' => 'PBMRED60X60M2',
			'precio' => '905.25',
			'categoria' => 'ACABADOS',
			'patrocinado' => '0',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()	);
		DB::table('productos')->insert($producto);

		$producto= array('user_id' => '3',
			'producto' => 'PISO BLACK TONER 50X50',
			'codigo' => 'PBT50x50M2',
			'precio' => '790.25',
			'categoria' => 'ACABADOS',
			'patrocinado' => '0',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()	);
		DB::table('productos')->insert($producto);

		$producto=array('user_id' => '4',
		'producto' => 'ANKARA BLACK MATTE 60X60',
		'codigo' => 'ABM60X60M2',
		'precio' => '958.25',
		'categoria' => 'ACABADOS',
		'patrocinado' => '2',
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now());
	DB::table('productos')->insert($producto);
	}
}
