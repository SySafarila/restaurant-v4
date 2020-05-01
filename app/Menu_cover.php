<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_cover extends Model
{
    protected $fillable = ['name', 'menu_id'];

    public function menu()
    {
        $this->belongsTo('App\Menu');
    }
}
