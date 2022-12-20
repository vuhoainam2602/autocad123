<?php

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/random-pass/', 'PostController@randomkey')->name('random');
Route::get('/huong-dan-lay-pass/', 'PostController@random_bv')->name('random_bv');

Route::prefix('/admin')->group(function () {
    Route::get('/trang-chu', 'Admin\BaiVietController@danhSachBaiViet')->name('trang_chu');
    Route::get('/', 'Admin\BaiVietController@danhSachBaiViet')->name('trang_chu');
    Route::get('/them-bai-viet', 'Admin\BaiVietController@themBaiViet')->name('themBV');
    Route::post('/them-bai-viet', 'Admin\BaiVietController@luuBaiViet')->name('luuBV');
    Route::get('/sua-bai-viet/{id}', 'Admin\BaiVietController@suaBaiViet')->name('suaBV');
    Route::post('/sua-bai-viet', 'Admin\BaiVietController@updateBaiViet')->name('updateBV');
    Route::get('xoa-bai-viet/{id}', 'Admin\BaiVietController@xoaBaiViet')->name('xoaBV');
    Route::get('/tim-kiem', 'Admin\BaiVietController@timBaiViet')->name('timkiemBV');
    Route::get('/login', 'Admin\UsersController@view_login')->name('view_login');
    Route::post('/action-login', 'Admin\UsersController@action_login')->name('action_login');
    Route::get('/them-user', 'Admin\UsersController@page_user')->name('page_user');
    Route::post('/insert-user', 'Admin\UsersController@insert_user')->name('insert_user');
    Route::get('/index-user', 'Admin\UsersController@index_user')->name('index_user');
    Route::get('/edit-user/{id}', 'Admin\UsersController@page_edit_user')->name('page_edit_user');
    Route::post('/edit-user', 'Admin\UsersController@edit_user')->name('edit_user');
    Route::get('/delete-user/{id}', 'Admin\UsersController@delete_user')->name('delete_user');
    Route::get('/find-user', 'Admin\UsersController@find_user')->name('find_user');
    Route::get('bai-huong-dan', 'Admin\BaiHDController@danhsachHD')->name('ds_huong_dan');
    Route::get('them-huong-dan', 'Admin\BaiHDController@themHD');
    Route::get('tk-bv-hd', 'Admin\BaiHDController@searchBaiVietHD')->name('tk_huong_dan');
    Route::post('them-huong-dan', 'Admin\BaiHDController@luuHD')->name('luuHD');
    Route::get('sua-huong-dan/{id}', 'Admin\BaiHDController@suaHD')->name('suaHD');
    Route::post('sua-huong-dan', 'Admin\BaiHDController@updateHD')->name('updateHD');
    Route::get('xoa-huong-dan/{id}', 'Admin\BaiHDController@xoaHD')->name('xoaHD');
    Route::get('thong-ke-view-bai-viet-hd', 'Admin\BaiHDController@thongKeView')->name('thongKeViewHD');
    Route::get('danh-sach-key', 'Admin\KeyController@index')->name('ds_key');
    Route::get('them-key', 'Admin\KeyController@themKey');
    Route::post('them-key', 'Admin\KeyController@luuKey')->name('luuKey');
    Route::get('sua-key/{id}', 'Admin\KeyController@suaKey')->name('suaKey');
    Route::post('sua-key', 'Admin\KeyController@updateKey')->name('updateKey');
    Route::get('xoa-key/{id}', 'Admin\KeyController@xoaKey')->name('xoaKey');
    Route::get('tim-kiem-key', 'Admin\KeyController@searchKey')->name('timkiemKey');
    Route::get('thong-ke-view-bai-viet', 'Admin\BaiVietController@thongKeView')->name('thongKeView');
    Route::get('them-banner', 'Admin\BannerController@themBanner');
    Route::post('them-banner', 'Admin\BannerController@luuBanner')->name('luuBanner');
    Route::get('head','Admin\StructureController@displayHead')->name('displayHead');
    Route::post("head" , 'Admin\StructureController@updateHead')->name('updateHead');
    Route::get('footer','Admin\StructureController@displayFooter')->name('displayFooter');
    Route::post("footer" , 'Admin\StructureController@updateFooter')->name('updateFooter');
    Route::get('them-af', 'Admin\AFController@add')->name('addAF');
});
Route::prefix('/')->group(function () {
    // em chạy vào hàm postshow để lọc ra
    Route::middleware('beforeCacheMiddleware')->get('/', 'PostController@show')->name('postShow')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('category/{slug}/', 'TagController@index')->name('category')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('tag/{slug}/', 'TagController@index')->name('tag')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('hd/{slug}/.html', 'PostController@post_huong_dan')->name('post_hd')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('{slug}/page/{number}', 'AuthorController@index')->name('author')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('/search', 'PostController@search')->name('postSearch')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('/{slug}.html', 'PostController@postDetail')->name('postDetail')->middleware('afterCacheMiddleware');
    Route::middleware('beforeCacheMiddleware')->get('/suabai/top', 'TopListController@suabai')->middleware('afterCacheMiddleware');

//    Route::get('/{slug}.html/', function (){
//        return abort(404);
//    });
//    Route::get('/suabai/top/nam','TopListController@suabai');
});
//Route::get('/rd/xml/a/genrate-sitemap', function () {
//    // genarate site map
//    SitemapGenerator::create('https://rdone.net/')->writeToFile(public_path('sitemap.xml'));
//    echo "<script>window.close();</script>";
//});

Route::get('/rd/xml/a/clear-cache', function () {
    Artisan::call('cache:clear');
    echo "<script>window.close();</script>";
    return "Cache is cleared";
});

//Route::get('suabai/top','TopListController@suabai');
//Route::get('/rd/xml/a/genrate-sitemap', 'Admin\SiteMapController@index');
Route::get('/rd/xml/a/genrate-sitemap', function() {
    // create new sitemap object
    $sitemap = \app()->make('sitemap');

    // get all products from db (or wherever you store them)
    $products = DB::table('wp_posts')
        ->select('wp_posts.post_date', 'wp_posts.post_name')
        ->join('wp_yoast_indexable', 'wp_yoast_indexable.object_id', '=', 'wp_posts.id')
        ->where('wp_posts.post_type', '=', 'post')
        ->orderBy('wp_posts.ID', 'desc')
        ->get()->toArray();

    // counters
    $counter = 0;
    $sitemapCounter = 0;

    // add every product to multiple sitemaps with one sitemap index
    foreach ($products as $p) {
        if ($counter == 5000) {
            // generate new sitemap file
            $sitemap->store('xml', 'sitemap-page-' . $sitemapCounter);
            // add the file to the sitemaps array
            $sitemap->addSitemap(secure_url('sitemap-page-' . $sitemapCounter . '.xml'));
            // reset items array (clear memory)
            $sitemap->model->resetItems();
            // reset the counter
            $counter = 0;
            // count generated sitemap
            $sitemapCounter++;
        }

        // add product to items array
        $sitemap->add('https://autocad123.vn/' . $p->post_name . '.html', $p->post_date, 1, 'daily');
        // count number of elements
        $counter++;

    }
    // you need to check for unused items
    if (!empty($sitemap->model->getItems())) {
        $sitemap->addSitemap("https://autocad123.vn/", date('Y-m-d h:i:s'), 1, 'daily');
        // generate sitemap with last items
        $sitemap->store('xml', 'sitemap-page-' . $sitemapCounter);
        // add sitemap to sitemaps array
        $sitemap->addSitemap(secure_url('sitemap-page-' . $sitemapCounter . '.xml'));
        // reset items array
        $sitemap->model->resetItems();
    }

    // generate new sitemapindex that will contain all generated sitemaps above
    $sitemap->store('sitemapindex', 'sitemap');
//    return $sitemap->render('xml');
    return \Illuminate\Support\Facades\Redirect::to('sitemap.xml');
});
Route::get("create/robots" , 'RobotController@index')->name('index_Ro');

Route::post("create/robots" , 'RobotController@update')->name('updateRo');




