<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'address', 'gender', 'level', 'status', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function Invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function invoice_codes()
    {
        return $this->hasMany('App\Invoice_code');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function refunds()
    {
        return $this->hasMany('App\Refund');
    }
}