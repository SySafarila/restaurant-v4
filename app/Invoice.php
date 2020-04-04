<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'menu', 'total', 'quantity', 'invoice_code_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invoice_code()
    {
        return $this->belongsTo('App\Invoice_code');
    }
}
