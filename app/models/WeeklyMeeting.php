<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class WeeklyMeeting extends Model {
    protected $table ='weekly_meeting';
    
    public $timestamps = TRUE;

    public function user()
    {
        return $this->belongsTo('User','user_created','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','weekly_meeting_trainer','id');
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
    public function getWeeklyMeetingSubject()
    {
        return $this->weekly_meeting_subject;
    }

    public function getWeeklyMeetingDate()
    {
        return $this->weekly_meeting_date;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getWeeklyMeetingTrainer()
    {
        return $this->user1->username;
    }

    public function getWeeklyMeetingUser()
    {
        return $this->weekly_meeting_user;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getWeeklyMeetingNote()
    {
        return $this->weekly_meeting_note;
    }

    public function getWeeklyMeetingTime()
    {
        return $this->weekly_meeting_time;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getWeeklyMeetingFile()
    {
        return $this->weekly_meeting_file;
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