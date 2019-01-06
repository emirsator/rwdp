<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleUser;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface 
{
    public function selectAll()
	{
		return Role::all();
	}

	public function selectById($roleId)
	{
		return Role::where('id', $roleId)->first();
	}

	public function selectRoleUserById($id)
	{
		return RoleUser::where('id', $id)->first();
	}
}