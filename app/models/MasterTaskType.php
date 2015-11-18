<?php
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Collection;

class MasterTaskType extends Model {
	protected $table ='master_task_type';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function tasklist()
    {
        return $this->hasMany('TaskList');
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
    public function getNameTaskType()
    {
        return $this->name_task_type;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescTaskType()
    {
        return $this->desc_task_type;
    }

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