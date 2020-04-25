<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu_image extends Model
{
    protected $fillable = ['name', 'menu_id'];
    use SoftDeletes;

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
