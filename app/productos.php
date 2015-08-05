<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class productos extends model{
  use SoftDeletes;
      	protected $dates = ['deleted_at'];

      protected $table ='productos';

      protected $fillable = ['id_tienda','producto','codigo','precio','categoria','patrocinado'];

      public function __construct()
      {
        $this->table = config('productos');
      }

      public function user()
      {
        return $this->belongsTo('App\User');
      }

      public function patrocinado()
      {
        return $this->belongsTo('App\User');
      }


      // public function Todos(){
      //   return App\User::find(1)->productos;
      // }
}
