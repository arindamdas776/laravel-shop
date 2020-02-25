@extends('front-end/layouts/Master')

@section('title')
	Shopping Products
@endsection

@push('css')

@endpush

@section('content')

 <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">
    @foreach($categories as $category)
          <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" href="{{route('product.category',$category->slug)}}">
              <figure class="image">
                <img src="{{asset('storage/category/'.$category->image)}}" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <span class="text-uppercase">Collections</span>
                <h3>{{$category->name}}</h3>
              </div>
            </a>
          </div>
      @endforeach
     
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featcher Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
        @foreach($products as $product)
              <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                    <img src="{{asset('storage/product/'.$product->image)}}" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="{{route('product.single',$product->id)}}">{{$product->title}}</a></h3>
                    <p class="mb-0">{!! str_limit($product->description,25) !!}</p>
                    <p class="text-primary font-weight-bold">${{$product->price}}</p>
                  </div>
                </div>
              </div>
           @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Big Sale!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="{{asset('front-end/images/blog_1.jpg')}}" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">50% less in all items</a></h2>
            <p class="post-meta mb-4">By <a href="#">Carl Smith</a> <span class="block-8-sep">&bullet;</span> September 3, 2018</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
            <p><a href="#" class="btn btn-primary btn-sm">Shop Now</a></p>
          </div>
        </div>
      </div>
    </div>

@endsection


@push('js')

@endpush