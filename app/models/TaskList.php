<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class TaskList extends Model {
	
    protected $table ='tasklist';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','close_by','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','assignment_from','id');
    }

    public function user2()
    {
        return $this->belongsTo('User','assignment_to','id');
    }

    public function user3()
    {
        return $this->belongsTo('User','user_created','id');
    }

   public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_tasklist','id');
    }
    
    public function masterstatus1()
    {
        return $this->belongsTo('MasterStatus','priority','id');
    }
    
    public function project()
    {
        return $this->belongsTo('Project','reference','id');
    }

    public function design()
    {
        return $this->belongsTo('Design','reference_design','id');
    }
    
    public function mastertasktype()
    {
        return $this->belongsTo('MasterTaskType','master_task_type_id','id');
    }

    public function dailyreport()
    {
        return $this->hasMany('DailyReport');
    }

    public function historytasklist()
    {
        return $this->hasMany('HistoryTasklist','tasklist_id','id');
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
    public function getAssignmentFrom()
    {
        return $this->user1->username;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssignmentTo()
    {
        return $this->user2->username;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getEmailAssignmentTo()
    {
        return $this->user2->email;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescTasklist()
    {
        return $this->desc_tasklist;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssignmentDate()
    {
        return $this->assignment_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDueDate()
    {
        return $this->due_date;
    }
    
    public function getStatusVersion()
    {
        return $this->masterstatus->status_version;
    }

    public function getActiveStatus()
    {
        return $this->masterstatus->activated;
    }

    public function getStatusTasklist()
    {
        return $this->masterstatus->status_name;
    }
    
    public function getReference()
    {
        return $this->project->name_project;
    }

    public function getReferenceDesign()
    {
        return $this->design->design_name_version;
    }
    
    public function getMasterTaskType()
    {
        return $this->mastertasktype->name_task_type;
    }
    
    public function getActualFinishDate()
    {
        return $this->actual_finish_date;
    }
    
    public function getCloseBy()
    {
        return $this->user->username;
    }
    
    public function getParameterReminder()
    {
        return $this->parameter_reminder;
    }
    
    public function getUploadFile()
    {
        return $this->upload_file;
    }
    
    public function getPriority()
    {
        return $this->masterstatus1->status_name;
    }

    public function getDatabaseChange()
    {
        return $this->database_change;
    }

    public function getAppsFileChange()
    {
        return $this->apps_file_change;
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

class HistoryTasklist extends Model {

    protected $table ='tasklist_history';
    
    public $timestamps = TRUE;

    public function tasklist()
    {
        return $this->belongsTo('TaskList','tasklist_id','id');
    }

    public function user()
    {
        return $this->belongsTo('User','user_created','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSubjectTasklist()
    {
        return $this->tasklist->subject;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTitleHistory()
    {
        return $this->title_history;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getNoteHistory()
    {
        return $this->note_history;
    }    

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserCreated()
    {
        return $this->user->username;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserUpdated()
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