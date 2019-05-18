@extends('layouts.backend.app')

@section('title','author') 

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
                        All Authors
                        <span class="badge bg-blue">{{ $users->count() }}</span>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th><i class="material-icons">comment</i></th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th><i class="material-icons">comment</i></th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->posts_count }}</td>
                                    <td>{{ $item->comments_count }}</td>
                                    <td>{{ $item->favorite_posts_count }}</td>
                                    <td> {{ $item->created_at->toDateString() }} </td>
                                    
                                    {{-- --
                                        <td>
                                        @if(Storage::disk('public')->exists('post/',$item->photo))
                                        <img src="{{ asset('storage/post/'.$item->photo) }}" width="50" height="40" alt="">
                                         @endif
                                    </td>
                                        --}}
                                    
                                    <td>
                                        <a href="{{ route('admin.author.delete',$item->id) }}" id="delete" class="btn btn-danger btn-xs">
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
      title: "Are you sure want to Delete this?",
      text: "Once deleted, This will be Permanently Deleted!",
      icon: "warning",
      buttons: true,
      successModel: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = link;
      } else {
        swal("This Author is Not Deleted! ");
      }
    });
    });
</script>

@endpush