<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Crmadmins extends Model {

    protected $table = 'crm_admins';
    public $timestamps = true;

 
    protected $fillable = [ 'username' , 'password',"email", "role", "status", "login_attemps"];

    
}
