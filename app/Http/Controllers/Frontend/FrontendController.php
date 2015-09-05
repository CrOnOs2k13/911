<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Request;
use View;
use App\productos;
use App\User;
use App\baner;
/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$productos_all = productos::with('user')->where('deleted_at',null)->get()->shuffle();
		$baner=rand(1,4);
		$link=baner::findOrFail($baner);
		//dd($link);
		$productos_all = $productos_all->take(20);
		$productos_patrocinados = productos::where('patrocinado','>',0)->where('deleted_at',null)
		->orderBy('updated_at','desc')->take(4)->get()->shuffle();
		return view('frontend.index')
			->with('productos',$productos_all)
			->with('patrocinados',$productos_patrocinados)->with('baner',$baner)->with('link',$link->link);
	}

public function politica()
{
	return view('frontend.politica');
}
public function correo(Request $request){
	$this->validate($request, [
			'nombre' => 'required',
			'empresa' => '',
			'telefono' => '',
			'movil' => '',
			'email' => 'required',
			'mensaje' => 'required',
	]);
	
}


	/**
	 * @return \Illuminate\View\View
	 */
	public function macros()
	{
		return view('frontend.macros');
	}
}
