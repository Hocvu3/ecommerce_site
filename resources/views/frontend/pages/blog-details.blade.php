@extends('frontend.layouts.master')
@section('content')


    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>blog details</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:void(0)">blog details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=========================
        BLOG DETAILS START
    ==========================-->
    <section class="fp__blog_details mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="fp__blog_det_area">
                        <div class="fp__blog_details_img wow fadeInUp" data-wow-duration="1s">
                            <img src="{{ asset($blog->image) }}" alt="blog details" class="imf-fluid w-100">
                        </div>
                        <div class="fp__blog_details_text wow fadeInUp" data-wow-duration="1s">
                            <ul class="details_bloger d-flex flex-wrap">
                                <li><i class="far fa-user"></i>{{ $blog->users->name }}</li>
                                <li><i class="far fa-comment-alt-lines"></i> {{ $blog->comments_count}} Comments</li>
                                <li><i class="far fa-calendar-alt"></i> {{ $blog->created_at }}</li>
                            </ul>
                            <h2>{{ $blog->title }}</h2>
                            <p>{{ $blog->description }}</p>
                            <div class="blog_tags_share d-flex flex-wrap justify-content-between align-items-center">
                                <div class="tags d-flex flex-wrap align-items-center">
                                    <span>tags:</span>
                                    <ul class="d-flex flex-wrap">
                                        <li><a href="#">Cleaning</a></li>
                                        <li><a href="#">AC Repair</a></li>
                                        <li><a href="#">Home Move</a></li>
                                    </ul>
                                </div>
                                <div class="share d-flex flex-wrap align-items-center">
                                    <span>share:</span>
                                    <ul class="d-flex flex-wrap">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $blog->title }}"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="http://twitter.com/share?text={{ $blog->title }} goes here&url={{ url()->current() }} goes here&hashtags=hashtag1,hashtag2,hashtag3"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="blog_det_button mt_100 xs_mt_70 wow fadeInUp" data-wow-duration="1s">
                        @if ($prev_blog)
                            <li>
                                <a href="{{ route('blog.details', $prev_blog->slug) }}">
                                    <img src="{{ asset($prev_blog->image) }}" alt="button img" class="img-fluid w-100">
                                    <p>{{ $prev_blog->title }}
                                        <span> <i class="far fa-long-arrow-left"></i> Previous</span>
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if ($next_blog)
                            <li>
                                <a href="{{ route('blog.details', $next_blog->slug) }}">
                                    <p>{{ $next_blog->title }}
                                        <span>next <i class="far fa-long-arrow-right"></i></span>
                                    </p>
                                    <img src="{{ asset($next_blog->image) }}" alt="button img" class="img-fluid w-100">
                                </a>
                            </li>
                        @endif
                    </ul>

                    <div class="fp__comment mt_100 xs_mt_70 wow fadeInUp" data-wow-duration="1s">
                        <h4>{{ $blog->comments_count }} Comments</h4>
                        @foreach ($blog_comments as $blog_comment)
                        <div class="fp__single_comment m-0 border-0">
                            <img src="{{ asset($blog_comment->users->avatar) }}" alt="review" class="img-fluid">
                            <div class="fp__single_comm_text">
                                <h3>{{ $blog_comment->users->name }} <span>{{ $blog_comment->created_at }} </span></h3>
                                <p>{{ $blog_comment->comment }}</p>
                            </div>
                        </div>
                         @endforeach
                        @if ($blog_comments->hasPages())
                            <div class="fp__pagination mt_60">
                                <div class="row pagination">
                                    <div class="col-12 pagination">
                                        {{ $blog_comments->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="comment_input mt_100 xs_mt_70 wow fadeInUp" data-wow-duration="1s">
                        <h4>Leave A Comment</h4>
                        <form class="comment_input_form">
                            <div class="row">
                                <div class="col-xl-12">
                                    <label>comment</label>
                                    <div class="fp__contact_form_input textarea">
                                        <span><i class="fal fa-user-alt"></i></span>
                                        <textarea rows="5" placeholder="Your Comment" name="message"></textarea>
                                        <input type="hidden" name="post_id" value="{{ $blog->id }}">
                                    </div>
                                    <button type="submit" id="comment_btn" class="common_btn mt_20">Submit comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div id="sticky_sidebar">
                        <div class="fp__blog_search blog_sidebar m-0 wow fadeInUp" data-wow-duration="1s">
                            <h3>Search</h3>
                            <form action="{{ route('blog.index') }}" method="GET">
                                {{-- @csrf --}}
                                <input type="text" placeholder="Search" name="search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="fp__related_blog blog_sidebar wow fadeInUp" data-wow-duration="1s">
                            <h3>Latest Post</h3>
                            <ul>
                                @foreach ($related_blogs as $related_blog)

                                <li>
                                    <img src="{{ asset($related_blog->image) }}" alt="blog" class="img-fluid w-100">
                                    <div class="text">
                                        <a href="{{ route('blog.details', $related_blog->slug) }}">{{ $related_blog->title }}</a>
                                        <p><i class="far fa-calendar-alt"></i> {{ $related_blog->created_at }}</p>
                                    </div>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                        <div class="fp__blog_categori blog_sidebar wow fadeInUp" data-wow-duration="1s">
                            <h3>Categories</h3>
                            <ul>
                                @foreach ($categories as $category )
                                    <li><a href="#">{{ $category->name }} <span>{{ $category['blog_count'] }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        BLOG DETAILS END
    ==========================-->

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.comment_input_form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route("blog.send.message") }}',
                data: formData,
                headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                beforeSend: function() {
                   $('#comment_btn').attr('disabled', true);
                   $('#comment_btn').html(
                       '<span class="spinner-border spinner-border-sm text-light modal-cart-button" role="status" aria-hidden="true"></span> Loading...'
                   )
                },
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload();
                        toastr.success(response.message);
                    } else if (response.status === 'error') {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON.errors;
                    $.each(errorMessage, function(index, value) {
                        toastr.error(value);
                    })
                },
                complete: function() {
                    $('#comment_btn').html('Send Message');
                    $('#comment_btn').attr('disabled', false);
                }
            })
        })
    })
</script>
@endpush
