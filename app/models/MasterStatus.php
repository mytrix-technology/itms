<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MasterStatus extends Model {
	protected $table ='master_status';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function mastermodul()
    {
        return $this->hasMany('MasterModul');
    }
    
    public function project()
    {
        return $this->hasMany('Project');
    }
    
    public function tasklist()
    {
        return $this->hasMany('TaskList');
    }
    
    public function testing()
    {
        return $this->hasMany('Testing');
    }

    public function dailyreport()
    {
        return $this->hasMany('DailyReport');
    }

    public function dailybackupDB()
    {
        return $this->hasMany('DailyBackupDB');
    }

    public function monthlybackupDB()
    {
        return $this->hasMany('MonthlyBackupDB');
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
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatusName()
    {
        return $this->status_name;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatusDesc()
    {
        return $this->status_desc;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getActivated()
    {
        return $this->activated;
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