<?php namespace App\Http\Controllers\Backend;

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
class ProductoBackend extends Controller {

   /**
 	* @return \Illuminate\View\View
 	*/
public function borrarTodo($user_id){
  if Input::get('borrar'){
  productos::where('user_id',$user_id)->delete();
  }
  return redirect()->back();

}

public function descargarTodo(){
  /**
  * funcion de busqueda no regresa todos los campos y ocupa poner los provedores arraglar eso
  **/
   //dd($busqueda);

  $archivo=Excel::create('Productos911arq', function($excel) {
    $busqueda =\App\productos::with('user')->where('id','>',0)->get();
    // Set the title
    $excel->setTitle('Productos');
    // Chain the setters
    $excel->setCreator('911arq.com')
    ->setCompany('911arq.com');
    // Call them separately
    $excel->setDescription('Resultados de 911arq.com');
    //$GLOBALS['results']->groupBy('user_id');
    //dd($busqueda->groupby('user_id'));
    foreach ($busqueda->groupBy('user_id') as $productos ) {
      // optiene la informacion del provedor
      $tienda = user::where('id',$productos[0]->user_id)->first();
      // crea la pagina y la llama con el nombre del provedor
      $excel->sheet(str_limit($tienda->name,20), function($sheet) use($productos, $tienda)  {
        $sheet->setOrientation('landscape');
        //dd($sheet->name);
        // agrega 5 lineas a la pagina con la informacion del provedor y encabezados de columnas
        // $sheet->appendRow(1,array($tienda->name));

        $sheet->rows(array(
          array($tienda->name),
          array($tienda->razon_social),
          array($tienda->direccion),
          array($tienda->telefono),
          array('----------------------RESULTADOS----------------------'),
          array('Producto','Precio','Codigo','Unidad')
        ));
      //dd($productos->count());
       $this->lineas(7,$productos,$sheet);
        // foreach ($productos as $producto) {
        //   $sheet->appendRow(7+$contador,array($producto->producto,$producto->precio,$producto->codigo,$producto->unidad));
        //   $contador = $contador+1;
      //  }
      }); //exel->sheet
    }
  })->download('xls');
//  dd($archivo);

//  $hoja =$archivo->sheet('Resultados');
  //$hoja->fromArray($results->toArray());
  //->fromArray($results->toArray());
  //dd($hoja);
  return redirect()->back();
}
public function lineas($linea, $datos, $archivo){
  $linea = 7;
  foreach ($datos->chunk(1000) as $pieza) {
    foreach ($pieza as $dato) {
    $archivo->appendRow($linea,array($dato->producto,$dato->precio,$dato->codigo,$dato->unidad));
    $linea = $linea+1;
    }
  }
  }
}
