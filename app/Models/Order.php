<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['user_id', 'code', 'name', 'email', 'phone', 'address', 'city', 'country', 'subtotal', 'tax', 'total', 'status'];
    
    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->code = str_pad(mt_rand(1,99999999), 12, 0, STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

	public function products()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
}
