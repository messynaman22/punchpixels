<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmPasswordReset extends Model {

    protected $table = 'crm_password_resets';
    public $timestamps = true;


    protected $fillable = ['email', 'token'];


}
