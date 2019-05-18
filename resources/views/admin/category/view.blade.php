@extends('layouts.backend.app')

@section('title','dashboard') 

@push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
       <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New Category</a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Category
                        <span class="badge bg-blue">{{ $categories->count() }}</span>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Total Post</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tag Name</th>
                                    <th>Total Posts</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                        
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->posts->count() }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('category/slider/',$item->photo))
                                        <img src="{{ asset('storage/category/slider/'.$item->photo) }}" alt="" width="50" height="40">
                                        @endif
                                    </td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        
                                        <a href="{{ route('admin.category.edit',$item->id) }}" class="btn btn-info btn-xs">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        {{-- -
                                        <a href="" class="btn btn-primary">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        <a href="" class="btn btn-danger">
                                            <i class="material-icons">delete</i>
                                        </a>
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