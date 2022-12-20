<?php

namespace App\Http\Controllers;


use App\Imports\PostImport;
use App\Imports\TongHopImport;
use App\Imports\yoastImport;
use App\Models\Post;
use App\Models\TongHop;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tag;


class PostController extends Controller
{
    public function show()
    {
// nếu nó null thì em nhảy về trang home
//dd($post_name);
//        try {
//        if (str_contains($post_name, '.html')) {
//            $post_name = substr($post_name, 0, strpos($post_name, '.html'));
//        }

        if (!empty($post_name)) {
            switch ($post_name) {
                case "search":
                    return $this->search();
                case "tag":
                    return TagController::index($post_name);
                case "category":
                    return TagController::index($post_name);
                case "hd":
                    return PostController::post_huong_dan($post_name);
                case "top_list":
                    return TopListController::index();
                default:
//                    $post_name = $post_name . '.' . $slug;

                    return $this->postDetail($post_name . '.' . $slug);
//                default:
////                    $post_name=$post_name.'.html';
//                    return redirect()->route('postDetail',['slug'=>$post_name]);
            }
        } else {
            return $this->home();
        }
//        } catch (\Exception $e) {
//            return abort(404);
//        }


    }


    public function postDetail($post_name, Request $request)
    {
//        DB::table('wp_posts')->where('post_name', '=', $post_name)->increment('post_view');
//        try {
//            dd($request->getRequestUri());
            if (preg_match('/.+\/$/', $request->getRequestUri())) {
                if(preg_match('/.+\/\/$/', $request->getRequestUri())){
                    return abort(404);
                }else{
                    return Redirect::to(rtrim($request->getRequestUri(), '/'), 301);
                }
            }
            if (str_contains($post_name, '.html')) {
                $post_name = substr($post_name, 0, strpos($post_name, '.html'));
            }
//            dd($post_name);
            $post_detail = DB::table('wp_posts')
                ->select('wp_posts.post_author', 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title',
                    'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title'
                    , 'wp_yoast_indexable.primary_focus_keyword', 'wp_yoast_indexable.meta_robot', 'wp_posts.id_key')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                ->where('post_name', '=', $post_name)
                ->orderBy('id','desc')
                ->get()->toArray();
            $category = DB::table('wp_terms')->where('slug', '=', $post_name)->first();
            if (!empty($category)) {
                return redirect()->route('tag', ['slug' => $post_name]);
            }
//            $str = date('y-m');
//            $post_view = json_decode($post_detail[0]->post_view, true);
//            if (empty($post_view) || !is_array($post_view)) {
//                $post_view = array();
//            }
//            if (empty($post_view["" . $str])) {
//                $arr = array($str => "1");
//                $post_view = array_merge($post_view, $arr);
//            }
//            $current_view = (int)$post_view["" . $str];
//            $post_view["" . $str] = "" . ($current_view + 1);
//            $post_detail[0]->postHD_view = $post_view;
////        dd($post_view);
//            DB::table('wp_posts')
//                ->where('post_name', '=', $post_name)
//                ->where("post_type", "=", "post")
//                ->update(["wp_posts.post_view" => json_encode($post_view)]);


//        $post_detail_hd = cache()->remember('PostController-wp_posts_a' . $post_name, 120, function () use ($post_name) {
//            return DB::table('wp_posts_hd')
//                ->where('postHD_name', '=', $post_name)
//                ->get()->toArray();
//        });
//


//        if ($post_detail[0]->id_key != 0) {
//            return TopListController::post_detail($post_name);
//        }
//        if (count($post_detail) <= 0) {
//            if (count($post_detail_hd) <= 0) {
//                return abort(404);
//            } else {
//                return PostController::post_huong_dan($post_name);
//            }
//        }
            if ($post_detail[0]->id_key != 0) {
                return TopListController::post_detail($post_name);
            }


            $post_detail[0]->post_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $post_detail[0]->post_content);

//            $id_tham_khao = DB::table('wp_posts')
//                ->select('wp_baivietlq.ID_BV_LQ')
//                ->join('wp_baivietlq', 'wp_baivietlq.ID_BV_Chinh', '=', 'wp_posts.id')
//                ->where('post_name', '=', $post_name)
//                ->get()->toArray();
//
//            $list_bv_tham_khao = array();
//
//            foreach ($id_tham_khao as $value) {
//                $post_detail0 =
//                    DB::table('wp_posts')
//                        ->select('wp_yoast_indexable.id', 'wp_yoast_indexable.object_id', 'wp_posts.post_title', 'wp_posts.post_name', 'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.description')
//                        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                        ->where('wp_posts.id', '=', $value->ID_BV_LQ)
//                        ->where('post_type', '=', 'post')
//                        ->where('object_type', '=', 'post')
//                        ->whereNotNull('wp_yoast_indexable.twitter_image')
//                        ->get()->toArray();
//                $list_bv_tham_khao = array_merge($list_bv_tham_khao, $post_detail0);
//            }

            $wp_term_relationships = cache()->remember('PostController-post_detail_id_' . $post_detail[0]->ID . $post_name, 120, function () use ($post_detail) {
                return DB::table('wp_term_relationships')
                    ->select('term_taxonomy_id')
                    ->where('object_id', '=', $post_detail[0]->ID)->get()->toArray();
            });

            if (!empty($wp_term_relationships)) {


                $wp_term_taxonomy = cache()->remember('PostController-wp_term_relationships_' . $wp_term_relationships[0]->term_taxonomy_id . $post_name, 120, function () use ($wp_term_relationships) {
                    return DB::table('wp_term_taxonomy')
                        ->select('term_id')
                        ->where('term_taxonomy_id', '=', $wp_term_relationships[0]->term_taxonomy_id)->get()->toArray();
                });


                $wp_terms = cache()->remember('PostController-wp_term_taxonomy_' . $wp_term_taxonomy[0]->term_id, 120, function () use ($wp_term_taxonomy) {
                    return DB::table('wp_terms')
                        ->where('term_id', '=', $wp_term_taxonomy[0]->term_id)->get()->toArray();
                });
            } else {
                $wp_terms = null;
            }


            // Chủ đề nổi bật
            $select_list_chu_de_noi_bat = cache()->remember('PostController-wp_hw_trending' . $post_name, 120, function () {
                return DB::table('wp_hw_trending')
                    ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                    ->where('post_type', '=', 'post')
                    ->groupBy('post_id')
                    ->orderBy('count', 'desc')
                    ->limit(16)
                    ->get()->toArray();
            });

            $list_chu_de_noi_bat = array();
            foreach ($select_list_chu_de_noi_bat as $value) {
                $post_detail2 =
                    DB::table('wp_posts')
                        ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                        ->where('wp_posts.id', '=', $value->post_id)
                        ->get()->toArray();
                $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
            }


            return view('postPage.post', compact('post_detail', 'wp_terms', 'list_chu_de_noi_bat'));

//        } catch (\Exception $e) {
//            return abort(404);
//        }
    }

    public function post_huong_dan($post_name)
    {
        try {

            $post_detail_hd = DB::table('wp_posts_hd')
                ->select('wp_posts_hd.postHD_author', 'wp_posts_hd.ID_HD', 'wp_posts_hd.postHD_date', 'wp_posts_hd.postHD_content', 'wp_posts_hd.postHD_title', 'wp_posts_hd.postHD_view',
                    'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title'
                    , 'wp_yoast_indexable.primary_focus_keyword', 'wp_yoast_indexable.meta_robot')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts_hd.ID_HD')
                ->where('postHD_name', '=', $post_name)
                ->get()->toArray();

            $post_detail_hd[0]->postHD_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $post_detail_hd[0]->postHD_content);

            $str = date('y-m');
            $post_view_hd = json_decode($post_detail_hd[0]->postHD_view, true);
            if (empty($post_view_hd)) {
                $post_view_hd = array();
            }
            if (empty($post_view_hd["" . $str])) {
                $arr = array($str => "1");
                $post_view_hd = array_merge($post_view_hd, $arr);
            }
            $current_view = (int)$post_view_hd["" . $str];
            $post_view_hd["" . $str] = "" . ($current_view + 1);
            $post_detail_hd[0]->postHD_view = $post_view_hd;
            DB::table('wp_posts_hd')
                ->where('postHD_name', '=', $post_name)
                ->update(["postHD_view" => json_encode($post_view_hd)]);

            $id_tham_khao = DB::table('wp_posts_hd')
                ->select('wp_baivietlq.ID_BV_LQ')
                ->join('wp_baivietlq', 'wp_baivietlq.ID_BV_Chinh', '=', 'wp_posts_hd.ID_HD')
                ->where('postHD_name', '=', $post_name)
                ->get()->toArray();
            $list_bv_tham_khao = array();

            foreach ($id_tham_khao as $value) {
                $post_detail0 =
                    DB::table('wp_posts')
                        ->select('wp_yoast_indexable.id', 'wp_yoast_indexable.object_id', 'wp_posts.post_title', 'wp_posts.post_name', 'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.description')
                        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                        ->where('wp_posts.id', '=', $value->ID_BV_LQ)
                        ->where('post_type', '=', 'post')
                        ->where('object_type', '=', 'post')
                        ->whereNotNull('wp_yoast_indexable.twitter_image')
                        ->get()->toArray();
                $list_bv_tham_khao = array_merge($list_bv_tham_khao, $post_detail0);
            }


            $wp_term_relationships = DB::table('wp_term_relationships')
                ->select('term_taxonomy_id')
                ->where('object_id', '=', $post_detail_hd[0]->ID_HD)->get()->toArray();

            $wp_term_taxonomy = DB::table('wp_term_taxonomy')
                ->select('term_id')
                ->where('term_taxonomy_id', '=', $wp_term_relationships[0]->term_taxonomy_id)->get()->toArray();


            $wp_terms = DB::table('wp_terms')
                ->where('term_id', '=', $wp_term_taxonomy[0]->term_id)->get()->toArray();


            // Chủ đề nổi bật
            $select_list_chu_de_noi_bat = cache()->remember('PostController-wp_hw_trending' . $post_name, 120, function () {
                return DB::table('wp_hw_trending')
                    ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                    ->where('post_type', '=', 'post')
                    ->groupBy('post_id')
                    ->orderBy('count', 'desc')
                    ->limit(16)
                    ->get()->toArray();
            });

            $list_chu_de_noi_bat = array();
            foreach ($select_list_chu_de_noi_bat as $value) {
                $post_detail2 =
                    DB::table('wp_posts')
                        ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                        ->where('wp_posts.id', '=', $value->post_id)
                        ->get()->toArray();
                $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
            }

//            $list_tag = BaseController::getListTag();
//            $banner_ngang = DB::table('wp_banner')->select('link')
//                ->where('vi_tri', '=', 'banner-ngang')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_ngang)) {
//                $banner_ngang = substr($banner_ngang->link, 25);
//            }
//            $banner_doc = DB::table('wp_banner')->select('link')->where('vi_tri', '=', 'banner-doc')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_doc)) {
//                $banner_doc = substr($banner_doc->link, 25);
//            }


//        dd($chu_de_noi_bat);
//        dd($list_post_lien_quan);
            return view('postPage.post_huong_dan', compact('post_detail_hd', 'wp_terms', 'list_chu_de_noi_bat', 'list_bv_tham_khao'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function home()
    {
//        try {
        //Category: Biệt thự đẹp
        $term_relationship_44 =  Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
            ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '1')
                ->limit(5)
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->get()->toArray();


        //Category: Tài liệu thi công
        $term_relationship_45 = cache()->remember('HomeController-term_relationship_45', 120, function () {
            return Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
                ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '3')
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->limit(5)
                ->get()->toArray();
        });


        //Category: Tài liệu thiết kế
        $term_relationship_46 = cache()->remember('HomeController-term_relationship_46', 120, function () {
            return Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
                ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '4')
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->limit(5)
                ->get()->toArray();
        });


        //Category: Tiêu chuẩn
        $term_relationship_47 = cache()->remember('HomeController-term_relationship_47', 120, function () {
            return Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
                ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '5')
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->limit(5)
                ->get()->toArray();
        });


        //Catgory : Thư viện
        $term_relationship_49 = cache()->remember('HomeController-term_relationship_49', 120, function () {
            return Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
                ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '6')
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->limit(5)
                ->get()->toArray();
        });


        //Category: Bảng tính excel
        $term_relationship_50 = cache()->remember('HomeController-term_relationship_50', 120, function () {
            return Db::table('wp_posts')
                ->select('term_taxonomy_id','wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_term_relationships.object_id', 'wp_yoast_indexable.description')
                ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_posts.ID')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_yoast_indexable.twitter_image', '!=', null)
                ->where('post_name', '!=', "")
                ->where('term_taxonomy_id', '=', '12')
                ->orderBy('wp_term_relationships.object_id', 'desc')
                ->limit(5)
                ->get()->toArray();

        });

        $list_tag = BaseController::getListTag();


        // Chủ đề nổi bật
        $select_list_chu_de_noi_bat = cache()->remember('HomeController-wp_hw_trending', 120, function () {
            return DB::table('wp_hw_trending')
                ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                ->where('post_type', '=', 'post')
                ->groupBy('post_id')
                ->orderBy('count', 'desc')
                ->limit(16)
                ->get()->toArray();
        });


        $list_chu_de_noi_bat = array();
        foreach ($select_list_chu_de_noi_bat as $value) {
            $post_detail2 = DB::table('wp_posts')
                ->select('wp_posts.post_name', 'wp_posts.post_title',
                    'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                ->where('wp_posts.id', '=', $value->post_id)->get()->toArray();
            $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
        }

//            $banner_ngang = DB::table('wp_banner')->select('link')
//                ->where('vi_tri', '=', 'banner-ngang')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_ngang)) {
//                $banner_ngang = substr($banner_ngang->link, 25);
//            }
//            $banner_doc = DB::table('wp_banner')->select('link')->where('vi_tri', '=', 'banner-doc')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_doc)) {
//                $banner_doc = substr($banner_doc->link, 25);
//            }


        return view('homePage.home', compact(
            'term_relationship_44',
            'term_relationship_45',
            'term_relationship_46',
            'term_relationship_47',
            'term_relationship_49',
            'term_relationship_50',
            'list_chu_de_noi_bat'));
//        } catch (\Exception $e) {
//            return abort(404);
//        }
        // phần trang chủ đây anh ạ
        // nó đang không chạy vào chỗ này anh ạ // anh xem cái route của em đã anh
    }

    public function search()
    {
        try {
            //Chủ đề nổi bật
            $select_list_chu_de_noi_bat = DB::table('wp_hw_trending')
                ->select('post_id', DB::raw('count(wp_hw_trending.post_id) as count'))
                ->where('post_type', '=', 'post')
                ->groupBy('post_id')
                ->orderBy('count', 'desc')
                ->limit(16)
                ->get()->toArray();
            $list_chu_de_noi_bat = array();
            foreach ($select_list_chu_de_noi_bat as $value) {
                $post_detail2 = DB::table('wp_posts')
                    ->select('wp_posts.post_name', 'wp_posts.post_title', 'wp_yoast_indexable.twitter_image', 'wp_posts.post_content', 'wp_yoast_indexable.description')
                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                    ->where('wp_posts.id', '=', $value->post_id)->get()->toArray();
                $list_chu_de_noi_bat = array_merge($list_chu_de_noi_bat, $post_detail2);
            }

            //Search
            $s = request()->s;
            $item_search = DB::table('wp_posts')
                ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                ->where('wp_posts.post_title', 'like', '%' . $s . '%')
                ->where('wp_posts.post_type', '=', 'post')
                ->where('wp_posts.post_status', '=', 'publish')
                ->orderBy('wp_posts.ID', 'desc')->paginate(10);

            $list_tag = BaseController::getListTag();
//            $banner_ngang = DB::table('wp_banner')->select('link')
//                ->where('vi_tri', '=', 'banner-ngang')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_ngang)) {
//                $banner_ngang = substr($banner_ngang->link, 25);
//            }
//            $banner_doc = DB::table('wp_banner')->select('link')->where('vi_tri', '=', 'banner-doc')
//                ->orderBy('id', 'desc')
//                ->first();
//            if (!empty($banner_doc)) {
//                $banner_doc = substr($banner_doc->link, 25);
//            }
            if (count($item_search) <= 0) {
                $item_search = null;
                return view('postPage.search', compact('list_tag', 'list_chu_de_noi_bat', 's'));
            }

            return view('postPage.search', compact('list_tag', 'list_chu_de_noi_bat', 'item_search', 's'));
        } catch (\Exception $e) {
            return abort(404); //Đoạn này mình chèn thêm / vào để nó trả về 404
        }
    }

    public function randomkey(Request $request)
    {

        try {
            $list_key = DB::table('wp_key_hd')
                ->where('list_link', '!=', '')
                ->get()->toArray();
            $min = pow($request->val - $list_key[0]->valueHD, 2);
            $i = 0;
            $current_val = 0;
            $current_key = "";
            foreach ($list_key as $item) {
                $h = pow($request->val - $item->valueHD, 2);
//                echo $min;
//                dd($h);
                if ($h <= $min) {
                    $min = $h;
                    $current_val = $item->valueHD;
                    $current_key = $item->keyHD;
                }
            }

            $list_key = DB::table('wp_key_hd')
                ->where('keyHD', '=', $current_key)
                ->where('valueHD', '=', $current_val)
                ->get()->toArray();
            $list_url = explode("@@", $list_key[0]->list_link);
            $index = rand(0, count($list_url) - 1);
            return redirect($list_url[$index]);
        } catch (\Exception $e) {
            return abort(404); //Đoạn này mình chèn thêm / vào để nó trả về 404
        }

    }

    public function random_bv(Request $request)
    {
//        $list_key = DB::table('wp_posts_hd_has_key_hd')->where('id_post_hd', '=', $request->id)
//            ->get()->toArray();
//        $rs = array();
//        foreach ($list_key as $item) {
//            $key = DB::table('wp_key_hd')
//                ->where('wp_key_hd.id', '=', $item->id_key_hd)
//                ->get()->toArray();
//            array_push($rs, $key[0]);
//        }
//        $check = false;
//        dd($rs);
//        $list_url = explode("@@", $key[0]->list_link);
        $list_key = DB::table('wp_key_hd')
            ->where('list_link', '!=', '')
            ->orderBy("valueHD", 'desc')
            ->get()->toArray();

        $ran = rand(0, count($list_key) - 1);
        $random_val = rand(0, (int)$list_key[$ran]->valueHD * 1);
        return redirect('/random-pass/?val=' . $random_val);
//        $index = rand(0, count($list_url)-1);
//        return view('random_key.random_key', compact('rs', 'check'));
    }

    public function import_js(Request $request)
    {
        $check = DB::table('wp_posts')
            ->where('post_name', '=', $request->post_name)
            ->get()->toArray();

        if (count($check) == 0 && !empty($request->post_title)) {
            DB::table('wp_posts')->insert([
                'post_title' => $request->post_title,
                'post_content' => $request->post_content,
                'post_author' => $request->post_author,
                'post_name' => $request->post_name,
                'post_date' => $request->post_date,
                'post_date_gmt' => $request->post_date_gmt,
                'post_modified' => $request->post_modified,
                'post_modified_gmt' => $request->post_modified_gmt,
                'post_excerpt' => $request->post_excerpt,
                'to_ping' => $request->to_ping,
                'pinged' => $request->pinged,
                'post_content_filtered' => $request->post_content_filtered,
                'post_view' => $request->post_view,
                'post_type' => $request->post_type,
                'post_status' => $request->post_status,
                'id_key' => $request->id_key,
                'url' => $request->url
            ]);


            $object = DB::table('wp_posts')->select('ID')->where('post_title', '=', $request->post_title)->where("id_key", '=', $request->id_key)->first();
            DB::table("wp_yoast_indexable")->insert([
                'object_id' => $object->ID,
                'object_type' => $request->object_type,
                'object_sub_type' => $request->object_sub_type,
                'author_id' => $request->author_id,
                'description' => $request->description,
                'breadcrumb_title' => $request->breadcrumb_title,
                'post_status' => $request->post_status,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,
                'twitter_image' => $request->twitter_image,
                'twitter_description'=>$request->twitter_description,
                'primary_focus_keyword' => $request->primary_focus_keyword,
                'meta_robot' => $request->meta_robot,
                'permalink' => $request->permalink,
                'permalink_hash' => $request->permalink_hash
            ]);

            DB::table("wp_tong_hop")->insert([
                'id' => $request->id_key,
                'tien_to' => $request->tien_to,
                'ten' => $request->ten,
                'hau_to' => $request->hau_to,
                'url_key_cha' => $request->url_key_cha
            ]);
        } else {
            $object = DB::table('wp_posts')->select('ID')->where('post_name', '=', $request->post_name)->first();
            DB::table('wp_posts')->where('post_name', '=', $request->post_name)->update([
                    'post_content' => $request->post_content,
                    'post_date' => $request->post_date,
                    'post_date_gmt' => $request->post_date_gmt,
                'post_modified' => $request->post_modified,
                'post_modified_gmt' => $request->post_modified_gmt,
            ]);
            DB::table('wp_yoast_indexable')->where('object_id', '=', $object->ID)->update([
                'twitter_image' => $request->twitter_image,
            ]);

        }
        return array(["code" => 200, 'message' => 'Success']);
    }


    public function createTH()
    {

//        $baiTH = DB::table('wp_tong_hop')->get()->toArray();
//
//        foreach ($baiTH as $key) {
//            $check = DB::table('wp_posts')
//                ->select("post_name")
//                ->where("post_name", '=', $key->url_key_cha)->first();
//            if (empty($check)) {
//                $title = $key->tien_to . ' ' . $key->ten . ' ' . $key->hau_to;
//                DB::table('wp_posts')->where('post_title', '=', $title)->delete();
//                DB::table('wp_yoast_indexable')->where('breadcrumb_title', '=', $title)->delete();
//                $post_detail = DB::table('wp_posts')
//                    ->select('wp_posts.post_author', 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title', 'wp_posts.post_view', 'wp_posts.post_name',
//                        'wp_posts.menu_order', 'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title'
//                        , 'wp_yoast_indexable.primary_focus_keyword', 'wp_yoast_indexable.meta_robot', 'wp_posts.id_key', 'wp_posts.url')
//                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                    ->where('wp_posts.id_key', '=', $key->id)
////                ->where('wp_posts.post_title','LIKE','%xây dựng%')->limit()
//                    ->orderBy('wp_posts.id', 'asc')
//                    ->get()->toArray();
//                $content = '<div class="entry-content"><p>Cập nhật thông tin và kiến thức về <b><a href="' . route('postShow', ['home' => $key->url_key_cha]) . '">' . $key->ten . '</a></b> chi tiết và đầy đủ nhất, bài viết này đang là chủ đề đang được nhiều quan tâm được tổng hợp bởi đội ngũ biên tập viên Thoitrangwiki.</p><div id="toc_container"><p class="toc_title">MỤC LỤC</p><ul>';
//                for ($i = 0; $i < count($post_detail); $i++) {
//                    $content .= '<li><a href="#' . $post_detail[$i]->post_name . '">' . $post_detail[$i]->post_title . '</a></li>';
//
//                    $tocGenerator = new \TOC\TocGenerator();
////                    $htmlOut = $tocGenerator->getHtmlMenu($post_detail[$i]->post_content, 2, 2);
////                    $content .= $htmlOut;
//
//                }
//
//
//                $content .= '</ul></div>';
//                $content .= '<p style="font-size: 25px">Kết quả tìm kiếm Google: <b>' . $key->ten . '</b></p>
//                            <img src="' . $post_detail[0]->twitter_image . '"
//                               alt="' . $post_detail[0]->post_title . '"
//                            style="width: 100%;">';
//                for ($i = 0; $i < count($post_detail); $i++) {
//
//
//                    $last = strpos($post_detail[$i]->url, "/", 8);
//                    $domain = substr($post_detail[$i]->url, 0, $last);
//                    $random = rand(1000, 5000);
//                    $content .= '<blockquote style="-webkit-text-stroke-width: 0px; background: white; border: 1px solid black; border-radius: 7px; box-sizing: border-box; clear: right; color: #181818; font-family:' . 'Gotham SSm A' . ',' . 'Gotham SSm B' . ',' . ' Gotham, sans-serif; font-style: normal; font-variant-caps: normal; font-variant-ligatures: normal; font-weight: 300; letter-spacing: normal; line-height: 1.6em; margin: 1.5em 0px; orphans: 2; padding: 1.6em; text-align: start; text-decoration-color: initial; text-decoration-style: initial; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;">' .
//                        '<p>Tác giả: ' . $domain . '</p><p>Đánh giá: 5 ⭐ (' . $random . 'lượt đánh giá)</p>';
//
//
//                    $content .= '<h2 id="' . $post_detail[$i]->post_name . '" class="post_title">' . $post_detail[$i]->post_title . '</h2>';
//
//                    $content .= '<div class="clearfix"><img src="' . $post_detail[$i]->twitter_image . '" alt="Nhà cấp 4 chữ L – 100 mẫu nhà chữ L một tầng hot nhất 2022" style="width: 130px;height:130px; object-fit:cover; margin-right: 20px;float: left">';
//                    $content .= '<p class="text-decrip-4" style="line-height: 25px;">' . $post_detail[$i]->description . '...' . '<strong></strong></p><a href="' . $post_detail[$i]->url . '" target="_blank"
//                               style="float: right; font-size: 20px; margin-right: 30px"
//                               rel="noopener,nofollow"><span
//                                    class="material-symbols-outlined" style="position: absolute">
//                                        trending_flat
//                                        </span><b style="margin-left: 25px">Xem ngay</b></a></div></blockquote>';
//                }
//
//
//                $content .= '</div>';
//                if (!empty($post_detail)) {
//                    DB::table('wp_posts')->insert([
//                        'post_title' => $title,
//                        'post_content' => $content,
//                        'post_author' => 1,
//                        'post_name' => $key->url_key_cha,
//                        'post_date' => date('y-m-d h:i:s'),
//                        'post_date_gmt' => date('y-m-d h:i:s'),
//                        'post_modified' => date('y-m-d h:i:s'),
//                        'post_modified_gmt' => date('y-m-d h:i:s'),
//                        'post_excerpt' => "",
//                        'to_ping' => "",
//                        'pinged' => "",
//                        'post_content_filtered' => "",
//                        'post_type' => "post",
//                        'post_status' => "publish",
//                        'id_key' => $key->id
//                    ]);
//
//                    $post = DB::table('wp_posts')->select('ID')->where('post_name', '=', $key->url_key_cha)->first();
//                    $description = 'Cập nhật thông tin và kiến thức về ' . $key->ten . '
//            chi tiết và đầy đủ nhất, bài viết này đang là chủ đề đang được nhiều quan tâm được tổng hợp bởi đội ngũ biên tập viên Thoitrangwiki.';
//
//                    DB::table("wp_yoast_indexable")->insert([
//                        'object_id' => $post->ID,
//                        'object_type' => 'post',
//                        'object_sub_type' => 'post',
//                        'author_id' => 1,
//                        'description' => $description,
//                        'breadcrumb_title' => $title,
//                        'post_status' => 'publish',
//                        'created_at' => date('y-m-d h:i:s'),
//                        'updated_at' => date('y-m-d h:i:s'),
//                        'twitter_image' => $post_detail[0]->twitter_image,
//                        'primary_focus_keyword' => '',
//                        'meta_robot' => 'index,follow',
//                        'permalink' => "",
//                        'permalink_hash' => '']);
//                    foreach ($post_detail as $post_id) {
//                        DB::table('wp_posts')->where('ID', '=', $post_id->ID)->delete();
//                        DB::table('wp_yoast_indexable')->where('object_id', '=', $post_id->ID)->delete();
//                    }
//
//                }
//
//            }
//
//        }
//        return redirect()->back();
    }

//    public function import_js(Request $request)
//    {
//        $body = json_decode($request->getContent());
//        for ($j = 0; $j < count($body); $j++) {
//            $check = DB::table('wp_posts')
//                ->select("post_name")
//                ->where("post_name",'=',$body[$j]->url_key_cha)->get()->toArray();
//            if (count($check)==0) {
//                DB::table('wp_posts')->where('post_name', '=', $body[$j]->post_name)->delete();
//                DB::table('wp_posts')->insert([
//                    'post_title' => $body[$j]->post_title,
//                    'post_content' => $body[$j]->post_content,
//                    'post_author' => $body[$j]->post_author,
//                    'post_name' => $body[$j]->post_name,
//                    'post_date' => $body[$j]->post_date,
//                    'post_date_gmt' => $body[$j]->post_date_gmt,
//                    'post_modified' => $body[$j]->post_modified,
//                    'post_modified_gmt' => $body[$j]->post_modified_gmt,
//                    'post_excerpt' => $body[$j]->post_excerpt,
//                    'to_ping' => $body[$j]->to_ping,
//                    'pinged' => $body[$j]->pinged,
//                    'post_content_filtered' => $body[$j]->post_content_filtered,
//                    'post_view' => $body[$j]->post_view,
//                    'post_type' => $body[$j]->post_type,
//                    'post_status' => $body[$j]->post_status,
//                    'id_key' => $body[$j]->id_key,
//                    'url' => $body[$j]->url
//                ]);
//
//                $object = DB::table('wp_posts')->select('ID')->where('post_name', '=', $body[$j]->post_name)->first();
//                DB::table("wp_yoast_indexable")->where('object_id', '=', $object->ID)->delete();
//                DB::table("wp_yoast_indexable")->insert([
//                    'object_id' => $object->ID,
//                    'object_type' => $body[$j]->object_type,
//                    'object_sub_type' => $body[$j]->object_sub_type,
//                    'author_id' => $body[$j]->author_id,
//                    'description' => $body[$j]->description,
//                    'breadcrumb_title' => $body[$j]->breadcrumb_title,
//                    'post_status' => $body[$j]->post_status,
//                    'created_at' => $body[$j]->created_at,
//                    'updated_at' => $body[$j]->updated_at,
//                    'twitter_image' => $body[$j]->twitter_image,
//                    'primary_focus_keyword' => $body[$j]->primary_focus_keyword,
//                    'meta_robot' => $body[$j]->meta_robot,
//                    'permalink' => $body[$j]->permalink,
//                    'permalink_hash' => $body[$j]->permalink_hash
//                ]);
//
//                DB::table('wp_tong_hop')->where('ten', '=', $body[$j]->ten)->delete();
//                DB::table("wp_tong_hop")->insert([
//                    'id' => $body[$j]->id_key,
//                    'tien_to' => $body[$j]->tien_to,
//                    'ten' => $body[$j]->ten,
//                    'hau_to' => $body[$j]->hau_to,
//                    'url_key_cha' => $body[$j]->url_key_cha
//                ]);
//            }
//
//        }
//        return array(["code" => 200, 'message' => 'Success']);
//    }
}
