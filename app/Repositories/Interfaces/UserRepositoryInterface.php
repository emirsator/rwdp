<?php
namespace App\Repositories\Interfaces;
 
interface UserRepositoryInterface 
{
	public function selectById($userId);

	public function addRoleToUser($userId, $roleId);

	public function removeRoleFromUser($userId, $roleId);

	public function getUserSelectQuery();

	public function storeUser($user);

	public function getUserRoles($userId);
}