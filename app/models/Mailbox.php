<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Mailbox extends Model {
	protected $table ='autoemail'; // inisialisasi tabel autoemail
    
    public $timestamps = TRUE; // timestamps sets TRUE

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
    public function getMailTo()
    {
        return $this->mailto;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMailFrom()
    {
        return $this->mailfrom;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getCC()
    {
        return $this->cc;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getJudul()
    {
        return $this->judul;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getStatusSent()
    {
        return $this->status_sent;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserCreated()
    {
        return $this->user_created;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getUserUpdated()
    {
        return $this->user_updated;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
