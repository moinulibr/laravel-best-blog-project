@extends('layouts.backend.app')

@section('title','dashboard') 

@push('css')
     <!-- Bootstrap Select Css -->
     <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endpush

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.post.index') }}" class="btn btn-danger">Back</a>
   @if ($post->is_approved == 0)
        <a id="approve" href="{{ route('admin.post.approve',$post->id) }}" class="btn btn-success pull-right">
               <i class="material-icons">done</i> 
               <span>Approve</span>
        </a>
        @else
        <button disabled style="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i> 
                <span>Approved</span>
         </button>
   @endif
   <br/></br/>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           {{ $post->title }}
                           <small>Posted By : <strong><a href="#">{{ $post->user->name }}</a></strong>
                            On {{ $post->created_at->diffForHumans() }} {{-- -->diffForHumans() ->diffForHumans()--}}
                        </small>
                        </h2>
                    </div>
                    <div class="body">
                     
                         {!! $post->body !!}

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Category
                        </h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $item)
                            <span class="badge bg-cyan"> {{ $item->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                             Tag
                        </h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $item)
                            <span class="badge bg-green"> {{ $item->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                             Featured Image
                        </h2>
                    </div> 
                    <div class="body">      
                       <img src="{{ asset('storage/post/'.$post->photo) }}" alt="" width="160" height="60">
                    </div>
                </div>
            </div>
        </div>
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

<!---for approve---->

<script> 
    // this is right code..below
    $(document).on("click","#approve", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
      title: "Are you sure want to Approved this?",
      text: "Once approved, This will be Permanently Approved!",
      icon: "warning",
      buttons: true,
      successModel: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = link;
      } else {
        swal("This Post is Not Approved! ");
      }
    });
    });
</script>
@endpush