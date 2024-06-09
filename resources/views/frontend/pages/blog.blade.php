@extends('frontend.layouts.master')
@section('content')

    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Our Latest Food Blogs</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="javascript:void(0)">blogs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        BLOG PAGE START
    ==============================-->
    <section class="fp__blog_page fp__blog2 mt_120 xs_mt_65 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_blog">
                        <a href="#" class="fp__single_blog_img">
                            <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                        </a>
                        <div class="fp__single_blog_text">
                            <a class="category" href="#">{{ $blog->category->name }}</a>
                            <ul class="d-flex flex-wrap mt_15">
                                <li><i class="fas fa-user"></i>{{ $blog->users->name }}</li>
                                <li><i class="fas fa-calendar-alt"></i> {{ $blog->created_at }}</li>
                                @if ($blog['comments_count'] )
                                <li><i class="fas fa-comments"></i> {{ $blog['comments_count'] }} comment</li>
                                @else
                                <li><i class="fas fa-comments"></i>0 comment</li>
                                @endif
                            </ul>
                            <a class="title" href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($blogs->hasPages())
            <div class="fp__pagination mt_60">
                <div class="row pagination">
                    <div class="col-12 pagination">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        @endif
        </div>
    </section>
    <!--=============================
        BLOG PAGE END
    ==============================-->

@endsection
