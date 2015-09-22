<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailDetails extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_details';
    public $timestamps = true;
    protected $fillable = [ 'to_from' , 'type','subject','message','include_data'];


    
    

}
