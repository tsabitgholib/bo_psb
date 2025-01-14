<?php

namespace App\Http\Controllers;

use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function showMediaForm()
    {
        $media = Media::latest()->first(); // Mengambil media terbaru
        return view('media.uploadMedia', compact('media'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'media_key' => 'required|in:media_1,media_2,media_3,media_4,media_5',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4|max:2048',
        ]);

        // Media key yang dipilih (e.g., 'media_1')
        $mediaKey = $request->input('media_key');
        $file = $request->file('file');

        // Cari media pertama
        $media = Media::latest()->first();

        // Upload file ke Cloudinary
        $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();

        // Update atau buat media
        if ($media) {
            $media->update([$mediaKey => $uploadedFileUrl]);
        } else {
            Media::create([$mediaKey => $uploadedFileUrl]);
        }

        return back()->with('success', 'Media uploaded successfully.');
    }

    public function deleteMedia(Request $request, $id)
    {
        $request->validate([
            'media_key' => 'required|in:media_1,media_2,media_3,media_4,media_5',
        ]);

        // Cari media berdasarkan ID
        $media = Media::find($id);

        if ($media) {
            $mediaKey = $request->input('media_key');

            // Hapus dari Cloudinary jika ada
            if ($media->$mediaKey) {
                Cloudinary::destroy($media->$mediaKey);
                $media->update([$mediaKey => null]); // Set null di database
            }

            return back()->with('success', 'Media deleted successfully.');
        }

        return back()->with('error', 'Media not found.');
    }
}
