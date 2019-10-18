<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Data extends Model
{
    //
    protected $fillable = [
        'user_id', 'product_id',
    ];

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('app\User');
    }
}
