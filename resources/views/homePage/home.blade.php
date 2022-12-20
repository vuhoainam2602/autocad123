@extends('layouts.layout')
@section('meta')
    <title id="titleIndex">Autocad123</title>
    <meta name="copyright" content="https://autocad123.vn/">
    <meta name="keywords"
          content="rdone, autocard, bản vẽ xây dựng, phần mềm xây dựng, xây dựng, excel, hướng dẫn excel">
    <meta name="description"
          content="Các bạn có thể tìm thấy rất nhiều file autocad về chi tiết trần thạch cao, công nghệ thi công với vật liệu thạch cao. Nhưng Rdone của chúng tôi luôn mang đến ...">
    <meta name="author" content="spec.edu.vn">
    <meta property="og:site_name" content="Wikipedia">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Trang chủ">
    <meta property="og:description"
          content="Các bạn có thể tìm thấy rất nhiều file autocad về chi tiết trần thạch cao, công nghệ thi công với vật liệu thạch cao. Nhưng Rdone của chúng tôi luôn mang đến ...">
    <meta property="og:image" content="https://thoitrangwiki.com/wp-content/uploads/2017/02/dich-vu-tu-van-thiet-ke-xay-dung.jpg">
    <meta name="copyright" content="Copyright © 2021 SPEC LEARNING">
    <meta property="og:type" content="threed.asset">
    <meta property="og:asset" content="https://autocad123.vn/">
    <link rel="canonical" href="https://autocad123.vn/">

@endsection
{{--@section('banner')--}}
{{--    @if(!empty($banner_ngang))--}}
{{--        <img id="banner-ngang" src="{{asset('banners/'.$banner_ngang)}}" alt="">--}}
{{--    @endif--}}
{{--@endsection--}}
@section('content-left')
    <div class="content-left col-xxl-9 col-xl-9 col-lg-2 col-lg-9 col-md-9 col-sm-12 col-xs-12 ">

        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'download-cad']).'/'}}" class="text-dark">Download</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_44[0]->post_name])}}"><img
                            src="{{$term_relationship_44[0]->twitter_image}}"
                            alt="{{$term_relationship_44[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_44[0]->post_name])}}">{{$term_relationship_44[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              {{$term_relationship_44[0]->description}}
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_44[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_44[$i]->twitter_image}}"
                                                alt="{{$term_relationship_44[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_44[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_44[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
        </div>
        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'lenh-cad']).'/'}}" class="text-dark">Lệnh</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_45[0]->post_name])}}"><img
                            src="{{$term_relationship_45[0]->twitter_image}}"
                            alt="{{$term_relationship_45[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_45[0]->post_name])}}">{{$term_relationship_45[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              {{$term_relationship_45[1]->description}}
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_45[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_45[$i]->twitter_image}}"
                                                alt="{{$term_relationship_45[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_45[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_45[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
        </div>
        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'meo-cad']).'/'}}" class="text-dark">Mẹo</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_46[0]->post_name])}}"><img
                            src="{{$term_relationship_46[0]->twitter_image}}"
                            alt="{{$term_relationship_46[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_46[0]->post_name])}}">{{$term_relationship_46[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              Sở hữu diện tích mặt sàn 8x12m và gia chủ có ý định xây nhà theo hướng biệt thự để đảm bảo diện tích sinh hoạt bên trong của gia đình đồng thời sở hữu nét thẩm mỹ và cảnh quan độc đáo. tượng. Sau khi...
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_46[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_46[$i]->twitter_image}}"
                                                alt="{{$term_relationship_46[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_46[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_46[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
        </div>
        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'thu-vien-cad']).'/'}}" class="text-dark">Thư viện</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_47[0]->post_name])}}"><img
                            src="{{$term_relationship_47[0]->twitter_image}}"
                            alt="{{$term_relationship_47[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_47[0]->post_name])}}">{{$term_relationship_47[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              Nội thất nhà hướng Tây có sức hút kì lạ nhờ cách bố trí nội thất và kiến trúc độc đáo. Trái ngược hoàn toàn với mặt tiền có phần đơn điệu, bên trong căn nhà 4 tầng lại được thiết kế vô cùng đặc biệt....
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_47[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_47[$i]->twitter_image}}"
                                                alt="{{$term_relationship_47[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_47[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_47[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
        </div>
        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'ban-ve-cad']).'/'}}" class="text-dark">Bản vẽ</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_49[0]->post_name])}}"><img
                            src="{{$term_relationship_49[0]->twitter_image}}"
                            alt="{{$term_relationship_49[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_49[0]->post_name])}}">{{$term_relationship_49[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              {{$term_relationship_49[0]->description}}
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_49[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_49[$i]->twitter_image}}"
                                                alt="{{$term_relationship_49[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_49[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_49[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
        </div>
        <div class="category-item">
            <div class="title-arti text-uppercase fw-bold fs-3 " style="border-bottom: 1px solid red;">
                                <a href="{{route('category',['slug'=>'bai-viet-hay-ve-cad']).'/'}}" class="text-dark">Bài viết hay</a>
            </div>
            <section class="block-arti mt-4 row">
                <div class="arti-left col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 p-0">
                    <a href="{{route('postDetail',['slug'=>$term_relationship_50[0]->post_name])}}"><img
                            src="{{$term_relationship_50[0]->twitter_image}}"
                            alt="{{$term_relationship_50[0]->post_title}}"
                        /></a>

                    <h2 class="mb-2 mt-2">
                        <strong><a class="text-dark fs-3"
                                   href="{{route('postDetail',['slug'=>$term_relationship_50[0]->post_name])}}">{{$term_relationship_50[0]->post_title}}</a></strong>
                    </h2>
                    <span class="text-decrip-4 fs-4">
              {{$term_relationship_50[0]->description}}
                </span>
                </div>

                <div class="arti-right col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 ps-5">
                    @for($i=1;$i<=4;$i++)
                        <ul class="list-topic">
                            <li class="itemtopic pb-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_50[$i]->post_name])}}"><img
                                                class="text-dark"
                                                style="width: 70px;height: 70px;"
                                                src="{{$term_relationship_50[$i]->twitter_image}}"
                                                alt="{{$term_relationship_50[$i]->post_title}}"
                                            /></a>
                                    </div>
                                    <div class="col-9 pb-2">
                                        <a href="{{route('postDetail',['slug'=>$term_relationship_50[$i]->post_name])}}"
                                           class="fs-4 text-dark"
                                        >{{$term_relationship_50[$i]->post_title}}</a
                                        >
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endfor
                </div>
            </section>
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

{{--@section('footer')--}}
{{--    <footer class="container footer mt-4 pt-4">--}}
{{--        <ul class="list-tag pt-4 mt-4" style="border-top: 1px solid red;">--}}
{{--            <li class="d-inline fw-bold ">--}}
{{--                <a href="" class="fs-3">Tag: </a>--}}
{{--            </li>--}}
{{--            @foreach($list_tag as $tags)--}}
{{--                <li class="item-tag">--}}

{{--                    <a href="{{route('tag',['slug'=>$tags->slug]).'/'}}" class="fs-4">{{$tags->name}}</a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </footer>--}}
{{--@endsection--}}
