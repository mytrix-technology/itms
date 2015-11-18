<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UpdateApps extends Model {
	protected $table ='update_app';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','pic','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_created','id');
    }
    
    public function masterapps()
    {
        return $this->belongsTo('MasterApps','master_apps_id','id');
    }
    
    public function mastermodul()
    {
        return $this->belongsTo('MasterModul','master_modul_id','id');
    }
    
    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_update_apps','id');
    }

    public function project1()
    {
        return $this->belongsTo('Project', 'project_id','id');
    }
	
	public function project()
    {
        return $this->hasMany('Project');
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
    public function getProject()
    {
        return $this->project1->name_project;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterApps()
    {
        return $this->masterapps->name_apps;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterModul()
    {
        return $this->mastermodul->name_modul;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterStatus()
    {
        return $this->masterstatus->status_name;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getFilenameUpdate()
    {
        return $this->filename_update;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDatabaseChange()
    {
        return $this->database_change;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAppsChange()
    {
        return $this->apps_change;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getRemark()
    {
        return $this->remark;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserRequest()
    {
        return $this->user_request;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAppsVersion()
    {
        return $this->apps_version;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getRequestDate()
    {
        return $this->request_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUpdateDate()
    {
        return $this->request_date;
    }

    public function getUserConfirmation()
    {
        return $this->user_confirmation;
    }

    public function getConfirmationDate()
    {
        return $this->confirmation_date;
    }

    public function getPic()
    {
        return $this->pic;
    }

    public function getManualBookFile()
    {
        return $this->manual_book_file;
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