<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $page = 'dashboard';
        $countUser = User::count();
        $post = Post::count();
        $category = Category::count();
        $userPremium = User::where('role', 'premium')->count();

        $photoCount = Post::where('category_id', 3)->count();
        $videoCount = Post::where('category_id', 4)->count();
        $audioCount = Post::where('category_id', 5)->count();

        $usersWithPostCount = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', DB::raw('count(posts.id) as post_count')) // Sertakan semua kolom non-agregat yang digunakan dalam SELECT
            ->groupBy('users.id', 'users.name', 'users.nim', 'users.skill', 'users.gender', 'users.foto_profil', 'users.about', 'users.status', 'users.place', 'users.contract', 'users.email', 'users.hp', 'users.instagram', 'users.twitter', 'users.password', 'users.token', 'users.role', 'users.premium_expiry', 'users.created_at', 'users.updated_at') // Sertakan semua kolom non-agregat dalam GROUP BY
            ->orderBy('post_count', 'desc')
            ->take(5)
            ->get();

        $usersNIM = $usersWithPostCount->map(function ($user) {
            $nim = $user->nim;

            // Mengambil dua angka di depan NIM
            $user->formatted_nim = '20' . substr($nim, 0, 2);

            return $user;
        });

        $userPost = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select(
                'users.*',
                DB::raw('count(posts.id) as post_count'),
                DB::raw('count(case when posts.category_id = 3 then 1 else null end) as photo_count'),
                DB::raw('count(case when posts.category_id = 4 then 1 else null end) as video_count'),
                DB::raw('count(case when posts.category_id = 5 then 1 else null end) as audio_count'),
            )
            ->groupBy('users.id', 'users.name', 'users.nim', 'users.skill', 'users.gender', 'users.foto_profil', 'users.about', 'users.status', 'users.place', 'users.contract', 'users.email', 'users.hp', 'users.instagram', 'users.twitter', 'users.password', 'users.token', 'users.role', 'users.premium_expiry', 'users.created_at', 'users.updated_at') // Sertakan semua kolom non-agregat dalam GROUP BY
            ->orderBy('post_count', 'desc')
            ->get();

        $userNIM = $userPost->map(function ($user) {
            $nim = $user->nim;

            // Mengambil dua angka di depan NIM
            $user->formatted_nim = '20' . substr($nim, 0, 2);

            return $user;
        });

        return view('admin.index', compact('countUser', 'post', 'category', 'userPremium', 'photoCount', 'videoCount', 'audioCount', 'usersWithPostCount', 'usersNIM', 'userPost', 'userNIM', 'page'));
    }
}
