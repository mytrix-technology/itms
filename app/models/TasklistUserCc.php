<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class TasklistUserCc extends Model {

	protected $table ='tasklist_user_cc';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }

    public function tasklist()
    {
        return $this->belongsTo('TaskList','tasklist_id','id');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('nm_vendor','nm_pemilik_vendor', 'alamat_vendor','telp_vendor','email_vendor');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    public function getId()
    {
        return $this->id;
    }

    public function getUserCc()
    {
        return $this->user->username;
    }
    
    public function getTasklistName()
    {
        return $this->tasklist->subject;
    }
    
    public function getView()
    {
        return $this->view;
    }
}
