<?php 
namespace App\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $permissions;

	public function permissions()
	{
		return $this->role->permissions;
	}

	public function role()
	{
		return $this->belongsTo('App\DB\Role');
	}

	public function can($permission_slug)
	{
		$permissions = $this->permissions();

		foreach ($permissions as $permission) {
			if ($permission->slug == $permission_slug) return true;
		}

		return false;
	}

	public function fullName()
	{
		return $this->first_name.' '.$this->last_name;
	}
	
}
