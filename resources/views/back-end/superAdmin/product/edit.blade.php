@extends('back-end/layouts/Masterblade')

@section('title')
	Create new Product
@endsection

@push('css')
   <link href="{{asset('back-end/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

@section('content')
 <div class="card">
                        <div class="header">
                            <h2>
                                PRODUCT DETAILS FORM
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
                            <form  action="{{route('adminproducts.update',$products->id)}}" method="POST" enctype="multipart/form-data">
                            	@csrf
                            	@method('put')
                                <label for="email_address">Product Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="title" id="email_address" class="form-control" placeholder="Enter Product Title"value="{{$products->title}}">
                                    </div>
                                </div>
                             @if($errors->has('title'))
                           <div class="alert alert-danger">
                           	<p>{{$errors->first('title')}}</p>
                           </div>
                             @endif
                                <label for="password">Product Price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="price" class="form-control" placeholder="Enter product price" value="{{$products->price}}">
                                    </div>
                                </div>
                            @if($errors->has('price'))
                        <div class="alert alert-danger">
                        	<p>{{$errors->first('price')}}</p>
                        </div>
                       @endif

                     @php
                     	$ids = (null !==($products) && $products->categories->count() >0 ? array_pluck($products->categories,'id'):null);


                     @endphp
                           	 <select class="form-control show-tick" name="cat_id">
                                       
                                     @foreach($categories as $category)
                                        <option  value="{{$category->id}}"
                                        		@if(!is_null($ids) && in_array($category->id,$ids))
                                        			{{'selected'}}
                                        		@endif
                                        	>{{$category->name}}</option>
                                      		
									@endforeach                                       
                                    </select>
                             <div class="form-group">
                             	<label>Select image</label>
                             	<input type="file" name="select_image">
                                <input type="hidden" name="hidden_image" value="{{$products->image}}">
                             </div>
                         @if($errors->has('image'))
                     <div class="alert alert-danger">
                     	<p>{{$errors->first('image')}}</p>
                     </div>
                         @endif
                             <div class="form-group">
                            <select class="form-control show-tick" name="sub_cat_id">
                                        <option value="">-- Please select Subcategory --</option>
                                    @foreach($categories as $row)
                                    	@foreach($row->children as $value)
                                        <option value="10">{{$value->name}}</option>
                                        @endforeach
                                     @endforeach
                                    </select>
                             </div>
                            <textarea class="form-control" id="summary-ckeditor" name="description">
                            	 <h2>WYSIWYG Editor</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper sapien non nisl facilisis bibendum in quis tellus. Duis in urna bibendum turpis pretium fringilla. Aenean neque velit, porta eget mattis ac, imperdiet quis nisi. Donec non dui et tortor vulputate luctus. Praesent consequat rhoncus velit, ut molestie arcu venenatis sodales.</p>
                                <h3>Lacinia</h3>
                                <ul>
                                    <li>Suspendisse tincidunt urna ut velit ullamcorper fermentum.</li>
                                    <li>Nullam mattis sodales lacus, in gravida sem auctor at.</li>
                                    <li>Praesent non lacinia mi.</li>
                                    <li>Mauris a ante neque.</li>
                                    <li>Aenean ut magna lobortis nunc feugiat sagittis.</li>
                                </ul>
                                <h3>Pellentesque adipiscing</h3>
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                            </textarea>
                        @if($errors->has('description'))
                     <div class="alert alert-danger">
                     	<p>{{$errors->first('description')}}</p>
                     </div>
                        @endif

                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                <a href="{{route('adminproducts.index')}}" class="btn btn-danger m-t-15 waves-effects">BACK</a>
                            </form>
                        </div>
                    </div>
@endsection

@push('js')
 <!-- Select Plugin Js -->
    <script src="{{asset('back-end/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script

@endpush