<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(
        UserRepositoryInterface $userRepository, 
        RoleRepositoryInterface $roleRepository)
	{
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function selectById($userId)
    {
        return $this->userRepository->selectById($userId);
    }

    public function getUnassignedRoles($userId)
    {
        $allRoles = $this->roleRepository->selectAll();

        $userRoles = $this->userRepository->selectById($userId)->roles();

        return $allRoles->whereNotIn('id', $userRoles->pluck('role_id'));
    }

    public function addRoleToUser($userId, $roleId)
    {
        return $this->userRepository->addRoleToUser($userId, $roleId);
    }

    public function removeRoleFromUser($userId, $roleId)
    {
        $this->userRepository->removeRoleFromUser($userId, $roleId);
    }

    public function getUserSelectQuery()
    {
        return $this->userRepository->getUserSelectQuery();
    }

    public function storeUser($user)
    {
        $this->userRepository->storeUser($user);
    }

    public function getUserRoles($userId)
    {
        return $this->userRepository->getUserRoles($userId);
    }
}