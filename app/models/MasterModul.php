<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MasterModul extends Model {
	protected $table ='master_modul';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function masterapps()
    {
        return $this->belongsTo('MasterApps', 'master_apps_id', 'id');
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
    public function getNameModul()
    {
        return $this->name_modul;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescModul()
    {
        return $this->desc_modul;
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
    public function getStatus()
    {
        return $this->masterstatus->status_name;
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