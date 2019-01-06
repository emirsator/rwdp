<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use App\Services\Interfaces\DocumentServiceInterface;

use App\Repositories\Interfaces\DocumentRepositoryInterface;

use App\Models\Document;

class DocumentService implements DocumentServiceInterface 
{
	protected $documentRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository)
	{
        $this->documentRepository = $documentRepository;
	}
	
    public function createDocument($path, $contents)
	{
		$result = Storage::put($path, $contents);

		if(!isset($result) || empty($result))
        {
            throw new Exception(Lang::get('errors.file-not-stored-on-disk'));
		}
		
		$newDocument = new Document;
		$newDocument->path = $result;
		$newDocument->name = $contents->getClientOriginalName();

		$this->documentRepository->createDocument($newDocument);

		return $newDocument->id;
	}
}