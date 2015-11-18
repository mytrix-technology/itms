<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Uat extends Model {
	protected $table ='uat';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','uat_user','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_created','id');
    }
    
    public function project()
    {
        return $this->belongsTo('Project','project_apps_id','id');
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

    /**
     * Return the identifiant of the permission
     * @return int id of the permission
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getProjectName()
    {
        return $this->project->name_project;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatTarget()
    {
        return $this->uat_target;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatActualDate()
    {
        return $this->uat_actual_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatUser()
    {
        return $this->user->username;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatNote()
    {
        return $this->uat_note;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatRevision()
    {
        return $this->uat_revision;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUatFile()
    {
        return $this->uat_file;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserCreated()
    {
        return $this->user1->username;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}