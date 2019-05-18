@extends('layouts.backend.app')

@section('title','dashboard') 

@push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
       <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Add New Post</a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Posts
                        <span class="badge bg-blue">{{ $posts->count() }}</span>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Post Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Image</th>
                                    <th>Is Aprroved</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Post Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Image</th>
                                    <th>Is Aprroved</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $item)
                                <tr>
                                        
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td> 0 </td>
                                    
                                    <td>
                                        @if(Storage::disk('public')->exists('post/',$item->photo))
                                        <img src="{{ asset('storage/post/'.$item->photo) }}" width="50" height="40" alt="">
                                         @endif
                                    </td>
                                    <td>
                                        @if ($item->is_approved == 1)
                                            <span class="badge bg-blue"> Approved </span>
                                            @else
                                            <span class="badge bg-red"> Pending </strong>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-green"> Published </span>
                                            @else
                                            <span class="badge bg-red"> Un-published </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.post.show',$item->id) }}" class="btn btn-info btn-xs">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{ route('admin.post.edit',$item->id) }}" class="btn btn-primary btn-xs">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <a href="{{ route('admin.post.delete',$item->id) }}" id="delete" class="btn btn-danger btn-xs">
                                            <i class="material-icons">delete</i>
                                        </a >
                                       
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

@endpush