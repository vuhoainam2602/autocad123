<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SiteMapController extends Controller
{
    public function index() {
        $site = \app()->make('sitemap') ;
        $site->add("https://thoitrangwiki.com/", date('Y-m-d h:i:s'), 1, 'daily');
        $ds_bai_viet = DB::table('wp_posts')
            ->select('wp_posts.post_date', 'wp_posts.post_name')
            ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
            ->where('wp_posts.post_type', '=', 'post')
            ->orderBy('wp_posts.ID', 'desc')
            ->get()->toArray();
        foreach ($ds_bai_viet as $post) {
            $site->add('https://thoitrangwiki.com/' . $post->post_name . '.html', $post->post_date, 1, 'daily');
        }

        $list_tag = BaseController::getListTag();
        foreach ($list_tag as $tag) {
            $site->add('https://thoitrangwiki.com/' . $tag->slug . '/', '', 1, 'daily');
        }

        return $site->render('xml');
    }
}

