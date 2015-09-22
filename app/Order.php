<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;
    public $fillable = ['package_start', 'package', 'choose_service',
        'card_number', 'month', 'year', 'full_name',
        'cvv',"user_id",
        'street_address', 'primary_zip_code', 'bank_name', 'routing_number',
        'account_number', 'contact_information', 'secondary_zip_code', 'billing_address','account_type',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile','user_id');
    }
}
