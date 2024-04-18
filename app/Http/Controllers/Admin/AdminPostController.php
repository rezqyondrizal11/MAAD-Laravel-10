<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminPostController extends Controller
{
    public function show()
    {
        $page = 'post';
        $posts = Post::with('rCategory')->with('rUser')->latest()->get();
        // $data = Post::latest()->get();
        return view('admin.post.post_show', compact('posts', 'page'));
    }

    public function delete($slug)
    {
        $delete = Post::where('slug', $slug)->first();

        if (!$delete) {
            return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
        }

        $filePaths = [];

        if ($delete->file != '') {
            $extension = pathinfo($delete->file, PATHINFO_EXTENSION);

            if (in_array($extension, ['jpg', 'png', 'jpeg', 'gif', 'eps', 'psd', 'ai'])) {
                $filePaths = array_merge($filePaths, [
                    'public/uploads/photo/' . $delete->file,
                    'public/uploads/photo/compress/' . $delete->file,
                    'public/uploads/rawphoto/' . $delete->file_mentah,
                ]);
            } elseif (in_array($extension, ['mp4', 'avi', 'mov', 'aep', 'aepx', 'prproj'])) {
                $filePaths = array_merge($filePaths, [
                    'public/uploads/video/' . $delete->file,
                    'public/uploads/rawvideo/' . $delete->file_mentah,
                ]);
            } elseif (in_array($extension, ['mp3', 'm4a', 'wav', 'aup3', 'sesx', 'als'])) {
                $filePaths = array_merge($filePaths, [
                    'public/uploads/audio/' . $delete->file,
                    'public/uploads/rawaudio/' . $delete->file_mentah,
                ]);
            }
        }

        foreach ($filePaths as $filePath) {
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $delete->delete();
        return redirect()->back()->with('success', 'Postingan dan file terkait berhasil dihapus.');
    }
}
