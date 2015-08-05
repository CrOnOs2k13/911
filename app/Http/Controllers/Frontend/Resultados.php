<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use DB;
use Request;
use View;
use App\productos;
use App\User;
use Excel;

/**
 * Class Resultados
 * @package App\Http\Controllers
 */
class Resultados extends Controller {

   /**
 	* @return \Illuminate\View\View
 	*/
  public function busqueda()
  {
    $input = request::All();
    if (array_key_exists('busqueda', $input) && strlen($input['busqueda']) > 0) {
      $query = $input['busqueda'];
      $keyword = explode(' ',$query);
      $busqueda =\App\productos::with('user')->where('producto', 'LIKE', '%'.$query.'%');
      foreach ($keyword as $key ) {
        $busqueda = $busqueda->orWhere('producto', 'LIKE', '%'.$key.'%');
      }
      $busqueda = $busqueda->orWhere('codigo', 'LIKE', '%'.$key.'%')->orderBy('precio','asc');
      $results = $busqueda->paginate(100);
      $results->setPath(public_path().'/busqueda');
      // 	$results = productos::where('producto', 'LIKE', '%'.$query.'%')->orWhere('codigo', 'LIKE', '%'.$query.'%')->get();
      if (count($results) > 0) {
        return View('frontend.resultados')
        ->with('resultados', $results)->with('patrocinados',$results->where('patrocinado','>',0)->take(10));
      } else {
        return redirect('/')->withInput()->withFlashDanger('No se encontraron resultados');;
      }
    }

    return Redirect('/');
  }
  /**
  * @return descarga
  * crea el archivo de descarga e inicia su descarga basado en la busqueda
  **/
  public function descargar($busquedas){
    /**
    * funcion de busqueda no regresa todos los campos y ocupa poner los provedores arraglar eso
    **/
    $results=null;
     $query = $busquedas;
     $keyword = explode(' ',$query);
     $busqueda =\App\productos::where('producto', 'LIKE', '%'.$query.'%');
     foreach ($keyword as $key ) {
       $busqueda = $busqueda->orWhere('producto', 'LIKE', '%'.$key.'%');
     }
     $busqueda = $busqueda->orWhere('codigo', 'LIKE', '%'.$key.'%')->orderBy('precio','asc');
     $GLOBALS['results'] = $busqueda->get();

     if (! count( $GLOBALS['results']) > 0) {
       $GLOBALS['results'] = collect(['Busqueda sin resultados']);
     }
    // dd($results);
    $archivo=Excel::create('Busqueda_911arq.com', function($excel) {
      // Set the title
      $excel->setTitle('Busqueda');
      // Chain the setters
      $excel->setCreator('911arq.com')
      ->setCompany('911arq.com');
      // Call them separately
      $excel->setDescription('Resultados de 911arq.com');
      //$GLOBALS['results']->groupBy('user_id');

      foreach ($GLOBALS['results']->groupBy('user_id') as $productos ) {
        // optiene la informacion del provedor
        $tienda = user::where('id',$productos[0]->user_id)->first();
        // crea la pagina y la llama con el nombre del provedor
        $excel->sheet($tienda->name, function($sheet) use($productos, $tienda)  {
          $sheet->setOrientation('landscape');
          // agrega 5 lineas a la pagina con la informacion del provedor y encabezados de columnas
          // $sheet->appendRow(1,array($tienda->name));

          $sheet->rows(array(
            array($tienda->name),
            array($tienda->razon_social),
            array($tienda->direccion),
            array($tienda->telefono),
            array('----------------------RESULTADOS----------------------'),
            array('Producto','Precio','Codigo')
          ));
          $contador=0;
          foreach ($productos as $producto) {
            $sheet->appendRow(7+$contador,array($producto->producto,$producto->precio,$producto->codigo));
            $contador = $contador+1;
          }
        }); //exel->sheet
      }
    })->download('xls');
    dd($archivo);

  //  $hoja =$archivo->sheet('Resultados');
    //$hoja->fromArray($results->toArray());
    //->fromArray($results->toArray());
    //dd($hoja);
    return redirect()->back();
  }
}

// public function search() {
//
//     $q = Input::get('myInputField');
//
//     $searchTerms = explode(' ', $q);
//
//     $query = DB::table('products');
//
//     foreach($searchTerms as $term)
//     {
//         $query->where('name', 'LIKE', '%'. $term .'%');
//     }
//
//     $results = $query->get();
//
// }
// public function search() {
//
//     $q = Input::get('myInputField');
//
//     $searchTerms = explode(' ', $q);
//
//     $query = $article->where('title', 'LIKE', "%{$keyword}%")
//              ->orWhere('description', 'LIKE', "%{$keyword}%");
//
//     foreach($searchTerms as $term)
//     {
//         $query = $query->orWhere('name', 'LIKE', '%'. $term .'%');
//     }
//
//     $results = $query->get();
//
// }
