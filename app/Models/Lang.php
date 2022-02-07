<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;


protected $table ='langs';

protected $fillable = [
    'abbr',
    // 'locale',
    'name',
    'direction',
    'active',

];


    public function getNameAttribute($value){


        return ucfirst($value);
      }

      public function scopeActive($query){


        return $query->where('active',1);
      }

      public function scopeSelection($query){


        return $query->select('id','abbr','name','direction','active');
      }

      public function getActive(){

       return $this->active == 1 ? 'on':'off';
      }

}