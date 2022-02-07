<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;
 protected $dates =['deleted_at'];

protected $table ='admins';

protected $appends =['image_path'];

// public $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($value){


        return ucfirst($value);
      }

      public function getImagePathAttribute(){

        return asset('uploads/user_images/'. $this->image);
      }

}

