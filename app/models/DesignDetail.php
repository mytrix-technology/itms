<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class DesignDetail extends \Eloquent {
	protected $table ='design_testing_detail';
    
    public $timestamps = TRUE;
    
    public function design()
    {
        return $this->belongsTo('Design');
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
    public function getNoForm()
    {
        return $this->design['no_formulir'];
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getName()
    {
        return $this->name;
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
    public function getFileName()
    {
        return $this->file_name;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getFilePath()
    {
        return $this->file_path;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTimeline()
    {
        return $this->timeline;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatus()
    {
        return $this->status;
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
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Saves the permission.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = array())
    {
        $this->validate();

        return parent::save($options);
    }
}