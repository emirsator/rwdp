<?php
namespace App\Services\Interfaces;
 
interface DocumentServiceInterface 
{
	public function createDocument($path, $contents);
}