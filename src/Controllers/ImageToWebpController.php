<?php

namespace SimosFasouliotis\ImageToWebp\Controllers;

use Illuminate\Support\Facades\File;
use SimosFasouliotis\ImageToWebp\ImageToWebp;

/**
 * Class ImageToWebpController
 *
 * @package SimosFasouliotis\ImageToWebp\Controllers
 */
class ImageToWebpController
{
    /**
     * @param ImageToWebp $imageToWebp
     * @return string
     */
    public function __invoke(ImageToWebp $imageToWebp): string
    {
        // See if image exists in actual path
        $localPath = public_path(config('imageToWebp.localPathOfImages'));
        $webpPath = public_path(config('imageToWebp.webpPathOfImages'));

        if (request()->route('pathSegment1')) {
            $localPath .= '/'.request()->route('pathSegment1');
            $webpPath .= '/'.request()->route('pathSegment1');
        }
        if (request()->route('pathSegment2')) {
            $localPath .= '/'.request()->route('pathSegment2');
            $webpPath .= '/'.request()->route('pathSegment2');
        }
        $localFilePath = $localPath.'/'.request()->route('filename');
        $webpFilePath = $webpPath.'/'.request()->route('filename');

        $expectedJPGFilePath = str_replace('.webp', '.jpg', $localFilePath);
        $expectedPNGFilePath = str_replace('.webp', '.png', $localFilePath);

        // Check if file exists and is in allowed image formats
        if (!file_exists($expectedJPGFilePath) && !file_exists($expectedPNGFilePath)) {
            abort(404);
        }

        if (file_exists(($expectedJPGFilePath))) {
            $localFilePath = $expectedJPGFilePath;
        }
        if (file_exists(($expectedPNGFilePath))) {
            $localFilePath = $expectedPNGFilePath;
        }

        // Check if webp is already created
        if (file_exists($webpFilePath)) {
            // serve it directly
            return $this->serveFile($webpFilePath);
        }

        // If not created, lets create it
        $im = imagecreatefromstring(file_get_contents($localFilePath));
        imagepalettetotruecolor($im);

        // Check if directory exists, else make it
        // get directory segments to see if directories exist first
        $directorySegments = explode('/', str_replace(public_path(), '', $webpPath));
        $fullDirectorySegment = public_path();
        foreach ($directorySegments as $directorySegment) {
            if ($directorySegment) {
                $fullDirectorySegment .= '/'.$directorySegment;
                if (!file_exists($fullDirectorySegment)) {
                    File::makeDirectory($fullDirectorySegment);
                }
            }
        }

        imagewebp($im, $webpFilePath, 50);

        //$image = $imageToWebp->index();
        return $this->serveFile($webpFilePath);
    }

    /**
     * @param string $file
     * @return false|int
     */
    private function serveFile(string $file)
    {
        header("Content-Type: image/webp");
        header('Content-Length: '.File::size($file));

        return readfile($file);
    }
}
