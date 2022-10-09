<?php
namespace SimosFasouliotis\ImageToWebp\Controllers;

use Illuminate\Http\Request;
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
        $image = $imageToWebp->index();
        return $image;
    }
}
