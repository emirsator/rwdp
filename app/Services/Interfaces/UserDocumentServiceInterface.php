<?php
namespace App\Services\Interfaces;
 
interface UserDocumentServiceInterface 
{
    public function getAllUserDocuments($userId);

    public function createUserDocument($path, $contents, $userId);
}