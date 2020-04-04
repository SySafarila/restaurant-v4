<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_code extends Model
{
    // protected $primaryKey = 'code';
    protected $fillable = ['user_id', 'code'];

    // Relationship
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
