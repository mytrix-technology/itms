<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Design extends Model {
	    
	protected $table ='design_apps';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','user_created','id');
    }

    public function tasklist()
    {
        return $this->hasMany('TaskList');
    }

    public function project()
    {
        return $this->belongsTo('Project','project_id','id');
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
    public function getDesignVersion()
    {
        return $this->design_name_version;
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
    public function getUserCreated()
    {
        return $this->user->username;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    /*public function getUserUpdated()
    {
        return $this->user1->username;
    }*/

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