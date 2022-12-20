<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
//use MongoDB\Driver\Session;
//use Intervention\Image\Image;
//use Intervention\Image\ImageManager;
use mysql_xdevapi\Exception;


class BaiVietController
{

    public function index()
    {
        return view('admin.layout_admin.layout_admin');
    }

    public function themBaiViet()
    {

        try {
            $posts = DB::table('wp_posts')
                ->select('wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title', 'wp_posts.post_name')
                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                ->join('wp_users', 'wp_posts.post_author', '=', 'wp_users.id')
                ->where('object_type','=','post')
                ->where('wp_posts.post_type', '=', 'post')
                ->where('wp_posts.post_status', '=', 'publish')
                ->where('wp_posts.comment_status','=','open')

                ->orderBy('wp_posts.ID', 'desc')
                ->get()->toArray();
            $users = DB::table('wp_users')->select("ID", "user_login")->get()->toArray();
            $categories = DB::table('wp_term_taxonomy')
                ->select("wp_term_taxonomy.term_taxonomy_id","wp_terms.name")
                ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_taxonomy_id')
                ->where('taxonomy', '=', 'category')
                ->where('term_taxonomy_id', '<=', '98')
                ->where('term_taxonomy_id', '>=', '5')
                ->get()
                ->toArray();
            return view('admin.baiviet.them_bai_viet', compact("users", 'categories', 'posts'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function luuBaiViet(Request $request)
    {
//        try {
            $markupFixer  = new \TOC\MarkupFixer();
            $contentWithMenu = $markupFixer->fix($request->noi_dung);
            $request->tieu_de = preg_replace('/\s+/', " ", $request->tieu_de);
            $post_name = $request->post_name . '-' . rand(10, 100);
            DB::table('wp_posts')->insert([
                'post_title' => $request->tieu_de,
                'post_content' => $contentWithMenu,
                'post_author' => $request->tac_gia,
                'post_name' => $post_name,
                'post_date' => date('y-m-d h:i:s'),
                'post_date_gmt' => date('y-m-d h:i:s'),
                'post_modified' => date('y-m-d h:i:s'),
                'post_modified_gmt' => date('y-m-d h:i:s'),
                'post_excerpt' => "",
                'to_ping' => "",
                'pinged' => "",
                'post_content_filtered' => "",
                'post_type' => "post",
                'post_status' => "publish"
            ]);

            $post = DB::table('wp_posts')->select("ID", "post_title")
                ->where("post_name", '=', $post_name)
                ->get()->toArray();
            if ($request->has('image_upload')) {
                $file_image = $request->file('image_upload');
                $ext = $request->file('image_upload')->extension();
                $name_image = now()->toDateString() . '-' . time() . '-' . 'post_img.' . $ext;
                $img = (new \Intervention\Image\ImageManager)->make($file_image->path())->fit(300)->encode('jpg');
                $path = public_path('images/').$name_image;

                $img->save($path);

                //$file_image->move(public_path('images'), $name_image);
            }

            DB::table("wp_yoast_indexable")->insert([
                'object_id' => $post[0]->ID,
                'object_type' => 'post',
                'object_sub_type' => 'post',
                'author_id' => $request->tac_gia,
                'description' => $request->mo_ta,
                'breadcrumb_title' => $request->tieu_de,
                'post_status' => 'publish',
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s'),
                'twitter_image' => URL::to('') . '/images/' . $name_image,
                'primary_focus_keyword' => $request->meta_key,
                'meta_robot' => $request->meta_robot,
                'permalink' => 'https://rdone.net/images/' . $name_image,
                'permalink_hash' => '']);

            DB::table("wp_term_relationships")->insert([
                'object_id' => $post[0]->ID,
                'term_taxonomy_id' => $request->the_loai,
                'term_order' => '0'
            ]);
//            if (!empty($request->input('selected'))) {
//
//
//                foreach ($request->input('selected') as $value) {
//                    $ID_will_insert = DB::table('wp_posts')
//                        ->where('post_status','=','publish')
//                        ->where('post_type','=','post')
//                        ->where('post_title', '=', $value)->get()->toArray();
//
//                    try {
//                        DB::table("hwp_baivietlq")->insert([
//                            'ID_BV_Chinh' => $post[0]->ID,
//                            'ID_BV_LQ' => $ID_will_insert[0]->ID
//                        ]);
//                    }
//                    catch (\Exception $i){
//                        DB::table("hwp_baivietlq")->insert([
//                            'ID_BV_Chinh' => $post[0]->ID,
//                            'ID_BV_LQ' => $ID_will_insert[1]->ID
//                        ]);
//                    }
//
//                }
//
//            }


            return redirect()->route('trang_chu');
//        } catch (\Exception $e) {
//            return abort(404);
//        }
    }

    public function suaBaiViet(Request $request)
    {
        try {
            $posts = DB::table('wp_posts')
                ->select('wp_posts.ID', 'wp_posts.post_title', 'wp_posts.post_name',
                    'wp_posts.post_author', 'wp_posts.post_date', 'wp_yoast_indexable.description',
                    'wp_posts.post_content', 'wp_yoast_indexable.twitter_image',
                    'wp_yoast_indexable.primary_focus_keyword','wp_term_relationships.term_taxonomy_id')
                ->join("wp_yoast_indexable", "object_id", "=", "wp_posts.ID")
                ->join('wp_term_relationships', "wp_posts.ID", "=", "wp_term_relationships.object_id")
                ->where("wp_posts.ID", '=', $request->id)
                ->get()->toArray();

            $item = $posts[0];
            $users = DB::table('wp_users')->select("ID", "user_login")->get()->toArray();
            $categories = DB::table('wp_term_taxonomy')->select("term_taxonomy_id", 'name')
                ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_taxonomy_id')
                ->where('taxonomy', '=', 'category')
//                ->where('term_taxonomy_id', '<=', '98')
//                ->where('term_taxonomy_id', '>=', '5')
                ->get()
                ->toArray();
//            $ds_lienquan = DB::table('wp_baivietlq')
//                ->select("wp_baivietlq.ID_BV_Chinh", 'wp_baivietlq.ID_BV_LQ', "wp_posts.post_title", "wp_posts.ID")
//                ->join('wp_posts', 'wp_baivietlq.ID_BV_LQ', 'wp_posts.ID')
//                ->where('post_type', '=', 'post')
//                ->where('post_status', '=', 'publish')
//                ->where('wp_posts.comment_status','=','open')
//                ->where('ID_BV_Chinh', '=', $request->id)
//                ->get()->toArray();
//            $list_id_ds_lienquan = array();
//            foreach ($ds_lienquan as $item_a) {
//                array_push($list_id_ds_lienquan, $item_a->ID);
//            }
//            dd($ds_lienquan);
//            $ds_post = DB::table('wp_posts')
//                ->select('wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title', 'wp_posts.post_name')
//                ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                ->join('wp_users', 'wp_posts.post_author', '=', 'wp_users.id')
//                ->where('object_type','=','post')
//                ->where('wp_posts.post_type', '=', 'post')
//                ->where('wp_posts.post_status', '=', 'publish')
//                ->where('wp_posts.comment_status','=','open')
//                ->where("wp_posts.ID",'!=',$request->id)
//                ->whereNotIn("wp_posts.ID", $list_id_ds_lienquan)
////            ->where('wp_yoast_indexable.object_type', '=', 'post')
//                ->orderBy('wp_posts.ID', 'desc')
//                ->get()->toArray();

            return view('admin.baiviet.sua_bai_viet', compact('item', 'users', 'categories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function updateBaiViet(Request $request)
    {
       try {
        $ses = $request->session()->get('tk_user');


            if (isset($ses) && ($request->session()->get('role')[0] == 'admin' || $request->session()->get('role')[0] == 'nv')) {
                $markupFixer  = new \TOC\MarkupFixer();
                $contentWithMenu = $markupFixer->fix($request->noi_dung);
                $request->tieu_de = preg_replace('/\s+/', " ", $request->tieu_de);
                DB::table('wp_posts')->where('ID', '=', $request->id)
                    ->update([
//                        'acsaasc' => 'acsacacacsa',
                        'post_title' => $request->tieu_de,
                        'post_content' => $request->noi_dung,
//                        'post_author' => $request->tac_gia,
                        'post_name' => $request->post_name,
                        'post_date' => date('y-m-d h:i:s'),
                        'post_date_gmt' => date('y-m-d h:i:s'),
                        'post_modified' => date('y-m-d h:i:s'),
                        'post_modified_gmt' => date('y-m-d h:i:s'),
                        'post_type' => "post",
                        'post_status' => "publish",
                        'post_excerpt' => "",
                        'to_ping' => "",
                        'pinged' => "",
                        'post_content_filtered' => ""
                    ]);
                if ($request->image_upload != null) {
                    $file_image = $request->file('image_upload');
                    $ext = $request->file('image_upload')->extension();
                    $name_image = now()->toDateString() . '-' . time() . '-' . 'edit_post_img.' . $ext;
                    $img = (new \Intervention\Image\ImageManager)->make($file_image->path())->fit(300)->encode('jpg');
                    $path = public_path('images/').$name_image;

                    $img->save($path);

                    DB::table("wp_yoast_indexable")->where('object_id', '=', $request->id)
                        ->update([
                            'object_type' => 'post',
                            'object_sub_type' => 'post',
                            'author_id' => $request->tac_gia,
                            'description' => $request->mo_ta,
                            'breadcrumb_title' => $request->tieu_de,
                            'post_status' => 'publish',
                            'created_at' => $request->date,
                            'updated_at' => date('y-m-d h:i:s'),
                            'primary_focus_keyword' => $request->meta_key,
                            'meta_robot'=>$request->meta_robot,
                            'twitter_image' => URL::to('') . '/images/' . $name_image,
                            'permalink' => 'https://autocad123.vn/images/' . $name_image,
                        ]);
                }
                else{
                    DB::table("wp_yoast_indexable")->where('object_id', '=', $request->id)
                        ->update([
                            'object_type' => 'post',
                            'object_sub_type' => 'post',
                            'author_id' => $request->tac_gia,
                            'description' => $request->mo_ta,
                            'breadcrumb_title' => $request->tieu_de,
                            'post_status' => 'publish',
                            'created_at' => $request->date,
                            'updated_at' => date('y-m-d h:i:s'),
                            'primary_focus_keyword' => $request->meta_key,
                            'meta_robot'=>$request->meta_robot,
                        ]);
                }



                DB::table("wp_term_relationships")->where('object_id', '=', $request->id)
                    ->update([
                        'term_taxonomy_id' => $request->the_loai,
                        'term_order' => '0'
                    ]);

//                if (!empty($request->input('selected'))) {
//                    DB::table("wp_baivietlq")->where('ID_BV_Chinh', '=', $request->id)->delete();
//
//                    foreach ($request->input('selected') as $value) {
//                        $ID_will_insert = DB::table('wp_posts')
//                            ->where('post_status','=','publish')
//                            ->where('post_type','=','post')
//                            ->where('post_title', '=', $value)->get()->toArray();
//                        try {
//                            DB::table("wp_baivietlq")->insert([
//                                'ID_BV_Chinh' => $request->id,
//                                'ID_BV_LQ' => $ID_will_insert[0]->ID
//                            ]);
//                        }
//                        catch (\Exception $i){
//                            DB::table("wp_baivietlq")->insert([
//                                'ID_BV_Chinh' => $request->id,
//                                'ID_BV_LQ' => $ID_will_insert[1]->ID
//                            ]);
//                        }
//
//                    }
//                } else {
//                    DB::table("wp_baivietlq")->where('ID_BV_Chinh', '=', $request->id)->delete();
//                }
                if (session("tasks_url")){
                    return redirect(session("tasks_url"));
                }
                return redirect()->route('trang_chu');
            } else {
                return redirect('/admin/login');

        }
        } catch (\Exception $e) {
           return redirect(session("tasks_url"));
        }
    }

    public function danhSachBaiViet(Request $request)
    {
//        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
//                $index = 1;
                $ds_bai_viet = DB::table('wp_posts')
                    ->select( 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title',
                        'wp_yoast_indexable.twitter_image', 'wp_posts.post_name','wp_users.display_name',
                        'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title','wp_posts.id_key')
                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
                    ->join('wp_users','wp_users.id','=','wp_posts.post_author')
                        ->where('object_type','=','post')
                    ->where('wp_posts.post_type', '=', 'post')
                    ->where('wp_posts.post_status', '=', 'publish')
                    ->orderBy('wp_posts.ID', 'desc')
                    ->simplePaginate(15);
//                $ds_post1 = DB::table('wp_posts')
//                    ->select('wp_yoast_indexable.twitter_image')
//                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                    ->where('id_key','=',0)->get()->toArray();
//                $ds_post2 = DB::table('wp_posts')
//                    ->select('wp_yoast_indexable.twitter_image','wp_posts.ID')
//                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                    ->where('id_key','!=',0)->get()->toArray();
//                foreach ($ds_post2 as $post){
//                    $img= rand(0,count($ds_post1)-1);
//                    DB::table('wp_yoast_indexable')
//                        ->where('wp_yoast_indexable.object_id', '=', $post->ID)
//                        ->update([
//                            'twitter_image'=>$ds_post1[$img]->twitter_image
//                        ]);
//                }





                Session::put('tasks_url',$request->fullUrl());
                return view("admin.baiviet.danh_sach_bai_viet", compact('ds_bai_viet'));
            } else {
                return redirect('/admin/login');

            }

//        } catch (\Exception $e) {
//            return abort(404);
//        }
    }

    public function xoaBaiViet($id, Request $request)
    {

        $ses = $request->session()->get('tk_user');

        if (isset($ses) && $request->session()->get('role')[0] == 'admin') {
            DB::table('wp_posts')->where('ID', '=', $id)->delete();

            DB::table("wp_yoast_indexable")->where('object_id', '=', $id)->delete();

            $list_key = DB::table('wp_tong_hop')->get()->toArray();
            foreach ($list_key as $key){
                $post =  DB::table('wp_posts')->where('id_key', '=', $key->id)->get()->toArray();
                if (count($post)==0){
                    DB::table('wp_tong_hop')->where('id',$key->id)->delete();
                }
            }
            DB::table("wp_term_relationships")->where('object_id', '=', $id)->delete();

//            DB::table("wp_baivietlq")->where('ID_BV_Chinh', '=', $id)->delete();
//            DB::table("wp_baivietlq")->where('ID_BV_LQ', '=', $id)->delete();
        }
        return redirect()->back();
    }

    public function timBaiViet(Request $request)
    {
        try {
            $ses = $request->session()->get('tk_user');
            if (isset($ses)) {
                $index = 1;
                if (isset($_GET['s']) && strlen($_GET['s']) >= 1) {
                    $search_text = $_GET['s'];
                    $ds_bai_viet = DB::table('wp_posts')
                        ->select( 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title',
                            'wp_yoast_indexable.twitter_image', 'wp_posts.post_name','wp_posts.id_key','wp_users.display_name',
                            'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title')
                        ->join('wp_yoast_indexable', 'wp_posts.ID', '=', 'wp_yoast_indexable.object_id')
                        ->join('wp_users', 'wp_posts.post_author', '=', 'wp_users.id')
                        ->where('wp_posts.post_title', 'like', '%' . $search_text . '%')
                        ->where('wp_posts.post_name', '!=', '')
                        ->where('wp_posts.post_type', '=', 'post')
                        ->orderBy('wp_posts.ID', 'desc')->simplePaginate(15);
                    Session::put('tasks_url',$request->fullUrl());
                    return view("admin.baiviet.danh_sach_bai_viet", compact('search_text','ds_bai_viet', 'index'));
                }
            } else {
                return redirect('/admin/login');

            }

        } catch (\Exception $e) {
            return abort(404);
        }
    }

//    public function thongKeView(Request $request)
//    {
//        try {
//            $ses = $request->session()->get('tk_user');
//            if (isset($ses)) {
//                $index = 1;
//                $ds_bai_viet = DB::table('wp_posts')
//                    ->select('wp_users.display_name', 'wp_posts.ID', 'wp_posts.post_date', 'wp_posts.post_content', 'wp_posts.post_title',
//                        'wp_yoast_indexable.twitter_image', 'wp_posts.post_name',
//                        'wp_yoast_indexable.permalink', 'wp_yoast_indexable.title', 'wp_yoast_indexable.description', 'wp_yoast_indexable.breadcrumb_title')
//                    ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
//                    ->join('wp_users', 'wp_posts.post_author', '=', 'wp_users.id')
//                    ->where('object_type','=','post')
//                    ->where('wp_posts.post_type', '=', 'post')
//                    ->where('wp_posts.post_status', '=', 'publish')
//                    ->where('wp_posts.comment_status','=','open')
//                    ->orderBy('wp_posts.ID', 'desc')
//                    ->get()->toArray();
//
//                $r_start = $request->start;
//                $r_end = $request->end;
//                $str_start = date('y-m', strtotime(str_replace('/', '-', $request->start)));
//                $str_end = date('y-m', strtotime(str_replace('/', '-', $request->end)));
////            echo ($str_start );
//
////            $str = date('y-m');
//                usort($ds_bai_viet, function ($first, $second) use ($str_start, $str_end, $r_start, $r_end) {
//                    $v_f = json_decode($first->post_view, true);
//                    $v_s = json_decode($second->post_view, true);
//                    $post_f = 0;
//                    $post_s = 0;
//                    if ($str_start == $str_end) {
//                        // trong cùng tháng
//                        if (!is_array($v_f)) {
//                            $v_f = array($str_start => 0);
//                        }
//                        if (!is_array($v_s)) {
//                            $v_s = array($str_start => 0);
//                        }
//                        if (empty($v_f[$str_end]) || (empty($v_f[$str_end]) && empty($v_f[$str_start])) || empty($v_f[$str_start])) {
//                            $post_f = 0;
//                        } else {
//                            $post_f = (int)$v_f[$str_start] + (int)$v_f[$str_end];
//                        }
//                        if (empty($v_s[$str_start]) || empty($v_s[$str_end]) || (empty($v_s[$str_end]) && empty($v_s[$str_start]))) {
//                            $post_s = 0;
//                        } else {
//                            $post_s = (int)$v_s[$str_start] + (int)$v_s[$str_end];
//                        }
////                    var_dump($v_f); ;
////                    echo $post_f;
////                    echo "<br/>";
////                    var_dump($v_s);
////                    echo $post_s;
////                    echo $v_s[$str_start];
////                    dd("");
//                    } else {
//                        // khác tháng
//                        $m_start = date('m', strtotime(str_replace('/', '-', $r_start)));
//                        $m_end = date('m', strtotime(str_replace('/', '-', $r_end)));
//                        for ($i = 0; $i <= (int)$m_end - (int)$m_start; $i++) {
//                            $tg = date('y-m', strtotime("+" . $i . " months", strtotime(str_replace('/', '-', $r_start))));
//                            if (!empty($v_f[$tg])) {
//                                $post_f += (int)$v_f[$tg];
//                            }
//                            if (!empty($v_s[$tg])) {
//                                $post_s += (int)$v_s[$tg];
//                            }
//                        }
//                    }
//
//                    return $post_f < $post_s;
//                });
////            dd($ds_bai_viet);
//
//                return view("admin.baiviet.thong_ke_view", compact('ds_bai_viet', 'index', 'str_start', 'str_end', 'r_start', 'r_end'));
//            } else {
//                return redirect('/admin/login');
//
//            }
//
//        } catch (\Exception $e) {
//            return abort(404);
//        }
//    }

}
