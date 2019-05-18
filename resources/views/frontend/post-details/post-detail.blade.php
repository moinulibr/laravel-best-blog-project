@extends('layouts.frontend.app')

@section('title','post-details')

@push('css')
    <link href="{{ asset('assets/frontend/css/single-post/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/single-post/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/jssocial/jssocials.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/jssocial/jssocials-theme-classic.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .addColor{
            color:#0275d8;
        }
        .removeColor{
            color:gray;
        }


		.header-bg{
			height: 400px;
			width: 100%;
			background-image: url("{{ asset('storage/post/'.$post->photo) }}");
			background-size:cover;
		}

    </style>
@endpush


@section('content')
<div class="header-bg">
		{{-- -<img src="{{ asset('storage/post/'.$post->photo) }}"  alt="{{ $post->title }}"> --}}
</div><!-- slider -->

	 <!---------------------------------------------------->
                     <!-- Small Size -->
					 <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
								   {{-- --- 
									<div class="modal-header">
										<h4 class="modal-title" id="smallModalLabel">Modal title</h4> 
									</div>--}}
									<div class="modal-body">
										<h6 style="text-align:center">You Have to <a href="{{ route('login') }}"><b>Login</b></a> first! </h6>
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

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="{{ route('post.author',$post->user->username) }}">
										@if(Storage::disk('public')->exists('user/',$post->user->image))
										<img src="{{ asset('storage/user/'.$post->user->image) }}" alt="Profile Image">
										@endif
									</a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">{{ $post->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

							<div class="para">
								{!! $post->body !!}
							</div>

							<ul class="tags">
									@foreach ($tags as $tag)
									<li><a href="{{ route('post.tag',$tag->slug) }}">{{ $tag->name }}</a></li>
									@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
									<li>
									@guest 
									<a style="cursor:pointer" data-toggle="modal" data-target="#smallModal"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
										@else
										@php
											$post_id = $post->id;
											$user = Auth::user();
											$isFavorite = $user->favorite_posts()->where('post_id',$post_id)->count();
										@endphp 
										<a class="like  {{ $isFavorite > 0 ? 'addColor' : 'removeColor' }}" id="like_id-{{ $post->id }}" href="{{ route('post.favorite') }}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
										@endguest
										</li>
										<li><a href="#" id=""><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
										<li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
							
							</ul>
							

							<ul class="icons">
									<div id="share"></div>
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>

						
					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>{{ $post->user->about }}</p>
						</div>

						<div class="tag-area">

							<h4 class="title"><b>CATEGORY</b></h4>
							<ul>
								@foreach ($categories as $category)
								<li><a href="{{ route('post.category',$category->slug) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

				@foreach ($randomPosts as $item)

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
								<a class="avatar" href="{{ route('post.author',$item->user->id)  }}">
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
											<a style="cursor:pointer" data-toggle="modal" data-target="#smallModal"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
												@else
													@php
														$post_id = $item->id;
														$user = Auth::user();
														$isFavorite = $user->favorite_posts()->where('post_id',$post_id)->count();
													@endphp 
												<a class="like  {{ $isFavorite > 0 ? 'addColor' : 'removeColor' }}" id="like_id-{{ $item->id }}" href="{{ route('post.favorite') }}"><i class="ion-heart"></i>{{ $item->favorite_to_users->count() }}</a>
											@endguest
										</li>
										<li><a href="#" id=""><i class="ion-chatbubble"></i>{{ $item->comments->count() }}</a></li>
										<li><a href="#"><i class="ion-eye"></i>{{ $item->view_count }}</a></li>
									</ul>
		
								</div><!-- blog-info -->
							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-lg-4 col-md-6 -->
					 
				@endforeach

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						@guest
						<p>For post  a new comment. You need to login first. <a href="{{ route('login') }}"><i style="color:darkmagenta">Login here</i></a></p>
							@else
							<form method="post" action="{{ route('comment.store',$post->id) }}">
								@csrf
							<div class="row">
							{{-- --
									<div class="col-sm-6">
									<input type="text" aria-required="true" name="contact-form-name" class="form-control"
										placeholder="Enter your name" aria-invalid="true" required >
								</div><!-- col-sm-6 -->
								<div class="col-sm-6">
									<input type="email" aria-required="true" name="contact-form-email" class="form-control"
										placeholder="Enter your email" aria-invalid="true" required>
								</div><!-- col-sm-6 -->
								--}}
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
										
										@if ($errors->has('comment'))
										<span class="invalid-feedback" role="alert">
										<strong style="color:red;">{{ $errors->first('comment') }}</strong>
										</span>
										@endif
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
						@endguest
					</div><!-- comment-form -->

					<h4><b>COMMENTS({{ $post->comments()->count() }})</b></h4>

					@if ($post->comments()->count() > 0)
					@foreach ($post->comments as $item)
					<div class="commnets-area ">

						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#">
									@if(Storage::disk('public')->exists('user/',$item->user->image))
									<img src="{{ asset('storage/user/'.$item->user->image) }}" alt="Profile Image">
									@endif
									</a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $item->user->name }}</b></a>
									<h6 class="date">{{ $item->created_at->diffForHumans() }}</h6>
								</div>

								<div class="right-area">
									<h5 class="reply-btn" ><a href="#"><b></b></a></h5>
								</div>

							</div><!-- post-info -->

							<p>{!! $item->comment !!}</p>

						</div>

					</div><!-- commnets-area -->

					@endforeach
						@else
						<div class="commnets-area ">

							<div class="comment">
								<p>No Comment Yet. Be the First one..</p>
							</div>
						</div>
					
					@endif
					
					{{-- --<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>
 --}}
				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection



@push('js')

<script src="{{ asset('plugins/jssocial/jssocials.min.js') }}"></script>

	<script>
    $(document).ready(function () {
		$("#share").jsSocials({
			showLabel: false,
    		showCount: false,
                shares: ["twitter", "facebook", "whatsapp"]
            });
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
				{{-- --    //($("#like_id-{{ $item->id }}").text()); --}}
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