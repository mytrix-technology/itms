<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class MonthlyBackupDB extends Model {
	protected $table ='backup_db_monthly';

	public $timestamps = TRUE;

	public function user()
	{
		return $this->belongsTo('User','user_backup','id');
	}

	public function user1()
    {
        return $this->belongsTo('User','user_updated','id');
    }

	public function masterDB()
	{
		return $this->belongsTo('MasterDB','id_master_DB','id');
	}

	public function masterstatus()
	{
		return $this->belongsTo('MasterStatus','id_master_status','id');
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
	public function getMasterDB()
	{
		return $this->masterDB->database_name;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getPeriod()
	{
		return $this->period;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getUserBackup()
	{
		return $this->user->username;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getBackupDate()
	{
		return $this->backup_date;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getMasterStatus()
	{
		return $this->masterstatus->status_name;
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
	public function getReceiverDate()
	{
		return $this->receiver_date;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getStatusActivated()
	{
		return $this->masterstatus->status_name;
	}

	/**
	 * Return the name of the permission
	 * @return string name of the permission
	 */
	public function getActivated()
	{
		return $this->activated;
	}

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