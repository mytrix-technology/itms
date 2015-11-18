<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MasterApps extends Model {
	protected $table ='master_apps';
    
    public $timestamps = TRUE;
    
    public function user()
    {
        return $this->belongsTo('User','development_by','id');
    }
    
    public function mastermodul()
    {
        return $this->hasMany('MasterModul');
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
    public function getNameApps()
    {
        return $this->name_apps;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDescApps()
    {
        return $this->desc_apps;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getBuildDate()
    {
        return $this->build_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getDevBy()
    {
        return $this->development_by;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getVersion()
    {
        return $this->version;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getNote()
    {
        return $this->note;
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