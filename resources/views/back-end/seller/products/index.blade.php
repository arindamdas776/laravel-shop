@extends('back-end/layouts/Masterblade')

@section('title')
Products Page
@endsection

@push('css')

@endpush

@section('content')

<div class="card">
                        <div class="header">
                            <h2>
                                All Products Details
                                
                                	<div class="col-md-3 pt-4">
                                		<a href="{{route('sellerproducts.create')}}" class="btn btn-primary">CREATE</a>
                                	</div>
                              
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
                                           
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Edit</th>
                                            <th>Destroy</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                           
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Edit</th>
                                            <th>Destroy</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->title}}</td>
                                            <td><img src="{{asset('storage/product/'.$product->image)}}" style="height:100px;width:150px;"></td>
                                            <td>{{$product->price}}</td>
                                @foreach($product->categories as $row)
                                    <td>{{$row->name}}</td>
                                @endforeach
                                  
                                        <td>{{str_limit($product->description,10)}}</td>
                                            <td>{{$product->created_at->toFormattedDateString()}}</td>
                                            <td><a href="{{route('sellerproducts.edit',$product->id)}}" class="btn btn-success">Edit</a></td>
                                            <td><a href="#" class="btn btn-danger" onclick="
                                                document.getElementById('delete-category-{{$product->id}}').submit();
                                            ">Destroy</a>
                                    <form method="post" action="{{route('sellerproducts.destroy',$product->id)}}" id="delete-category-{{$product->id}}">
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

@endpush