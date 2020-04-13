<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    protected $fillable = ['name', 'description', 'price', 'img', 'stock'];
    use SoftDeletes;

    // Relationship
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
