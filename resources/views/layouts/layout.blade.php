<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
    <meta name="Language" content="Vietnamese">
    <meta name="Designer" content="RDSIC">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-language" content="vi">
    <meta name="copyright" content="https://autocad123.vn/">
    <meta name="”robots”" content="”index,follow”">
    <meta property="og:type" content="article">
    <meta name="copyright" content="Copyright © Wikipedia">
    <meta property="og:type" content="threed.asset">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="https://autocad123.vn/sitemap.xml">
{{--    <link href="{{asset("css/css_client/global.css")}}" rel="stylesheet">--}}
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link rel="dns-prefetch" href="https://www.google-analytics.com"/>--}}
{{--    <link rel="dns-prefetch" href="https://www.googletagmanager.com"/>--}}
{{--    <link rel="dns-prefetch" href="https://www.googleadservices.com"/>--}}
{{--    <link rel="dns-prefetch" href="https://stats.g.doubleclick.net"/>--}}
{{--    <link rel="dns-prefetch" href="https://www.google.com"/>--}}
{{--    <link rel="dns-prefetch" href="https://www.google.com.sg"/>--}}
{{--    <link rel="dns-prefetch" href="https://stats.g.doubleclick.net"/>--}}
{{--    <link rel="dns-prefetch" href="https://googleads.g.doubleclick.net"/>--}}
{{--    <link rel="dns-prefetch" href="https://stc.sp.zdn.vn/"/>--}}
{{--    <link rel="dns-prefetch" href="connect.facebook.net"/>--}}
{{--    <link rel="dns-prefetch" href="pagead2.googlesyndication.com"/>--}}
{{--    <link rel="dns-prefetch" href="fonts.gstatic.com"/>--}}
{{--    <link rel="dns-prefetch" href="www.gstatic.com"/>--}}
{{--    <link rel="dns-prefetch" href="www.googletagservices.com"/>--}}
{{--    <link rel="preconnect"  href="https://www.googletagmanager.com"/>--}}
{{--    <link rel="preconnect" href="https://www.google-analytics.com"/>--}}
{{--    <link rel="preconnect" href="https://www.googleadservices.com"/>--}}
{{--    <link rel="preconnect" href="https://stats.g.doubleclick.net"/>--}}
{{--    <link rel="preconnect" href="https://www.google.com"/>--}}
{{--    <link rel="preconnect" href="https://www.google.com.sg"/>--}}
{{--    <link rel="preconnect" href="https://stats.g.doubleclick.net"/>--}}
{{--    <link rel="preconnect" href="https://googleads.g.doubleclick.net"/>--}}
{{--    <link rel="preconnect" href="https://stc.sp.zdn.vn/"/>--}}
{{--    <link rel="preconnect" href="connect.facebook.net"/>--}}
{{--    <link rel="preconnect" href="pagead2.googlesyndication.com"/>--}}
{{--    <link rel="preconnect" href="fonts.gstatic.com"/>--}}
{{--    <link rel="preconnect" href="www.gstatic.com"/>--}}
{{--    <link rel="preconnect" href="www.googletagservices.com"/>--}}
{{--    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3063449043875072"--}}
{{--            crossorigin="anonymous"></script>--}}
@include('layouts.lib_head')

    <!-- Google tag (gtag.js) -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CECVBSV59P"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}

{{--        gtag('config', 'G-CECVBSV59P');--}}
{{--    </script>--}}
{{--    <link href="{{asset("css/css_client/hocwp-custom-front-end.css")}}" rel="stylesheet">--}}
{{--    <link href="{{asset("css/css_client/bootstrap.min.css")}}" rel="stylesheet">--}}
{{--    <link href="{{asset("js/js_client/hocwp-custom-front-end.css")}}" rel="stylesheet">--}}

@yield('meta')
@include('layouts.lib_bs5')
@include('layouts.lib_jquery')


    <style>

        ul,li{
            padding: 20px;
        }
        .material-symbols-outlined{
            display: none;
        }


        iframe {
            aspect-ratio: 16 / 9;
            width: 100% !important;
        }
        .entry-content h2,
        .entry-content h3 {
            font-weight: 700;
        }

        .post_title {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .entry-content li {
            list-style-type: decimal;
        }

        #toc_container {
            background: #f9f9f9 none repeat scroll 0 0;
            border: 1px solid #aaa;
            display: block;
            font-size: 95%;
            margin-bottom: 1em;
            padding: 20px;
            padding-left: 30px;
            width: 100%;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .toc_title {
            font-weight: 700;
            text-align: center;
        }

        #toc_container li, #toc_container ul, #toc_container ul li {
            list-style-type: decimal;
        }

        #toc_container ul {
            padding-left: 30px;
        }

        #banner-ngang {
            display: block;
            object-fit: cover;
            height: 90px;
            width: 728px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
        }

        #banner-doc {
            display: block;
            object-fit: cover;
            height: 300px;
            width: 250px;
            margin-left: auto;
            margin-right: auto;
        }

        .title_text {
            font-size: 2rem;
            font-weight: 700;
        }

        . {
            max-width: 100%;
            height: 142px;
            vertical-align: super;
            object-fit: cover;
        }

        .notSearch {
            font-size: 3rem;
            margin-top: 50px;
        }

        /*.inner {*/
        /*    padding-left: 15px;*/
        /*    padding-right: 15px;*/
        /*}*/

        .pull-left img {
            display: block;
            margin-right: auto;
            margin-left: auto;
            width: 100%;
            height: 290px;
            object-fit: fill;
        }

        .pull-left {
            margin-top: 40px;
        }
        .clearfix img{
            float: none;
        }
        .flex-direc{
            flex-direction: column;
        }

        .post_img{
            width: auto;
            height:auto;
        }
        @media (min-width: 560px) {

            .pull-left img {
                width: 85%;
                height: 300px;
                margin-left: 0;
                object-fit: fill;
            }
        }

        @media (min-width: 640px) {

            .pull-left img {
                width: 90%;
                height: 350px;
                margin-left: 0;
                object-fit: fill;
            }

            .clearfix img{
                float: left;
            }
            .text-decrip-4{
                display:-webkit-box;
            }
            .flex-direc{
                flex-direction: row-reverse;
            }
            .post_img{
                width: 130px;
                height:130px;
            }
        }

        @media (min-width: 768px) {
            .pull-left {
                margin: 0;
            }

            .pull-left img {
                width: 100%;
                height: 130px;
                object-fit: fill;
            }


        }

        @media (min-width: 992px) {
            .pull-left img {
                width: 100%;
                height: 170px;
                object-fit: fill;
            }
        }

    </style>
</head>
<body class="">
@yield('link-anh')
<nav class="navbar block-nav  navbar-expand-lg navbar-light bg-light" style="position: sticky;top: 0;z-index: 1000;height: 50px">
    <div class="container">
        <button class="navbar-toggler" id="shownav" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="list-menu navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item item-menu">
                    <a @class('nav-link') href="{{route('postShow')}}">Trang chủ</a>
                </li>
                <li class="nav-item item-menu">
                    <a @class('nav-link')  href="{{route('category',['slug'=>'tai-lieu-cad'])}}">Tài liệu </a>

                </li>
                <li class="nav-item item-menu">
                    <a @class('nav-link')  href="{{route('category',['slug'=>'dowload-autocad-ban-quyen'])}}">Download Autocad</a>

                </li>
                <li class="nav-item item-menu">
                    <a @class('nav-link') href="{{route('category',['slug'=>'tinh-nang-moi-tren-autocad'])}}">Tính năng autocad</a>

                </li>
                <li class="nav-item item-menu">
                    <a @class('nav-link') href="{{route('category',['slug'=>'cac-cong-cu-tim-kiem-trong-cad'])}}">Công cụ tìm kiếm</a>

                </li>
            </ul>

            <form method="get" class="d-flex" action="{{route('postSearch')}}">
                <input
                    type="text"
                    class="form-control fs-5  me-2"
                    placeholder="Tìm kiếm bài viết"
                    aria-label="Username"
                    aria-describedby="basic-addon1"
                    value=""
                    name="s"
                />
                <input type="submit" class="search-submit" value="Tìm kiếm">
            </form>

        </div>
    </div>
</nav>
<div class="content container mb-4">

{{--    <a href="{{Request::root().'/'}}" class="ms-4 mt-3 title">--}}
{{--        <img src="https://thoitrangwiki.com/wp-content/uploads/2016/03/nha-dep-4-1.png">--}}
{{--    </a>--}}

    <div class="row mt-4">
        @yield('banner')
        @yield('content-left')
        <div class="content-right  col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
            <div class="hsidebar">
{{--                <div id="text-10" class="widget widget_text"><h3 class="widget-title widgettitle fw-bold"><span--}}
{{--                            class="nha-dep-thinh-hanh">Nhà Đẹp Thịnh Hành</span></h3>--}}
{{--                    <hr>--}}
{{--                    <div class="textwidget"><p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                                        href="{{Request::root()."/category/mau-biet-thu-dep"}}">Mẫu biệt thự</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-pho-dep"}}">Mẫu nhà phố</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-cap-4-dep"}}">Mẫu nhà cấp 4</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-1-tang-dep"}}">Mẫu nhà 1 tầng</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-2-tang-dep"}}">Mẫu nhà 2 tầng</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-3-tang-dep"}}">Mẫu nhà 3 tầng</a></strong></span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="text-11" class="widget widget_text"><h3 class="widget-title widgettitle fw-bold"><span--}}
{{--                            class="nha-dep-gia-re">Nhà Đẹp Giá Rẻ</span></h3>--}}
{{--                    <hr>--}}
{{--                    <div class="textwidget"><p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                                        href="{{Request::root()."/category/mau-nha-dep-100-trieu"}}">Mẫu nhà 100 triệu</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-dep-200-trieu"}}">Mẫu nhà 200 triệu</a></strong></span>--}}
{{--                        </p>--}}
{{--                        <p><span style="color: #0070c0;"><strong><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-nha-dep-300-trieu"}}">Mẫu nhà 300 triệu</a></strong></span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="text-9" class="widget widget_text"><h3 class="widget-title widgettitle fw-bold"><span--}}
{{--                            class="noi-that-nha-dep">Nội Thất Nhà Đẹp</span></h3>--}}
{{--                    <hr>--}}
{{--                    <div class="textwidget"><p><strong><span style="color: #0070c0;"><a style="color: #0070c0;"--}}
{{--                                                                                        href="{{Request::root()."/category/mau-tu-bep-dep"}}">Tủ bếp đẹp</a></span></strong>--}}
{{--                        </p>--}}
{{--                        <p><strong><span style="color: #0070c0;"><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-cau-thang-dep"}}">Cầu thang đẹp</a></span></strong>--}}
{{--                        </p>--}}
{{--                        <p><strong><span style="color: #0070c0;"><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-phong-ngu-dep"}}">Phòng ngủ đẹp</a></span></strong>--}}
{{--                        </p>--}}
{{--                        <p><strong><span style="color: #0070c0;"><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/mau-phong-khach-dep"}}">Phòng khách đẹp</a></span></strong>--}}
{{--                        </p>--}}
{{--                        <p><strong><span style="color: #0070c0;"><a style="color: #0070c0;"--}}
{{--                                                                    href="{{Request::root()."/category/tran-thach-cao-dep"}}">Trần thạch cao đẹp</a></span></strong>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @yield('content-right')
            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function () {
        $('#shownav').click(function () {
            console.log("jdjdjdjd")
            $('#navbarSupportedContent').toggleClass('d-inline')
        })
    })
</script>
<script>
    $("#toc_container").on('click', 'a', function (event) {
        event.preventDefault();
        var o = $($(this).attr("href")).offset();
        var sT = o.top - $(".navbar").outerHeight(true) - 30;
        window.scrollTo(0, sT);
    });
</script>
<footer>
    @include('layouts.lib_footer')
</footer>
@include('layouts.libs_js_bs5')
</body>
</html>

