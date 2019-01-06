<?php

namespace App\Repositories;

use App\Models\UserDocument;
use App\Repositories\Interfaces\UserDocumentRepositoryInterface;

class UserDocumentRepository implements UserDocumentRepositoryInterface 
{
    public function getAllUserDocuments($userId)
	{
		return UserDocument::where('user_id', $userId)->get();
	}

	public function createUserDocument($userDocument)
	{
		return $userDocument->save();
    }
}