<?php

namespace App\Tests\Service;

use App\Service\FileUploader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadTest extends TestCase
{
  public function testFileName()
  {
    // Testa se o nome do arquivo mandado por upload 
    // é diferente do nome computador, para que cada imagem no 
    // servidor possua um nome diferente
    $fileLocation = "C:\\Users\\andre\\projeto\\photo_upload_auryn\\tests\\service\\testFile.jpg";
    $fileName = 'testFile.jpg';

    $uploader = new FileUploader('photo_directory');
    $result = $uploader->upload(new UploadedFile($fileLocation, $fileLocation));

    $this->assertNotEquals($fileName, $result);
  }
}
