<?php
namespace App\Repositories\Interfaces;
 
interface UserDocumentRepositoryInterface 
{
	public function getAllUserDocuments($userId);

	public function createUserDocument($userDocument);
}