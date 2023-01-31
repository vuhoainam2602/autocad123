@extends('layouts.layout')
@section('meta')
    <title id="titleIndex">{{$post_detail[0]->post_title}}</title>
    <meta name="keywords" content="{{$post_detail[0]->primary_focus_keyword}}">
    <meta name="robots" content="{{$post_detail[0]->meta_robot}}"/>
    <meta name="description" content="{{$post_detail[0]->description}}">
    <meta property="og:site_name" content="{{Request::url()}}/">
    <meta property="og:url" content="{{Request::url()}}/">
    <meta property="og:title" content="{{$post_detail[0]->post_title}}">
    <meta property="og:description" content="{{$post_detail[0]->description}}">
    <meta property="og:image" content="{{$post_detail[0]->twitter_image}}">
    <meta property="og:asset" content="{{Request::url()}}/">
    <link rel="canonical" href="{{Request::url()}}/">
@endsection
{{--@section('banner')--}}
{{--    @if(!empty($banner_ngang))--}}
{{--        <img id="banner-ngang" src="{{asset('banners/'.$banner_ngang)}}" alt="">--}}
{{--    @endif--}}
{{--@endsection--}}
@section('content-left')
    <div class="content-left col-xxl-9 col-xl-9 col-lg-2 col-lg-9 col-md-9 col-sm-12 col-xs-12  ">
        <header class="entry-header">
            <h1 class="entry-title">{{$post_detail[0]->post_title}}</h1>
            <div class="post-meta">
                <span class="meta-date date updated"><i class="fa fa-calendar"></i>{{$post_detail[0]->post_date}}</span>
                <span class="category-post"><i class="fa fa-archive"></i><a
                        href="{{Request::root()."/category/".$wp_terms[0]->slug.'/'}}"
                        rel="tag">{{$wp_terms[0]->name}}</a></span>
            </div>
        </header>
        <div class="entry-content">


            {!! html_entity_decode($post_detail[0]->post_content) !!}
            <div class="thoit-sau-noi-dung" id="thoit-397322930">
                <div class="banner"
                     style="padding:15px; text-align:center; line-height:2; border: 3px solid #1a52f2; border-radius: 10px;">
                    <div class="banner-content">
                        <p><span style="color:#FF0000;"><span style="font-size:16px;"><strong>CƠ HỘI TIẾT KIỆM TRÊN 100 TRIỆU KHI XÂY NHÀ</strong></span></span>
                        </p>

                        <p style="box-sizing: border-box; outline: 0px; margin: 0px 0px 10px; color: rgb(65, 65, 65); font-family: arial, sans-serif; font-size: 14px; text-align: left;">
                            <b>[Miễn phí] </b>Bạn có sẽ được tư vấn miễn phí, miễn phí thiết kế, nhận ngay 10 báo giá
                            cạnh tranh&nbsp;với các giải pháp kết cấu khác nhau giúp tiết kiệm hàng chục triệu đồng.
                        </p>

                        <a target="_blank" href="https://xaydungso.vn/thau-xay-dung" rel="nofollow" class="button"
                           style="background-image: linear-gradient(to bottom,#428bca 0,#2d6ca2 100%); color:#fff!important; background-repeat: repeat-x;
    border-color: #2b669a!important; text-decoration: none;outline:0;text-shadow: 0 -1px 0 rgba(0,0,0,.2);box-shadow: inset 0 1px 0 rgba(255,255,255,.15), 0 1px 1px rgba(0,0,0,.075);background-color: #428bca;    padding: 6px 12px;border-radius:4px">XEM
                            10 BÁO GIÁ TỐI ƯU</a>
                        <p></p>

                        <p style="box-sizing: border-box; outline: 0px; margin: 0px 0px 10px; color: rgb(65, 65, 65); font-family: arial, sans-serif; font-size: 14px;">
                            <b>[Miễn phí] </b>Tiết kiệm đến 70% chi phí thiết kế. Nhận ngay ít nhất 10 mẫu nhà đẹp, xem
                            trước mẫu nhà trước khi thuê.</p>

                        <a target="_blank" href="https://xaydungso.vn/thiet-ke-nha-dep" rel="nofollow" class="button"
                           style="background-image: linear-gradient(to bottom,#428bca 0,#2d6ca2 100%); color:#fff!important; background-repeat: repeat-x;
    border-color: #2b669a!important; text-decoration: none;outline:0;text-shadow: 0 -1px 0 rgba(0,0,0,.2);box-shadow: inset 0 1px 0 rgba(255,255,255,.15), 0 1px 1px rgba(0,0,0,.075);background-color: #428bca;    padding: 6px 12px;border-radius:4px">XEM
                            10 MẪU NHÀ ĐẸP NHẤT</a>
                        <p></p>
                    </div>
                </div>
            </div>
            @if(!empty($list_bv_tham_khao))
                <section class="related m-b-15" style="margin-top: 30px;">
                    <header>
                        <div class="title">
                            <span class="icon_oneweb"></span>
                        </div>
                    </header>
                    <div id="show_post_related">


                        <div class="row fix-safari">
                            <div class="member_exps col-xs-12">
                                <h3><span
                                        class=" title_text primary-color text-uppercase font-bold">Bài viết liên quan</span>
                                </h3>
                                <div class="row auto-clear fix-safari" style="margin-top: 30px">

                                    @foreach($list_bv_tham_khao as $item)
                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 m-b-15"
                                             style="border-bottom: 1px solid #3a3a3a33;padding-bottom: 10px;">
                                            <div class="image">
                                                <a href="{{route('postDetail',['slug'=>$item->post_name])}}"
                                                   title="{{$item->post_title}}" target="_self" class=""><img style="width: 330px; height: 200px"
                                                        src="{{$item->twitter_image}}" alt="{{$item->post_title}}"
                                                        class="img-responsive"/></a></div>
                                            <div style="margin-top: 10px" class="name font-bold text-left m-t-15">
                                                <a href="{{route('postDetail',['slug'=>$item->post_name])}}"
                                                   title="{{$item->post_title}}" target="_self"
                                                   class="name text-decrip-2">{{$item->post_title}}</a></div>
                                            <span class="text-decrip-2 fs-5"
                                                  style="color: #646464;font-size: 12px;margin-top: 3px;letter-spacing: 0.5px;line-height: 20px;">
                        {{$item->description}}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section><!--  end .related -->
            @endif

        </div>

    </div>
@endsection

@section('content-right')
    <div class="title-theme fs-3 mb-3 pb-3" style="border-bottom: 1px solid rgba(138, 137, 137, 0.212);">
        <strong>Chủ đề nổi bật</strong>
    </div>

    <div class="inner">
        @for($i=0;$i<5; $i++)
            @if(!empty($list_chu_de_noi_bat[$i]))
                <div class="pull-left">
                    <div style="width: 100%;">
                        <a href="{{route('postDetail',['slug'=>$list_chu_de_noi_bat[$i]->post_name])}}"
                           title="{{$list_chu_de_noi_bat[$i]->post_title}}" target="_self"
                           class=""><img src="{{$list_chu_de_noi_bat[$i]->twitter_image}}"
                                         alt="{{$list_chu_de_noi_bat[$i]->post_title}}" width="332"
                                         height="265" class=" m-r-15"/></a>
                    </div>
                    <a href="{{route('postDetail',['slug'=>$list_chu_de_noi_bat[$i]->post_name])}}"
                       title="{{$list_chu_de_noi_bat[$i]->post_title}}" target="_self"
                       class="name font-bold" style="font-size: 16px ">{{$list_chu_de_noi_bat[$i]->post_title}}</a>
                    <span class="text-decrip-2 fs-5">
                        {{$list_chu_de_noi_bat[$i]->description}}</span>
                    <hr>
                </div>
            @endif
        @endfor
    </div>
@endsection


