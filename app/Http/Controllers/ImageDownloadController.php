<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageDownloadController extends Controller
{
    public function download(Image $image)
    {
        $path = Storage::disk('public')->path($image->url);
        if (!file_exists($path)) {
            abort(404, 'Fichier introuvable');
        }

        $mime = mime_content_type($path);
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        $source = match(true) {
            str_contains($mime, 'jpeg') || $ext === 'jpg' => imagecreatefromjpeg($path),
            str_contains($mime, 'png')                    => imagecreatefrompng($path),
            str_contains($mime, 'webp')                   => imagecreatefromwebp($path),
            str_contains($mime, 'gif')                    => imagecreatefromgif($path),
            default                                        => abort(415, 'Format non supporté'),
        };

        $srcW = imagesx($source);
        $srcH = imagesy($source);

        $wmPath    = public_path('images/Toolkit_rpg.png');
        $watermark = imagecreatefrompng($wmPath);
        $wmOrigW   = imagesx($watermark);
        $wmOrigH   = imagesy($watermark);

        // ✅ 30% de la largeur source (image 200px → watermark 60px, visible)
        $wmNewW = (int)($srcW * 0.025);
        $wmNewH = (int)($wmOrigH * ($wmNewW / $wmOrigW));

        $wmResized = imagecreatetruecolor($wmNewW, $wmNewH);
        imagealphablending($wmResized, false);
        imagesavealpha($wmResized, true);
        imagecopyresampled($wmResized, $watermark, 0, 0, 0, 0, $wmNewW, $wmNewH, $wmOrigW, $wmOrigH);

        $margin = 10;
        $destX  = $srcW - $wmNewW - $margin;
        $destY  = $srcH - $wmNewH - $margin;

        // ✅ Opacité 20% — visible même sur petite image
        $this->imagecopymergeAlpha($source, $wmResized, $destX, $destY, 0, 0, $wmNewW, $wmNewH, 0);

        $filename  = pathinfo($image->url, PATHINFO_FILENAME) . '_dl.' . $ext;

        ob_start();
        match($ext) {
            'jpg', 'jpeg' => imagejpeg($source, null, 95),
            'png'         => imagepng($source),
            'webp'        => imagewebp($source),
            'gif'         => imagegif($source),
        };
        $imageData = ob_get_clean();

        imagedestroy($source);
        imagedestroy($watermark);
        imagedestroy($wmResized);

        return response($imageData, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    private function imagecopymergeAlpha($dst, $src, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH, $pct)
    {
        $cut = imagecreatetruecolor($srcW, $srcH);
        imagecopy($cut, $dst, 0, 0, $dstX, $dstY, $srcW, $srcH);
        imagecopy($cut, $src, 0, 0, $srcX, $srcY, $srcW, $srcH);
        imagecopymerge($dst, $cut, $dstX, $dstY, 0, 0, $srcW, $srcH, $pct);
        imagedestroy($cut);
    }
}
