<?php

declare(strict_types=1);

namespace Resizer;


class ImageResizer
{

    private \Imagine\Gd\Imagine $imagine;

    public function __construct(
        private int $imageWidth,
        private int $imageHeight,
        private array $extensions = [
            "jpg",
            "png",
            "jpeg"
        ]
    ) {
        $this->imagine = new \Imagine\Gd\Imagine();
    }


    public function resizeAllImages($dir)
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {

                // Check if it is an image
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array($ext, $this->extensions)) {

                    $this->imagine->open($path)
                        ->thumbnail(new \Imagine\Image\Box($this->imageWidth, $this->imageHeight))
                        ->save($path);
                }
            } elseif ($value !== "." && $value !== "..") {
                $this->resizeAllImages($path);
            }
        }

    }
}