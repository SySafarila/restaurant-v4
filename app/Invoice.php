<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'menu', 'total', 'quantity', 'unique'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
