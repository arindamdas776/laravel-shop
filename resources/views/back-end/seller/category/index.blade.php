@extends('back-end/layouts/Masterblade')

@section('title')

Category page

@endsection

@push('css')

 <link href="{{asset('back-end/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush

@section('content')
	 <div class="card">
                        <div class="header">
                            <h2>
                                <a href="{{route('sellercategories.create')}}" class="btn btn-success">Create</a>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->slug}}</td>
                                            <td><img src="{{asset('storage/category/'.$category->image)}}" style="height:100px;width:120px;"></td>
                                            <td><a href="{{route('sellercategories.edit',$category->id)}}" class="btn btn-success">Edit</a></td>
                                            <td><a href="#" class="btn btn-danger" onclick="
                                            document.getElementById('delete-category-{{$category->id}}').submit();
                                            ">Destroy</a>
                                            <form method="post" action="{{route('sellercategories.destroy',$category->id)}}" id="delete-category-{{$category->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                        
                                        </tr>
                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

@push('js')

<script src="{{asset('back-end/js/pages/tables/jquery-datatable.js')}}"></script>

@endpush