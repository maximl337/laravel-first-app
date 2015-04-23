<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model {

    /**
     * Fillable field for provider
     */
    protected $fillable = [

        'name',
        'copyright_email'
    ];
    

}
