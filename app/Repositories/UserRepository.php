<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

use Webpatser\Uuid\Uuid;

class UserRepository implements UserRepositoryInterface 
{
    public function selectById($userId)
	{
		return User::where('id', $userId)->first();
	}

	public function addRoleToUser($userId, $roleId)
	{
		$user = $this->selectById($userId);

		$roleUserId = Uuid::generate()->string;

		$user->roles()->attach($roleId, ["id" => $roleUserId]);

		return $roleUserId;
	}

	public function removeRoleFromUser($userId, $roleId)
	{
		$user = $this->selectById($userId);

		$user->roles()->detach($roleId);
	}

	public function getUserSelectQuery()
	{
		return User::select('id')->addSelect('email');
	}

	public function storeUser($user)
    {
        return $user->save();
	}
	
	public function getUserRoles($userId)
	{
		return Role::
			join('role_user','roles.id', '=', 'role_user.role_id')
			->where('role_user.user_id', $userId)
			->select('role_user.id as id')
			->addSelect('roles.id as reference_id')
			->addSelect('roles.name as name')
			->get();
	}
}