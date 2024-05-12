<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class FrontHomeController extends Controller
{
    public function index(Request $request)
    {
        // echo phpinfo();
        // die;
        $userLogin = Auth::user();
        if ($userLogin) {
            $user = User::where('id', $userLogin->id)->first();
            $today = Carbon::now();
            if ($user->premium_expiry < $today) {
                $user->role = 'umum';
                $user->premium_expiry = null;
                $user->update();
            }
        }

        // $response = Http::get('http://127.0.0.1:8000/api/user/index');

        // $post = $response->json();

        $search = $request->input('search');
        $reso = Post::query()->distinct()->select('resolution')->get();
        $extensions = ['png', 'jpg', 'jpeg', 'mp4', 'mkv', 'webm', 'mp3', 'm4a'];
        $post = Post::where('name', 'like', '%' . $search . '%')
            ->where(function ($query) use ($extensions, $search) {
                $query->where('file', 'like', '%' . $extensions[0])
                    ->orWhere('file', 'like', '%' . $extensions[1])
                    ->orWhere('file', 'like', '%' . $extensions[2])
                    ->orWhere('file', 'like', '%' . $extensions[3])
                    ->orWhere('file', 'like', '%' . $extensions[4])
                    ->orWhere('file', 'like', '%' . $extensions[5])
                    ->orWhere('file', 'like', '%' . $extensions[6])
                    ->orWhere('file', 'like', '%' . $extensions[7])
                    ->orWhere('name', 'like', '%' . $search . '%');
            })->orWhere('url', 'like', '%' . $search . '%')
            ->latest()
            ->with('rUser')
            ->paginate(12);
        return view('frontend.home', compact('post', 'reso'));
    }
    public function photo(Request $request)
    {
        $search = $request->input('search_photo');
        $extensions = ['png', 'jpg', 'jpeg'];

        $post = Post::whereHas('rCategory', function ($query) {
            $query->where('id', 3);
        })->where(function ($query) use ($search, $extensions) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere(function ($subquery) use ($search, $extensions) {
                    $subquery->where('file', 'like', '%' . $extensions[0])
                        ->orWhere('file', 'like', '%' . $extensions[1])
                        ->orWhere('file', 'like', '%' . $extensions[2]);
                })
                ->orWhere('url', 'like', '%' . $search . '%')
                ->orWhere('urlgd', 'like', '%' . $search . '%');
        })->latest()
            ->with('rUser')
            ->paginate(12);

        $reso = Post::query()->distinct()->select('resolution')->get();
        return view('frontend.home', compact('post', 'reso'));
    }

    public function reso(Request $request, $ukuran)
    {
        $search = $request->input('search_photo');
        $pattern = 'photo';
        // $post = Post::where('name', 'like', '%' . $search . '%')->Where('file', 'like', '%' . $pattern . '%')->latest()->with('rUser')->get();
        $post = Post::where('resolution', $ukuran)->where('name', 'like', '%' . $search . '%')->Where('file', 'like', '%' . $pattern . '%')->latest()->with('rUser')->paginate(8);
        $reso = Post::query()->distinct()->select('resolution')->get();
        return view('frontend.home', compact('post', 'reso'));
    }

    public function video(Request $request)
    {
        $search = $request->input('search_video');
        $extensions = ['mp4', 'mkv', 'webm'];

        $post = Post::whereHas('rCategory', function ($query) {
            $query->where('id', 4);
        })
            ->where(function ($query) use ($search, $extensions) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere(function ($subquery) use ($search, $extensions) {
                        $subquery->where('file', 'like', '%' . $extensions[0])
                            ->orWhere('file', 'like', '%' . $extensions[1])
                            ->orWhere('file', 'like', '%' . $extensions[2]);
                    })
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('urlgd', 'like', '%' . $search . '%');
            })
            ->latest()
            ->with('rUser')
            ->paginate(12);

        $reso = Post::query()->distinct()->select('resolution')->get();

        return view('frontend.home', compact('post', 'reso'));
    }

    public function audio(Request $request)
    {
        // $search = $request->input('search_audio');
        // $pattern = 'audio';
        // $post = Post::where('name', 'like', '%' . $search . '%')->Where('file', 'like', '%' . $pattern . '%')->latest()->paginate(12);
        // $reso = Post::query()->distinct()->select('resolution')->get();

        $search = $request->input('search_audio');
        $extensions = ['mp3', 'm4a'];

        $post = Post::whereHas('rCategory', function ($query) {
            $query->where('id', 5);
        })
            ->where(function ($query) use ($search, $extensions) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere(function ($subquery) use ($search, $extensions) {
                        $subquery->where('file', 'like', '%' . $extensions[0])
                            ->orWhere('file', 'like', '%' . $extensions[1]);
                    })
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('urlgd', 'like', '%' . $search . '%');
            })
            ->latest()
            ->with('rUser')
            ->paginate(12);

        $reso = Post::query()->distinct()->select('resolution')->get();

        return view('frontend.home', compact('post', 'reso'));
    }
    public function detail($slug)
    {
        $page = 'detail';
        $post = Post::where('slug', $slug)->first();
        $posts = Post::inRandomOrder()->limit(8)->with('rUser')->where('slug', '<>', $slug)->get();
        $like = Like::where('post_id', $post->id)->count();
        $url = url('detail/' . $post->slug);
        $message = 'File from <a href="' . $url . '">' . $post->rUser->name . '</a> by UNP Asset';

        return view('frontend.detailhome', compact('post', 'posts', 'like', 'url', 'message', 'page'));
    }

    // public function detail_720p($slug)
    // {
    //     $page = '720p';
    //     $post = Post::where('slug', $slug)->first();
    //     $posts = Post::inRandomOrder()->limit(8)->with('rUser')->get();
    //     $like = Like::where('post_id', $post->id)->count();
    //     $url = url('detail/' . $post->id . '/' . $post->rUser->name);
    //     $message = 'File from <a href="' . $url . '">' . $post->rUser->name . '</a> by UNP Asset';
    //     return view('frontend.detailhome', compact('post', 'posts', 'like', 'url', 'message', 'page'));
    // }

    // public function detail_480p($slug)
    // {
    //     $page = '480p';
    //     $post = Post::where('slug', $slug)->first();
    //     $posts = Post::inRandomOrder()->limit(8)->with('rUser')->get();
    //     $like = Like::where('post_id', $post->id)->count();
    //     $url = url('detail/' . $post->id . '/' . $post->rUser->name);
    //     $message = 'File from <a href="' . $url . '">' . $post->rUser->name . '</a> by UNP Asset';
    //     return view('frontend.detailhome', compact('post', 'posts', 'like', 'url', 'message', 'page'));
    // }

    // public function detail_360p($slug)
    // {
    //     $page = '360p';
    //     $post = Post::where('slug', $slug)->first();
    //     $posts = Post::inRandomOrder()->limit(8)->with('rUser')->get();
    //     $like = Like::where('post_id', $post->id)->count();
    //     $url = url('detail/' . $post->id . '/' . $post->rUser->name);
    //     $message = 'File from <a href="' . $url . '">' . $post->rUser->name . '</a> by UNP Asset';
    //     return view('frontend.detailhome', compact('post', 'posts', 'like', 'url', 'message', 'page'));
    // }


    public function download($file)
    {
        $path_photo = public_path('uploads/photo/' . $file);
        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
        if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg') {
            $path = public_path('uploads/photo/' . $file);

            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_video = public_path('uploads/video/' . $file);
        $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);
        if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
            $path = public_path('uploads/video/' . $file);

            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_audio = public_path('uploads/audio/' . $file);
        $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);
        if ($extaudio == 'mp3' || $extaudio == 'm4a') {
            $path = public_path('uploads/audio/' . $file);

            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        // $publicId720 = $file->cPublicId720;
        // $publicId480 = $file->cPublicId480;
        // $publicId360 = $file->cPublicId360;

        // $path_video720 = $publicId720;
        // $extvideo = pathinfo($path_video720, PATHINFO_EXTENSION);
        // if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
        //     $url720p = Cloudinary::privateDownloadUrl($publicId720);

        //     if ($url720p) {
        //         return response()->download($url720p);
        //     } else {
        //         return response()->json(['error' => 'Video not found'], 404);
        //     }
        // }
        // $path_video480 = $publicId480;
        // $extvideo = pathinfo($path_video480, PATHINFO_EXTENSION);
        // if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
        //     $url480p = Cloudinary::privateDownloadUrl($publicId480);

        //     if ($url480p) {
        //         return response()->redirectTo($url480p);
        //     } else {
        //         return response()->json(['error' => 'Video not found'], 404);
        //     }
        // }
        // $path_video360 = $publicId360;
        // $extvideo = pathinfo($path_video360, PATHINFO_EXTENSION);
        // if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
        //     $url360p = Cloudinary::privateDownloadUrl($publicId360);

        //     if ($url360p) {
        //         return response()->redirectTo($url360p);
        //     } else {
        //         return response()->json(['error' => 'Video not found'], 404);
        //     }
        // }
        // $path_video = $publicId;
        // $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);
        // if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
        //     $urlOriginal = Cloudinary::privateDownloadUrl($publicId);

        //     if ($urlOriginal) {
        //         return response()->redirectTo($urlOriginal);
        //     } else {
        //         return response()->json(['error' => 'Video not found'], 404);
        //     }
        // }
    }

    public function downloadRaw($file)
    {
        $path_raw_photo = public_path('uploads/rawphoto/' . $file);
        $extrawphoto = pathinfo($path_raw_photo, PATHINFO_EXTENSION);
        if ($extrawphoto == 'eps' || $extrawphoto == 'psd' || $extrawphoto == 'ai' || $extrawphoto == 'cdr') {
            $path = $path_raw_photo;
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_raw_video = public_path('uploads/rawvideo/' . $file);
        $extrawvideo = pathinfo($path_raw_video, PATHINFO_EXTENSION);
        if ($extrawvideo == 'aep' || $extrawvideo == 'aepx' || $extrawvideo == 'prproj') {
            $path = $path_raw_video;
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        if (($extrawphoto == 'zip' || $extrawphoto == 'rar') && file_exists($path_raw_photo)) {
            $path = public_path('uploads/rawphoto/' . $file);
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        if (($extrawvideo == 'zip' || $extrawvideo == 'rar') && file_exists($path_raw_video)) {
            $path = public_path('uploads/rawvideo/' . $file);
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_raw_audio = public_path('uploads/rawaudio/' . $file);
        $extrawaudio = pathinfo($path_raw_audio, PATHINFO_EXTENSION);
        if (($extrawaudio == 'zip' || $extrawaudio == 'rar') && file_exists($path_raw_audio)) {
            $path = public_path('uploads/rawaudio/' . $file);
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }
    }

    public function downloadVideo($filename, $quality = 'original')
    {
        // Mengambil data post dari database berdasarkan slug
        $post = Post::where('slug', $filename)->first();

        // Memastikan post ditemukan
        if (!$post) {
            abort(404, 'Post not found');
        }

        // Memilih URL video sesuai dengan kualitas yang diminta
        switch ($quality) {
            case 'q720p':
                $videoUrl = $post->q720p;
                break;
            case 'q480p':
                $videoUrl = $post->q480p;
                break;
            case 'q360p':
                $videoUrl = $post->q360p;
                break;
            case 'original':
            default:
                $videoUrl = $post->file;
        }

        // Mendapatkan nama file dari URL
        $fileName = pathinfo($videoUrl)['filename'];

        // Mendapatkan ekstensi file dari URL
        $fileExtension = pathinfo($videoUrl, PATHINFO_EXTENSION);

        // Menggunakan cURL untuk mengunduh file
        $ch = curl_init($videoUrl);
        $fp = fopen(storage_path("app/public/uploads/video/{$fileName}.{$fileExtension}"), 'w');

        // Mengatur opsi cURL
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Mengeksekusi cURL untuk mengunduh file
        curl_exec($ch);

        // Menutup koneksi cURL dan file yang diunduh
        curl_close($ch);
        fclose($fp);

        // Memberikan response untuk mengunduh file
        $response = response()->download(storage_path("app/public/uploads/video/{$fileName}.{$fileExtension}"));

        // Menghapus file setelah response terkirim
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function linkUser($slug)
    {
        $post = Post::with('rUser')->where('slug', $slug)->first();

        if ($post) {
            $like = Like::where('post_id', $post->id)->count();
            $url = url('detail/' . $post->slug);
            $message = 'klik link <a href="' . $url . '">ini</a>';
            return view('frontend.detailhome', compact('url', 'post', 'like', 'message'));
        } else {
            echo "nothing";
        }
    }
}
