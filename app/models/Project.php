<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Project extends Model {
	protected $table ='project';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','trainer','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','assesment_user','id');
    }

    public function user2()
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
    
    public function masterprojecttype()
    {
        return $this->belongsTo('MasterProjectType','master_type_project_id','id');
    }
    
    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_project_request','id');
    }

    public function updateapps1()
    {
        return $this->belongsTo('UpdateApps','update_apps_id','id');
    }
	
	public function updateapps()
    {
        return $this->hasMany('UpdateApps');
    }

    public function design()
    {
        return $this->hasMany('Design', 'project_id','id');
    }

    public function tasklist()
    {
        return $this->hasMany('TaskList');
    }
    
    public function uat()
    {
        return $this->hasMany('Uat');
    }
    
    public function training()
    {
        return $this->hasMany('Training');
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
    public function getNameProject()
    {
        return $this->name_project;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescProject()
    {
        return $this->desc_project;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getProjectRequestDate()
    {
        return $this->project_request_date;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterAppsName()
    {
        return $this->masterapps->name_apps;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterModulName()
    {
        return $this->mastermodul->name_modul;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMasterProjectTypeName()
    {
        return $this->masterprojecttype->name_project_type;
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
    public function getAssesmentDate()
    {
        return $this->assesment_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssesmentUser()
    {
        return $this->user->username;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssesmentNote()
    {
        return $this->assesment_note;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTrainingTarget()
    {
        return $this->training_target;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTrainingActualDate()
    {
        return $this->training_actual_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTrainer()
    {
        return $this->trainer;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatusProject()
    {
        return $this->masterstatus->status_name;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getManualBookFile()
    {
        return $this->manual_book_file;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDocProjectFile()
    {
        return $this->doc_project_file;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserCreated()
    {
        return $this->user2->username;
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