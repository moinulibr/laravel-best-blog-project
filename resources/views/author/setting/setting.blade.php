@extends('layouts.backend.app')

@section('title','setting')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2></h2>
    </div>

    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Settings
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#profile_with_icon_title" data-toggle="tab">
                                <i class="material-icons">face</i> UPDATE PROFILE
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#password_with_icon_title" data-toggle="tab">
                                <i class="material-icons">change_history</i> CHANGE PASSWORD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                            <form method="POST" action="{{ route('author.settings.profile.update',Auth::user()->id) }}"
                                enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input name="name" type="text"
                                                    value="{{ old('name')??Auth::user()->name }}" id="name"
                                                    class="form-control">
                                            
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                                    </span>
                                                 @endif
                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">User name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input name="username" type="text"
                                                    value="{{ old('username')??Auth::user()->username }}" id="username"
                                                    class="form-control">
                                                   
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong style="color:red;">{{ $errors->first('username') }}</strong>
                                                    </span>
                                                 @endif
                              
                                               </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Email Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input value="{{ old('email')??Auth::user()->email }}" type="email"
                                                    name="email" id="email" class="form-control">
                                            
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                                    </span>
                                                 @endif
                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="photo">Profile Image</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                @if(Storage::disk('public')->exists('user/', Auth::user()->image))
                                                    <img src="{{ asset('storage/user/'. Auth::user()->image) }}" alt="profile image" style="border-radius:60%" width="50" height="40">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5">
                                        <label for="photo">Upload Image</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <img id="image" src="#" />
                                                <input type="file" name="photo" accept="image/*" class="upload"
                                                    onchange="readURL(this);" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">About</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input name="about" type="text" value="{{ old('about')??Auth::user()->about }}" id="about"
                                                    class="form-control">
                                            
                                                @if ($errors->has('about'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong style="color:red;">{{ $errors->first('about') }}</strong>
                                                    </span>
                                                 @endif
                              
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit"
                                            class="btn btn-primary m-t-15 waves-effect">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                                <form method="POST" action="{{ route('author.settings.change.password') }}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="oldPassword">Current Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input placeholder="Enter your current / old password"  type="password" name="oldPassword" id="oldPassword" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">New Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input placeholder="Enter new password"  type="password" name="password" id="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Confirm Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input  placeholder="Enter confirm password" type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit"
                                            class="btn btn-primary m-t-15 waves-effect">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Tabs With Icon Title -->

</div>
@endsection


@push('js')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result)
                    .width(60)
                    .height(60);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@endpush
