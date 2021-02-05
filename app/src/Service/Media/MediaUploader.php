<?php


namespace App\Service\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaUploader
{
    /** @var UploadedFile */
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function upload()
    {
        
    }
}
