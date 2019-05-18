@extends('layouts.backend.app')

@section('title','comment') 

@push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<div class="container-fluid">

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Comments
                        <span class="badge bg-blue">{{ $comments->count() }}</span>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Comment Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($comments as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="">
                                                    @if(Storage::disk('public')->exists('user/',$item->user->image))
									                <img class="media-object" src="{{ asset('storage/user/'.$item->user->image) }}" width="64" height="64" alt="Profile Image">
									                @endif
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $item->user->name }}
                                                    <small>{{ $item->created_at->diffForHumans() }}</small>
                                                </h4>
                                                <p>{!!  $item->comment !!}</p>
                                                <a href="{{ route('post.details',$item->post->slug) }}" target="_blank">Replay</a>
                                                {{-- --<a href="{{ route('post.details',$item->post->slug.'#comments') }}" target="_blank">Replay</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <div class="media-right">
                                                <a href="{{ route('post.details',$item->post->slug) }}" target="_blank">
                                                    @if(Storage::disk('public')->exists('post/',$item->post->photo))
                                                    <img class="media-object" src="{{ asset('storage/post/'.$item->post->photo) }}" width="64" height="64" style="margin-right:10px;">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('post.details',$item->post->slug) }}" target="_blank">
                                                    <h4 class="media-heading" >{{ str_limit($item->post->title,40) }}</h4>
                                                </a>
                                                <p>by <strong>{{ $item->user->name }}</strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    {{-- --
                                        <td>
                                        @if(Storage::disk('public')->exists('post/',$item->photo))
                                        <img src="{{ asset('storage/post/'.$item->photo) }}" width="50" height="40" alt="">
                                         @endif
                                    </td>
                                        --}}
                                    
                                    <td>
                                      
                                        <a href="{{ route('admin.comment.delete',$item->id) }}"  id="delete" class="btn btn-danger btn-xs">
                                            <i class="material-icons">delete</i>
                                        </a >
                                       {{-- -
                                          <a href="{{ route('admin.post.pending.show',$item->id) }}" class="btn btn-info btn-xs">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                         <a id="approve" href="{{ route('admin.post.approve',$item->id) }}" class="btn btn-info btn-xs">
                                            <i class="material-icons">done</i>
                                        </a>
                                        <a href="{{ route('admin.post.edit',$item->id) }}" class="btn btn-primary btn-xs">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        --}}
                                       
                                        {{-- 
                                             <form action="{{ route('admin.post.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                            --}}
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

</div>
@endsection


@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    
<script> 
    // this is right code..below
    $(document).on("click","#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
      title: "Are you sure want to Deleted this?",
      text: "Once deleted, This will be Permanently Deleted!",
      icon: "warning",
      buttons: true,
      successModel: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = link;
      } else {
        swal("This Comment is Not Deleted! ");
      }
    });
    });
</script>

@endpush