@extends('back-end/layouts/Masterblade')

@section('title')

@endsection

@push('css')

@endpush

@section('content')
	<div class="card">
                        <div class="header">
                            <h2>
                                Create new Category
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
                            <form action="{{route('admincategories.update',$categories->id)}}" method="POST" enctype="multipart/form-data">
                            	@csrf
                            	@method('put')
                                <label for="email_address">Category name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="category_name" value="{{$categories->name}}" id="email_address" class="form-control" placeholder="Enter your Category name">
                                
                                    </div>
                                </div>
                                 @if($errors->has('category_name'))
                                 		<div class="alert alert-danger">
                                 			{{$errors->first('category_name')}}
                                 		</div>
                                 @endif
                                <div class="form-group">
									<input type="file" name="image">
									<input type="hidden" name="hidden_image" value="{{$categories->image}}">                          	
                                </div>
                                @if($errors->has('image'))
                                	<div class="alert alert-danger">
                                		{{$errors->first('image')}}
                                	</div>
                                @endif
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('js')

@endpush