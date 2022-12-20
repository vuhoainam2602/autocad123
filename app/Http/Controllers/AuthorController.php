<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use function abort;
use function view;

class AuthorController
{
    public function index($name, $number)
    {
        try {
            $author = DB::table('wp_users')
                ->select('display_name', 'ID')
                ->where("user_login", '=', $name)
                ->get()->toArray();

            if (count($author) <= 0) {
                return abort(404);
            }
            $list_tag = BaseController::getListTag();
            // Chủ đề nổi bật
            $select_list_chu_de_noi_bat = DB::table('wp_hw_trending')
                ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                ->where('post_type', '=', 'post')
                ->groupBy('post_id')
                ->orderBy('count', 'desc')
                ->limit(8)
                ->get()->toArray();
            if (count($select_list_chu_de_noi_bat) <= 0) {
                return abort(404);
            }
            $list_chu_de_noi_bat = array();
            foreach ($select_list_chu_de_noi_bat as $value) {
                $post_detail2 = DB::table('wp_posts')
                    ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                    ->where('wp_posts.id', '=', $value->post_id)->get()->toArray();
                $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
            }

            $paginate = 10;
            $skip = ($number * $paginate) - $paginate;
            $prevUrl = $nextUrl = '';
            if ($skip > 0) {
                $prevUrl = $number - 1;
            }
            $list_post_lien_quan = DB::table('wp_posts')
                ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_posts.post_parent', 'wp_users.user_login')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.ID')
                ->join('wp_users', 'wp_users.ID', '=', 'wp_posts.post_author')
                ->where('wp_users.user_login', '=', $name)
                ->where('wp_posts.post_type', '=', 'post')
                ->orderBy("wp_posts.id", 'desc')
                ->skip($skip)->take($paginate)
                ->get();

            $count_post = DB::table('wp_posts')
                ->select('wp_posts.post_name')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.ID')
                ->join('wp_users', 'wp_users.ID', '=', 'wp_posts.post_author')
                ->where('wp_users.user_login', '=', $name)
                ->where('wp_posts.post_type', '=', 'post')
                ->get()
                ->count();

            $max_page = (int)($count_post / 10 + 1);

            if ($list_post_lien_quan->count() > 0) {
                if ($list_post_lien_quan->count() >= $paginate) {
                    $nextUrl = $number + 1;
                }
                return view('postPage.author', compact('list_post_lien_quan', 'list_tag', 'list_chu_de_noi_bat', 'author', 'max_page', 'number', 'prevUrl', 'nextUrl'));
            }

//        dd($list_chu_de_noi_bat);
            return view('postPage.author', compact('list_post_lien_quan', 'list_tag', 'list_chu_de_noi_bat', 'author'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }


}
