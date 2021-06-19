<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude', 'restaurant_id', 'user_id', 'state', 'paymentMethod',
        ];

    public function meals(){ //used to link quantity and meal to order 
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }

}
