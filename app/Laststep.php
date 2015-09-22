<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Laststep extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'last_step';
     public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'birthdate' , 'driving_license_state','driving_license_number','social_security_numer'];
    
    public function profile()
    {
        return $this->belongsTo('App\Profile','user_id');
    }
    
}
