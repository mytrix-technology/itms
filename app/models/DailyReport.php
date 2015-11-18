<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class DailyReport extends Model {
	protected $table ='job_daily_report';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','user_created','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
    }
    
    public function tasklist()
    {
        return $this->belongsTo('TaskList','tasklist_id','id');
    }
    
    public function project()
    {
        return $this->belongsTo('Project','reference','id');
    }

    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_job_daily_report','id');
    }

    
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
        return $this->tasklist->user->assignment_from;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssignmentTo()
    {
        return $this->tasklist->user->assignment_to;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getJob()
    {
        return $this->job;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTargetFinish()
    {
        return $this->target_finish;
    }

    public function getDateReminder()
    {
        $target = $this->target_finish;
        $reminddate = $target-1;
        return $reminddate;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getActualFinishDate()
    {
        return $this->actual_finish_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getNote()
    {
        return $this->note;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatusDailyReport()
    {
        return $this->status_job_daily_report;
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