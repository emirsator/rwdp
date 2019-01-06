<?php

namespace App\Services;

use App\Services\Interfaces\DocumentServiceInterface;
use App\Services\Interfaces\UserDocumentServiceInterface;

use App\Repositories\Interfaces\UserDocumentRepositoryInterface;

use App\Models\UserDocument;

class UserDocumentService implements UserDocumentServiceInterface
{
    protected $documentService;
    protected $userDocumentRepository;

    public function __construct(
        DocumentServiceInterface $documentService,
        UserDocumentRepositoryInterface $userDocumentRepository)
	{
        $this->documentService = $documentService;
        $this->userDocumentRepository = $userDocumentRepository;
    }

    public function getAllUserDocuments($userId)
    {
        return $this->userDocumentRepository->getAllUserDocuments($userId);
    }

    public function createUserDocument($path, $contents, $userId)
    {
        $documentId = $this->documentService->createDocument($path, $contents);

        $newUserDocument = new UserDocument;
        $newUserDocument->user_id = $userId;
        $newUserDocument->document_id = $documentId;

        $this->userDocumentRepository->createUserDocument($newUserDocument);

        return $newUserDocument->id;
    }
}