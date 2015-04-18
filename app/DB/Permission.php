<?php 
namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

  /**
	 * users() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function roles()
	{
		return $this->belongsToMany('App\DB\Role', 'permissions_roles');
	}
}