<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Like;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SubCategoryPost;
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

        $selectedSubCategoryId = $request->input('sub_category_id');
        $subcategory = SubCategory::get();
        $subCategoryPostIds = SubCategoryPost::where('sub_category_id', $selectedSubCategoryId)->pluck('post_id');

        $extensions = ['png', 'jpg', 'jpeg', 'mp4', 'mkv', 'webm', 'mp3', 'm4a'];
        if ($selectedSubCategoryId) {
            $post = Post::WhereIn('id', $subCategoryPostIds)
                ->where('status', 'Selesai')
                ->latest()
                ->with('rUser')
                ->paginate(12);
        } else {
            $post = Post::where('name', 'like', '%' . $search . '%')
                ->where('status', 'Selesai')
                ->where(function ($query) use ($extensions, $search) {
                    $query->orWhereIn('file', $extensions);
                    $query->orWhere('name', 'like', '%' . $search . '%');
                })->orWhere('url', 'like', '%' . $search . '%')
                ->where('status', 'Selesai')
                ->latest()
                ->with('rUser')
                ->paginate(12);
        }


        return view('frontend.home', compact('post', 'reso', 'subcategory'));
    }
    public function photo(Request $request)
    {
        $search = $request->input('search_photo');
        $reso = Post::query()->distinct()->select('resolution')->get();

        $selectedSubCategoryId = $request->input('sub_category_id_photo');
        $subcategory = SubCategory::get();
        $subCategoryPostIds = SubCategoryPost::where('sub_category_id', $selectedSubCategoryId)->pluck('post_id');

        $extensions = ['png', 'jpg', 'jpeg'];
        if ($selectedSubCategoryId) {
            $post = Post::whereIn('id', $subCategoryPostIds)
                ->where('status', 'Selesai')
                ->latest()
                ->with('rUser')
                ->paginate(12);
        } else {
            $post = Post::whereHas('rCategory', function ($query) {
                $query->where('id', 3);
            })
                ->where('status', 'Selesai')
                ->where(function ($query) use ($search, $extensions) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere(function ($subquery) use ($extensions) {
                            $subquery->whereIn('file', $extensions);
                        })
                        ->orWhere('url', 'like', '%' . $search . '%')
                        ->orWhere('urlgd', 'like', '%' . $search . '%');
                })->latest()
                ->with('rUser')
                ->paginate(12);
        }
        return view('frontend.home', compact('post', 'reso', 'subcategory'));
    }

    public function reso(Request $request, $ukuran)
    {
        $search = $request->input('search_photo');
        $pattern = 'photo';
        // $post = Post::where('name', 'like', '%' . $search . '%')->Where('file', 'like', '%' . $pattern . '%')->latest()->with('rUser')->get();
        $post = Post::where('resolution', $ukuran)->where('status', 'Selesai')->where('name', 'like', '%' . $search . '%')->Where('file', 'like', '%' . $pattern . '%')->latest()->with('rUser')->paginate(8);
        $reso = Post::query()->distinct()->select('resolution')->get();
        $subcategory = SubCategory::get();
        return view('frontend.home', compact('post', 'reso', 'subcategory'));
    }

    public function video(Request $request)
    {
        $search = $request->input('search_video');
        $reso = Post::query()->distinct()->select('resolution')->get();

        $selectedSubCategoryId = $request->input('sub_category_id_video');
        $subcategory = SubCategory::get();
        $subCategoryPostIds = SubCategoryPost::where('sub_category_id', $selectedSubCategoryId)->pluck('post_id');

        $extensions = ['mp4', 'mkv', 'webm'];

        if ($selectedSubCategoryId) {
            // $post = Post::whereIn('id', $subCategoryPostIds)
            //     ->where('status', 'Pending')
            //     ->where(function ($query) use ($extensions) {
            //         $query->where(function ($subquery) use ($extensions) {
            //             foreach ($extensions as $extension) {
            //                 $subquery->orWhere('file', 'like', '%' . $extension);
            //             }
            //         });
            //     })
            //     ->latest()
            //     ->with('rUser')
            //     ->paginate(12);
            $post = Post::WhereIn('id', $subCategoryPostIds)
                ->where('status', 'Selesai')
                ->latest()
                ->with('rUser')
                ->paginate(12);
        } else {
            $post = Post::whereHas('rCategory', function ($query) {
                $query->where('id', 4);
            })
                ->where('status', 'Selesai')
                ->where(function ($query) use ($search, $extensions) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere(function ($subquery) use ($extensions) {
                            $subquery->whereIn('file', $extensions);
                        })
                        ->orWhere('url', 'like', '%' . $search . '%')
                        ->orWhere('urlgd', 'like', '%' . $search . '%');
                })->latest()
                ->with('rUser')
                ->paginate(12);
        }

        return view('frontend.home', compact('post', 'reso', 'subcategory'));
    }

    public function audio(Request $request)
    {
        $search = $request->input('search_audio');
        $reso = Post::query()->distinct()->select('resolution')->get();

        $selectedSubCategoryId = $request->input('sub_category_id_audio');
        $subcategory = SubCategory::get();
        $subCategoryPostIds = SubCategoryPost::where('sub_category_id', $selectedSubCategoryId)->pluck('post_id');

        $extensions = ['mp3', 'm4a'];

        if ($selectedSubCategoryId) {
            // $post = Post::whereIn('id', $subCategoryPostIds)
            //     ->where(function ($query) use ($extensions) {
            //         $query->where(function ($subquery) use ($extensions) {
            //             foreach ($extensions as $extension) {
            //                 $subquery->orWhere('file', 'like', '%' . $extension);
            //             }
            //         });
            //     })
            //     ->latest()
            //     ->with('rUser')
            //     ->paginate(12);
            $post = Post::WhereIn('id', $subCategoryPostIds)
                ->where('status', 'Selesai')
                ->latest()
                ->with('rUser')
                ->paginate(12);
        } else {
            $post = Post::whereHas('rCategory', function ($query) {
                $query->where('id', 5);
            })
                ->where('status', 'Selesai')
                ->where(function ($query) use ($search, $extensions) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere(function ($subquery) use ($extensions) {
                            $subquery->whereIn('file', $extensions);
                        })
                        ->orWhere('url', 'like', '%' . $search . '%')
                        ->orWhere('urlgd', 'like', '%' . $search . '%');
                })->latest()
                ->with('rUser')
                ->paginate(12);
        }

        // $post = Post::whereHas('rCategory', function ($query) {
        //     $query->where('id', 5);
        // })
        //     ->where(function ($query) use ($search, $extensions) {
        //         $query->where('name', 'like', '%' . $search . '%')
        //             ->orWhere(function ($subquery) use ($search, $extensions) {
        //                 $subquery->where('file', 'like', '%' . $extensions[0])
        //                     ->orWhere('file', 'like', '%' . $extensions[1]);
        //             })
        //             ->orWhere('url', 'like', '%' . $search . '%')
        //             ->orWhere('urlgd', 'like', '%' . $search . '%');
        //     })
        //     ->latest()
        //     ->with('rUser')
        //     ->paginate(12);


        return view('frontend.home', compact('post', 'reso', 'subcategory'));
    }
    public function detail($slug)
    {
        $page = 'detail';
        $post = Post::where('slug', $slug)->where('status', 'Selesai')->first();
        $posts = Post::inRandomOrder()->limit(8)->with('rUser')->where('slug', '<>', $slug)->where('status', 'Selesai')->get();
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
        $path_photo = storage_path('app/public/uploads/photo/' . $file);
        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
        if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg') {
            $path = storage_path('app/public/uploads/photo/' . $file);

            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_video = storage_path('app/public/uploads/video/' . $file);
        $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);
        if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm') {
            $path = storage_path('app/public/uploads/video/' . $file);

            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_audio = storage_path('app/public/uploads/audio/' . $file);
        $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);
        if ($extaudio == 'mp3' || $extaudio == 'm4a') {
            $path = storage_path('app/public/uploads/audio/' . $file);

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
        $path_raw_photo = storage_path('app/public/uploads/rawphoto/' . $file);
        $extrawphoto = pathinfo($path_raw_photo, PATHINFO_EXTENSION);
        if ($extrawphoto == 'eps' || $extrawphoto == 'psd' || $extrawphoto == 'ai' || $extrawphoto == 'cdr') {
            $path = $path_raw_photo;
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_raw_video = storage_path('app/public/uploads/rawvideo/' . $file);
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
            $path = storage_path('app/public/uploads/rawphoto/' . $file);
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        if (($extrawvideo == 'zip' || $extrawvideo == 'rar') && file_exists($path_raw_video)) {
            $path = storage_path('app/public/uploads/rawvideo/' . $file);
            if (!file_exists($path)) {
                abort(404);
            }
            $type = mime_content_type($path);
            return response()->download($path, $file, ['Content-Type' => $type]);
        }

        $path_raw_audio = storage_path('app/public/uploads/rawaudio/' . $file);
        $extrawaudio = pathinfo($path_raw_audio, PATHINFO_EXTENSION);
        if (($extrawaudio == 'zip' || $extrawaudio == 'rar') && file_exists($path_raw_audio)) {
            $path = storage_path('app/public/uploads/rawaudio/' . $file);
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
