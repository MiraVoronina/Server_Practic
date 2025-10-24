<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;

class ImageUploadController extends Controller
{
    public function uploadOrderPhoto(UploadedFile $file)
    {
        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

        $uploadPath = public_path('uploads/equipment');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file->move($uploadPath, $fileName);

        return $fileName;
    }

    public function deleteOrderPhoto($fileName)
    {
        if (!$fileName) {
            return false;
        }

        $filePath = public_path('uploads/equipment/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }

        return false;
    }

    public function getOrderPhotoUrl($fileName)
    {
        if ($fileName) {
            return asset('uploads/equipment/' . $fileName);
        }

        return null;
    }
}
