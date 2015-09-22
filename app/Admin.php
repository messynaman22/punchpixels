<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'page_item' , 'value'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['page_type','date'];
}
