<?php
namespace App\Services\Interfaces;
 
interface RoleServiceInterface 
{
	public function selectAll();

	public function selectById($roleId);

	public function selectRoleUserById($id);
}