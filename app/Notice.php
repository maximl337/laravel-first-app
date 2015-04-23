<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model {

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [

        'infringing_title',
        'infringing_link',
        'original_link',
        'original_description',
        'template',
        'content_removed',
        'provider_id',

    ];


    /**
     * A Notice belongs to a recipient/provider
     * @return [type] [description]
     */
    public function recipient()
    {
        return $this->belongsTo('App\Provider', 'provider_id');
    }

    /**
     * A Notice is created by a user
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the email address of the recipient of the DMCA
     * @return [type] [description]
     */
    public function getRecipientEmail()
    {
        return $this->recipient->copyright_email;
    }

    /**
     * Get the Email address of the owner of the notice
     * 
     * @return [type] [description]
     */
    public function getOwnerEmail()
    {
        return $this->user->email;
    }

}
