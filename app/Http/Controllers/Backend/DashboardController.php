<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\baner;
use Illuminate\Http\Request;

use Input;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {
	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('backend.dashboard');
	}
	public function baners()
	{
		return view('backend.baners');
	}
	public function guardar_baners(Request $request)
	{


	//	dd($request->all());
	//	dd($request->hasFile('baner1'));
	$ruta=base_path();
	$ruta=$ruta . '/../www/img/';
	//dd($ruta);
		if (Input::hasFile('baner1')) {
			Input::file('baner1')->move( $ruta, 'baner1.jpg');
			$guardar= baner::find(1);
			//dd($guardar->link);
			$guardar->link = $request->Input('link1');
			$guardar->save();


			# code...
		}
		if (Input::hasFile('baner2')) {
			Input::file('baner2')->move( $ruta, 'baner2.jpg');
			$guardar=baner::findOrFail(2);
			//dd($guardar);
			$guardar->link= $request->input('link2');
			$guardar->save();
			# code...
		}
		if (Input::hasFile('baner3')) {
			Input::file('baner3')->move( $ruta, 'baner3.jpg');
			$guardar=baner::findOrFail(3);
			//dd($guardar);
			$guardar->link= $request->input('link3');
			$guardar->save();
			# code...
		}
		if (Input::hasFile('baner4')) {
			Input::file('baner4')->move( $ruta, 'baner4.jpg');
			$guardar=baner::findOrFail(4);
			//dd($guardar);
			$guardar->link= $request->input('link4');
			$guardar->save();
			# code...
		}
		return  redirect()->route('backend.dashboard')->withFlashSuccess("Baners actualizados.");

	}
}
