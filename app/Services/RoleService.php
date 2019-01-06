<?php

namespace App\Services;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface 
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
	{
		$this->roleRepository = $roleRepository;
    }

    public function selectAll()
	{
		return $this->roleRepository->selectAll();
	}

	public function selectById($roleId)
    {
        return $this->roleRepository->selectById($roleId);
    }

    public function selectRoleUserById($id)
    {
        return $this->roleRepository->selectRoleUserById($id);
    }
}