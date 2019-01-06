<?php
namespace App\Repositories\Interfaces;
 
interface RoleRepositoryInterface 
{
	public function selectAll();

	public function selectById($userId);

	public function selectRoleUserById($id);
}