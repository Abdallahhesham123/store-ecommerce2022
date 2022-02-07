<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class MainCat extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;

    protected $table ='main_cats';
    protected $dates =['deleted_at'];

// protected $appends =['image_path'];


    protected $fillable = [
        'trans_lang',
        'trans_of',
        'name',
        'slug',
        'image',
        'active',

    ];

    public function scopeActive($query){


      return $query->where('active',1);
    }

    public function scopeSelection($query){


        return $query->select('id','trans_lang','name','slug','image','active','trans_of');
      }


    public function getNameAttribute($value){


        return ucfirst($value);
      }

      public function getactive(){


      return  $this->active === 1 ? 'on':'off';
      }



    public function getImageAttribute($val){

        return ($val !== null) ? asset('assets/'.$val) : "";
    }

    public function category(){


        return $this->hasMany(self::class,'trans_of');
    }
}