<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = ['unique_code', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
