<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MasterDB extends Model {
	protected $table ='master_db';

	public $timestamps = TRUE;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function dailyBackupDB()
	{
		return $this->hasMany('DailyBackupDB');
	}

	public function monthlyBackupDB()
	{
		return $this->hasMany('MonthlyBackupDB');
	}
    
    public function masterstatus()
    {
        return $this->belongsTo('MasterStatus','status_project_request','id');
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
	public function getServerName()
	{
		return $this->server_name;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getDatabaseName()
	{
		return $this->database_name;
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