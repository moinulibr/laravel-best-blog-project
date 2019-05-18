@extends('layouts.frontend.app')

@section('title','home')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
    <style>
        .addColor{
            color:#0275d8;
        }
        .removeColor{
            color:gray;
        }
    </style>
@endpush


@section('content')
<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach ($categories as $item)
            <div class="swiper-slide">
                <a class="slider-category" href="{{ route('post.category',$item->slug) }}">
                    <div class="blog-image">
                            @if(Storage::disk('public')->exists('category/slider/',$item->photo))
                            <img src="{{ asset('storage/category/slider/'.$item->photo) }}" alt="{{ $item->name }}">
                          @endif
                    </div>
                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>{{ $item->name }}</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->
            @endforeach

        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

</div><!-- slider -->

<section class="blog-area section">
    <div class="container">
        <div id="sss"></div>
        <div class="row">
                    <!---------------------------------------------------->
                     <!-- Small Size -->
            <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                           {{-- --- 
                            <div class="modal-header">
                                <h4 class="modal-title" id="smallModalLabel">Modal title</h4> 
                            </div>--}}
                            <div style="text-align:center" class="modal-body">
                                <h6>You Have to <a href="{{ route('login') }}"><b>Login</b></a> first! </h6>
                            </div>
                           {{-- ---
                             <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>
    {{-- --
        <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#smallModal">MODAL - SMALL SIZE</button>
        --}}
                <!-- For Material De-->
                    <!---------------------------------------------------->
            @foreach ($posts as $item)
            <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <a href="{{ route('post.details',$item->slug) }}"> 
                                <div class="blog-image">
                                        @if(Storage::disk('public')->exists('post/',$item->photo))
                                        <img src="{{ asset('storage/post/'.$item->photo) }}" alt="{{ $item->title }}">
                                    @endif 
                                </div> 
                            </a>
                            <a class="avatar" href="{{ route('post.author',$item->user->username) }}">
                                @if(Storage::disk('public')->exists('user/',$item->user->image))
                                <img src="{{ asset('storage/user/'.$item->user->image) }}" alt="Profile Image">
                                @endif
                            </a>
    
                            <div class="blog-info">
    
                                <h4 class="title">
                                    <a href="{{ route('post.details',$item->slug) }}">
                                    <b>{{ $item->title }}</b>
                                    </a>    
                                </h4>
                                 <ul class="post-footer">
                                    <li>
                                        @guest 
                                        <a style="cursor:pointer" data-toggle="modal" data-target="#smallModal"><i class="ion-heart"></i>{{ $item->favorite_to_users->count() }}</a>
                                            @else
                                                @php
                                                    $post_id = $item->id;
                                                    $user = Auth::user();
                                                    $isFavorite = $user->favorite_posts()->where('post_id',$post_id)->count();
                                                @endphp 
                                            <a class="like  {{ $isFavorite > 0 ? 'addColor' : 'removeColor' }}" id="like_id-{{ $item->id }}" href="{{ route('post.favorite') }}"><i class="ion-heart"></i>{{ $item->favorite_to_users->count() }}</a>
                                        @endguest
                                    </li>
                                    <li><a href="#" id=""><i class="ion-chatbubble"></i>
                                        {{ $item->comments->count() }}
                                    </a>
                                    </li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $item->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                 
            @endforeach
           
        </div><!-- row -->

        <a class="load-more-btn" href="{{ route('posts.index') }}"><b>LOAD MORE</b></a>

    </div><!-- container -->
</section><!-- section -->

@endsection



@push('js')
<script>
    $(document).ready(function () {

        /* ------------live search -----------------*/
        /*$('.search').keypress(function(){ 
            var search = $(this).val();
            
            $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        "query": search,
                    },
                    beforeSend: function () {

                    },
                    success: function (s_result) {
                        $('#sss').html(s_result);

                    }
            });
         });
         */
        /* ------------live search -----------------*/


        $(".like").click(function (e) {
              var post_id =  $(this).attr('id').substr(8);
            $.ajax({
            url: "{{ route('post.favorite') }}",
            type: 'GET',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "post_id": post_id,
            },
            beforeSend: function () {

            },
            success: function (msg) {
            {{-- --($("#like_id-{{ $item->id }}").text()); --}}
                //alert(msg);
                 // $(this).html(msg .add);
                  $("#like_id-"+post_id).html(msg);
            }
            });
            e.preventDefault();
        });
    });
</script>
@endpush