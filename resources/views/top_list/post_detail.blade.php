@extends('layouts.layout')
{{--@dd($post_detail[0]->post_title);--}}
@section('meta')
{{--    @php--}}

{{--    @endphp--}}
    <title id="titleIndex">{{$post_detail[0]->post_title}}</title>
    <meta name="keywords" content="{{$post_detail[0]->primary_focus_keyword}}">
    <meta name="robots" content="{{$post_detail[0]->meta_robot}}"/>
    <meta name="description" content="{{$post_detail[0]->description}}">
    <meta property="og:site_name" content="{{Request::url()}}">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:title" content="{{$post_detail[0]->post_title .' - Wikipedia'}} ">
    <meta property="og:description" content="{{$post_detail[0]->description}}">
    <meta property="og:image" content="{{$post_detail[0]->twitter_image}}">
    <meta property="og:asset" content="{{Request::url()}}">
    <link rel="canonical" href="{{Request::url()}}">
@endsection
@section('link-anh')
    @if(!empty($post_detail[0]->twitter_description))
        {!! html_entity_decode($post_detail[0]->twitter_description) !!}
    @endif
@endsection
@section('content-left')
    <div class="content-left col-xxl-9 col-xl-9 col-lg-2 col-lg-9 col-md-9 col-sm-12 col-xs-12  ">
        <header class="entry-header">
            <h1 class="entry-title">{{$post_detail[0]->post_title}}</h1>
            <div class="post-meta">
                <span class="meta-date date updated"><i class="fa fa-calendar"></i>{{$post_detail[0]->post_date}}</span>
                @if(!empty($post_TH))
                <span class="category-post"><i class="fa fa-archive"></i><a
                        href="{{route('postDetail',['slug'=>$post_TH->post_name]).'/'}}"
                        rel="tag">{{$post_TH->post_title}}</a></span>
                @endif
            </div>
        </header>
        <div class="entry-content">

{{--            @php--}}
{{--                $tocGenerator = new \TOC\TocGenerator();--}}
{{--                $htmlOut =  $tocGenerator->getHtmlMenu($post_detail[0]->post_content,2,2);--}}
{{--                if (!empty($htmlOut)){--}}
{{--                    $htmlOut = "<div id=\"toc_container\"><p class=\"toc_title\">MỤC LỤC</p>".$tocGenerator->getHtmlMenu($post_detail[0]->post_content,2,3)."</div>";--}}
{{--                }--}}
{{--                echo $htmlOut;--}}
{{--            @endphp--}}
            {!! html_entity_decode($post_detail[0]->post_content) !!}

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
                                @if(!empty($key))
                                <span class=" title_text primary-color text-uppercase font-bold">Tìm kiếm có liên quan: {{$key->ten}}</span>
                                @endif
                                <div class="row auto-clear fix-safari" style="margin-top: 30px">
                                    @php
                                        $index=0;
                                    @endphp
{{--                                    @for($i =1;$i<=$count-1;$i++)--}}
{{--                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 m-b-15"--}}
{{--                                             style="border-bottom: 1px solid #3a3a3a33;padding-bottom: 10px;">--}}
{{--                                            <div class="image">--}}
{{--                                                <a href="{{route('postDetail',['slug'=>$list_post_has_key[$i]->post_name])}}"--}}
{{--                                                   title="{{$list_key[$i]->ten}}" target="_self" class=""><img--}}
{{--                                                        style="height: 160px;margin-bottom: 12px;"--}}
{{--                                                        src="{{$list_post_has_key[$i]->twitter_image}}"--}}
{{--                                                        alt="{{$list_key[$i]->ten}}"--}}
{{--                                                        class="img-responsive" width="332" height="265"/></a></div>--}}
{{--                                            <h3 style="margin-top: 0px" class="name font-bold text-left m-t-15">--}}
{{--                                                <a href="{{route('postDetail',['slug'=>$list_post_has_key[$i]->post_name])}}"--}}
{{--                                                   title="{{$list_key[$i]->ten}}" target="_self"--}}
{{--                                                   class="name ">{{$list_key[$i]->tien_to}} {{$list_key[$i]->ten}} {{$list_key[$i]->hau_to}}</a></h3>--}}
{{--                                            <span class="text-decrip-2 fs-5"--}}
{{--                                                  style="color: #646464;font-size: 12px;margin-top: 3px;letter-spacing: 0.5px;line-height: 20px;">--}}
{{--                        Cập nhật thông tin và kiến thức về {{$list_key[$i]->ten}}--}}
{{--                    chi tiết và đầy đủ nhất, bài viết này đang là chủ đề đang được nhiều quan tâm được tổng hợp bởi đội ngũ biên tập viên Thoitrangwiki.</span>--}}
{{--                                        </div>--}}
{{--                                        @php--}}
{{--                                            $index++;--}}
{{--                                            if ($index==15){--}}
{{--                                                break;--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                    @endfor--}}
                                    @foreach($list_bv_tham_khao as $item)
                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 m-b-15"
                                             style="border-bottom: 1px solid #3a3a3a33;padding-bottom: 10px;">
                                            <div class="image">
                                                <a href="{{route('postDetail',['slug'=>$item->post_name])}}"
                                                   title="{{$item->post_title}}" target="_self" class=""><img
                                                        style="height: 160px;margin-bottom: 12px;"
                                                        src="{{$item->twitter_image}}" alt="{{$item->post_title}}"
                                                        class="img-responsive" width="332" height="265"/></a></div>
                                            <div style="margin-top: 0px" class="name font-bold text-left m-t-15">
                                                <a href="{{route('postDetail',['slug'=>$item->post_name])}}"
                                                   title="{{$item->post_title}}" target="_self"
                                                   class="name">{{$item->post_title}}</a></div>
{{--                                            <span class="text-decrip-2 fs-5"--}}
{{--                                                  style="color: #646464;font-size: 12px;margin-top: 3px;letter-spacing: 0.5px;line-height: 20px;">--}}
{{--                        {{$item->description}}</span>--}}
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


