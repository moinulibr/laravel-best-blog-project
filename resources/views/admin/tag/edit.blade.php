@extends('layouts.backend.app')

@section('title','dashboard') 

@push('css')
    
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2></h2>
    </div>

                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit Tag
                                </h2>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('admin.tag.update',$tag->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <label for="name">Tag Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input value="{{ old('name')?? $tag->name }}" name="name" type="text" id="name" class="form-control" placeholder="Tag Name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                            </span>
                                         @endif
                      
                                        </div>
                                    </div>
                                    <label for="description">Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{ old('description')??$tag->description }}" id="description" name="description" class="form-control" placeholder="Description">
                                        </div>
                                    </div>
                                    {{-- -
                                    <input type="checkbox" id="remember_me" class="filled-in">
                                    <label for="remember_me">Remember Me</label>
                                    <br>---}}
                                    <a href="{{ route('admin.tag.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

</div>
@endsection


@push('js')


@endpush