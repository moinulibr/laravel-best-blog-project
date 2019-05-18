@extends('layouts.backend.app')

@section('title','dashboard') 

@push('css')
     <!-- Bootstrap Select Css -->
     <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endpush

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('author.post.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add A New Post
                        </h2>
                    </div>
                    <div class="body">
                        <label for="name">Post title</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input value="{{ old('title') }}" name="title" type="text" id="title" class="form-control" placeholder="Post title">
                                
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong style="color:red;">{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
            
                            </div>
                        </div>
                        <label for="description">Featured Image</label>
                        <div class="form-group">
                            <div class="form-line">
                                <img id="image" src="#" />
                                <input type="file" name ="photo" accept="image/*"
                                    class="upload"  onchange="readURL(this);" />
                                @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                <strong style="color:red;">{{ $errors->first('photo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                        <label for="publish">Publish</label>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Category And Tag
                        </h2>
                    </div>
                    <div class="body">
                        <label for="categories">Select Category</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                <select name="categories[]" id="category" data-live-search="true" multiple class="form-control show-tick">
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('categories'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong style="color:red;">{{ $errors->first('categories') }}</strong>
                                    </span>
                                @endif
        
                            </div>
                        </div>
                        <label for="tags">Select Tag</label>
                        <div class="form-group">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                <select name="tags[]" id="tags" data-live-search="true" multiple class="form-control show-tick">
                                    @foreach ($tags as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong style="color:red;">{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
        
                            </div>
                        </div>

                        <a href="{{ route('author.post.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                    </div>
                </div>
            </div>
        </div>
            
            <!-- Post Body -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Post Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea name="body" id="tinymce" cols="30" rows="10">

                        </textarea>
                        @if ($errors->has('body'))
                            <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection


@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

        <!-- TinyMCE -->
        <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>

<script>
    $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
});
</script>

<script type="text/javascript">
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e){
            $('#image')
                .attr('src', e.target.result)
                .width(80)
                .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endpush