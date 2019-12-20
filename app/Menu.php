<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'description', 'price', 'img', 'stock', 'status'];

    // Relationship
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
