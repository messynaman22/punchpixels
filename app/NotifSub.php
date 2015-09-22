<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifSub extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notification_subscriber';
    public $timestamps = true;
    protected $fillable = [ 'email' , 'included'];


    
    

}
