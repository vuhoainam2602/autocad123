<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class TagController extends Controller
{
    public static function index($name, Request $request)
    {
//dd($name);
        try {
            if (empty($name)) {
                return abort(404);
            }

            $wp_terms = cache()->remember('TagController-wp_terms_' . $name, 120, function () use ($name) {
                return DB::table('wp_terms')
                    ->select('term_id', 'name')->where('slug', '=', $name)->get()->toArray();
            });

//            dd($wp_terms);
            if (count($wp_terms) <= 0) {
                return abort(404);
            }


            $wp_term_taxonomy = cache()->remember('TagController-wp_term_taxonomy_' . $name, 120, function () use ($wp_terms) {
                return DB::table('wp_term_taxonomy')
                    ->select('term_taxonomy_id')
                    ->where('term_id', '=', $wp_terms[0]->term_id)->get()->toArray();
            });
            $post_lien_quan = cache()->remember('TagController-wp_term_relationships_' . $name, 120, function () use ($wp_term_taxonomy) {
                return DB::table('wp_term_relationships')
                    ->select('object_id')
                    ->where('term_taxonomy_id', '=', $wp_term_taxonomy[0]->term_taxonomy_id)
                    ->get()->toArray();
            });

//            dd($post_lien_quan);
            if (count($post_lien_quan) <= 0) {
                return abort(404);
            }
            $list_post_lien_quan = array();
            foreach ($post_lien_quan as $value) {
                try {
                    $post_detail = DB::table('wp_posts')
                        ->select('wp_posts.ID', 'wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content')
                        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                        ->where('wp_posts.id', '=', $value->object_id)
                        ->where('wp_posts.post_status','=','publish')
                        ->get()->toArray();
                    $post_detail[0]->post_content = strip_tags(substr(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $post_detail[0]->post_content), 0));
                    $list_post_lien_quan = array_merge($list_post_lien_quan, $post_detail);

                } catch (\Exception $e) {
                }
            }


            $arr = array();
            foreach ($list_post_lien_quan as $item) {
                // xóa hết đoạn script trong content bài viết
                $item->post_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $item->post_content);
                array_push($arr, $item);
            }
            $list_post_lien_quan = $arr;
            $list_post_lien_quan = array_reverse($list_post_lien_quan);
            if (count($list_post_lien_quan) <= 0) {
                return abort(404);
            }
            $list_tag = BaseController::getListTag();

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Create a new Laravel collection from the array data
            $productCollection = collect($list_post_lien_quan);

            // Define how many products we want to be visible in each page
            $perPage = 10;

            // Slice the collection to get the products to display in current page
            $currentPageproducts = $productCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedproducts = new LengthAwarePaginator($currentPageproducts, count($productCollection), $perPage);

            // set url path for generted links
            $paginatedproducts->setPath($request->url());

            // Chủ đề nổi bật
            $select_list_chu_de_noi_bat = DB::table('wp_hw_trending')
                ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                ->where('post_type', '=', 'post')
                ->groupBy('post_id')
                ->orderBy('count', 'desc')
                ->limit(8)
                ->get()->toArray();

            $list_chu_de_noi_bat = array();
            foreach ($select_list_chu_de_noi_bat as $value) {
                $post_detail2 = DB::table('wp_posts')
                    ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                    ->where('wp_posts.id', '=', $value->post_id)
                    ->where('wp_posts.post_status','=','publish')->get()->toArray();
                $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
            }


            return view('tagPage.tag', compact('list_post_lien_quan', 'list_tag', 'list_chu_de_noi_bat', 'wp_terms', 'paginatedproducts'));
        } catch (\Exception $e) {

//            return redirect($name.'/a');
            return abort(404);
        }
    }


}
