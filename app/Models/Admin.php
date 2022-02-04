<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

protected $table ='admins';

protected $appends =['image_path'];


    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getNameAttribute($value){


        return ucfirst($value);
      }

      public function getImagePathAttribute(){

        return asset('uploads/user_images/'. $this->photo);
      }

}
