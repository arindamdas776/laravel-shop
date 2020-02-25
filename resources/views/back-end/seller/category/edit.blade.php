@extends('back-end/layouts/Masterblade')

@section('title')

create new category

@endsection

@push('css')
 <link href="{{asset('back-end/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

@section('content')
	 <div class="card">
                        <div class="header">
                            <h2>
                                Create new category
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
                            <form action="{{route('sellercategories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                            	@csrf
                                @method('put')
                                <label for="email_address">Category Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Title" value="{{$category->name}}">
                                    </div>
                                </div>
                            @if($errors->has('category_name'))
                         <div class="alert alert-danger">
                         	<p>{{$errors->first('category_name')}}</p>
                         </div>
                            @endif
                    @php 
                        $ids = (null !== ($category) && $category->children()->count() >0 ? array_pluck($category->children->toArray(),'id') :null);
                        
                    @endphp 
                         <select class="form-control show-tick" name="cat_id">
                                        <option value="">-- Please select category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                @if(!is_null($ids) && in_array($category->id,$ids))
                                        {{'selected'}}
                                @endif
                                        >{{$category->name}}</option>
								    @endforeach                                 
                                    </select>
                            <div class="container">
                            	<label>Select Image</label>
                            	<input type="file" name="image">
                                <input type="hidden" name="hidden_image" value="{{$category->image}}">
                            </div>
                        @if($errors->has('image'))
                     <div class="alert alert-danger">
                     	<p>{{$errors->first('image')}}</p>
                     </div>
                        @endif
                               

                                <input type="checkbox" id="remember_me" class="filled-in">
                                <label for="remember_me">Remember Me</label>
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </form>
                        </div>
                    </div>
@endsection

@push('js')
 <script src="{{asset('back-end/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
@endpush