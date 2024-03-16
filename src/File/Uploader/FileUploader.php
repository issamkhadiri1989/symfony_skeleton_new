<?php

namespace App\File\Uploader;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

final class FileUploader
{
    public function __construct(
        private readonly SluggerInterface $slugger,
        // #[Autowire('%app.application.upload_dir%')]
        private readonly string $targetDir,
    ) {
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = \pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME);

        // create a slug from the original filename
        $safeFilename = $this->slugger->slug($originalFilename);

        $newFilename = \sprintf('%s_%s.%s', $safeFilename, time(), $file->guessExtension());

        // perform uploading
        $file->move($this->targetDir, $newFilename);

        return $newFilename;
    }
}
