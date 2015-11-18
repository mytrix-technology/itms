<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Testing extends Model {
	protected $table ='design_apps';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','user_updated','id');
    }

    public function project()
    {
        return $this->belongsTo('Project','project_id','id');
    }
    
    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_sit','id');
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
    public function getNameApps()
    {
        return $this->project->name_project;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDesignTable()
    {
        return $this->design_table_file;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescDesignTable()
    {
        return $this->desc_table_file;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDesignForm()
    {
        return $this->design_form_file;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescDesignForm()
    {
        return $this->desc_form_file;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getRule()
    {
        return $this->rule;
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
    public function getRequirementTesting()
    {
        return $this->requirement_testing;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSit()
    {
        return $this->sit;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSitDate()
    {
        return $this->sit_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSitStatus()
    {
        return $this->masterstatus->status_name;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserUpdated()
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