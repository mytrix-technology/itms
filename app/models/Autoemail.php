<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Autoemail extends Model {
    protected $connection = 'mysqlemail';
	protected $table ='autoemail_t';
    
    public $timestamps = TRUE;
    
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
    public function getDescProject()
    {
        return $this->desc_project;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssesmentDate()
    {
        return $this->assesment_date;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssesmentUser()
    {
        return $this->user->username;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAssesmentNote()
    {
        return $this->assesment_note;
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
