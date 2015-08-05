<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class baner extends Model
{
    //
        protected $table ='baners';

        protected $fillable = ['link','archivo'];

        public function __construct()
        {
          $this->table = config('baners');
        }
}
