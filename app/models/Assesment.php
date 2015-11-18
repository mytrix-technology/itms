<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Assesment extends Model {
	protected $table ='project'; // inisialisasi tabel project
    
    public $timestamps = TRUE; // timestamps sets TRUE
    
    // relationship table user menggunakan rule Eloquent ORM
    public function user()
    {
        return $this->belongsTo('User','assesment_user','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
    }
    
    // relationship table master aplikasi menggunakan rule Eloquent ORM
    public function masterapps()
    {
        return $this->belongsTo('MasterApps','master_apps_id','id');
    }
    
    // relationship table master modul menggunakan rule Eloquent ORM
    public function mastermodul()
    {
        return $this->belongsTo('MasterModul','master_modul_id','id');
    }
    
    // relationship table master tipe proyek menggunakan rule Eloquent ORM
    public function masterprojecttype()
    {
        return $this->belongsTo('MasterProjectType','master_type_project_id','id');
    }
    
    // relationship table master status menggunakan rule Eloquent ORM
    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_project_request','id');
    }

    public function historyassesment()
    {
        return $this->hasMany('HistoryAssesment','project_id','id');
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
    public function getAssesmentFile()
    {
        return $this->assesment_file;
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

class HistoryAssesment extends Model {

    protected $table ='project_assesment_history';
    
    public $timestamps = TRUE;

    public function assesment()
    {
        return $this->belongsTo('Assesment','project_id','id');
    }

    public function user()
    {
        return $this->belongsTo('User','user_created','id');
    }

    public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
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
        return $this->assesment->name_project;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getTitleHistory()
    {
        return $this->title_history;
    }

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getNoteHistory()
    {
        return $this->note_history;
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