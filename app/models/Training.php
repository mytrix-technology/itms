<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Training extends Model {
	protected $table ='project';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','trainer','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
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
        return $this->user->username;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTrainingFile()
    {
        return $this->training_file;
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