<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopListController extends Controller
{
    public static function post_detail($post_name)
    {
        try {

//            Load data bài viết
            $post_detail = DB::table('wp_posts')
                ->select('wp_posts.post_author', 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title', 'wp_posts.post_view', 'wp_posts.menu_order', 'wp_posts.id_key',
                    'wp_yoast_indexable.twitter_image', 'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title'
                    , 'wp_yoast_indexable.primary_focus_keyword', 'wp_yoast_indexable.meta_robot','wp_yoast_indexable.twitter_description')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                ->where('post_name', '=', $post_name)
                ->where('id_key', '!=', 0)
                ->orderBy('id','desc')
                ->get()->toArray();

            $post_TH = DB::table('wp_posts')
//                ->select('post_name','post_title','twitter_image','description')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                ->join('wp_tong_hop', 'wp_posts.id_key', 'wp_tong_hop.id')
                ->where('id_key', '=', $post_detail[0]->id_key)
//                ->where('post_title','=',$post_detail[0]->post_title)
//                ->where('post_title','like','Tổng hợp%')
//                ->Where('post_title','like','Tuyển chọn%')
//                ->Where('post_title','like','Toplist%')
                ->orderBy("wp_posts.ID", "desc")
                ->first();


//            Check view
            $str = date('y-m');
            $post_view = json_decode($post_detail[0]->post_view, true);
            if (empty($post_view) || !is_array($post_view)) {
                $post_view = array();
            }
            if (empty($post_view["" . $str])) {
                $arr = array($str => "1");
                $post_view = array_merge($post_view, $arr);
            }
            $current_view = (int)$post_view["" . $str];
            $post_view["" . $str] = "" . ($current_view + 1);
            $post_detail[0]->postHD_view = $post_view;
//        dd($post_view);
            DB::table('wp_posts')
                ->where('post_name', '=', $post_name)
                ->where("post_type", "=", "post")
                ->update(["wp_posts.post_view" => json_encode($post_view)]);

            $post_detail[0]->post_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $post_detail[0]->post_content);



            $key = DB::table('wp_tong_hop')->where('id', '=', $post_detail[0]->id_key)->first();
//        $count_key = DB::table('wp_tong_hop')->get()->toArray();
//

//        $count = count($count_key);
//
//        foreach ($count_key as $k) {
//
//            if ($post_name == $k->url_key_cha) {
//                break;
//            }
//            $count--;
//        }
//            Danh sách liên quan(cho try catch)
            $list_bv_tham_khao = DB::table('wp_posts')
                ->select('wp_posts.post_name', 'wp_yoast_indexable.twitter_image', 'wp_posts.id_key','wp_posts.post_title','wp_yoast_indexable.description')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                ->join('wp_tong_hop','wp_tong_hop.id','=','wp_posts.id_key')
//                ->where('wp_tong_hop.tien_to','=',$post_TH->tien_to)
                ->whereBetween('id_key',[$post_detail[0]->id_key-16,$post_detail[0]->id_key-1])
            ->orderBy('wp_posts.id','desc')->get()->toArray();
//            $list_key = array();
//            foreach ($list_post_has_key as $k) {
//                $post_key = DB::table('wp_posts')
//                    ->join('wp_tong_hop', 'wp_tong_hop.id', '=', 'wp_posts.id_key')
//                    ->where('id_key','=',$k->id_key)
//                    ->first();
//                $list_key[] = $post_key;
//            }

//            $url_tong_hop = DB::table('wp_key')->select('url_key_cha','tien_to','ten','hau_to')->where('id','=',$post_detail[0]->id_key)->first();

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


            return view('top_list.post_detail', compact('post_detail', 'list_chu_de_noi_bat', 'post_TH','list_bv_tham_khao','key'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public static function suabai(){
        $post_detail = DB::table('wp_posts')
            ->whereDate('post_date','=','2022-11-09')
//                ->where('id_key','=',5744)
            ->get()->toArray();

//        foreach ($post_detail as $post){
//            dd(substr($post->post_content,strpos($post->post_content,'lượt đánh giá')));
//            $post->post_content= str_replace('style="width: 760px;"','width="760px" height="500px"',$post->post_content);
            DB::table('wp_posts')->where("post_name",'=',$post_detail[0]->post_name)
                ->whereDate('post_date','!=','2022-11-10')->delete();
//        }

        dd("xong");
    }
}
