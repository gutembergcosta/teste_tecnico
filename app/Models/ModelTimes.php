<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTimes extends Model
{
    protected $table = 'times';

    public function ordemTimes(){
        return $this->hasOne('App\Models\ModelCategoria', 'id', 'id_categoria');
    }

    
}
