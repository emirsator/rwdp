<?php
namespace App\Services\Interfaces;
 
interface UserServiceInterface 
{
    public function selectById($userId);
    
    public function getUnassignedRoles($userId);

    public function addRoleToUser($userId, $roleId);

    public function removeRoleFromUser($userId, $roleId);

    public function getUserSelectQuery();

    public function storeUser($user);

    public function getUserRoles($userId);
}