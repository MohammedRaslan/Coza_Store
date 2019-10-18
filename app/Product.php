<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Model
{
    //
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categ', 'name', 'price', 'model','brand','color',
        'dimensions','display_size','img','feature','released','quantity','created_at',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
