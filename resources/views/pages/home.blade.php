@extends('layout')

@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach ($all_product as$key =>$product )
        
   
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id) }}">
                        <img src="{{URL::to('uploads/product/'.$product->product_image) }}" alt="" width="250" height="250"/>
                    </a>
                        <form action="{{ URL::to('/save-cart') }}" method="POST" >   
                            {{ csrf_field() }}   
                        
                        <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                        <p>{{ $product->product_name }}</p>
                        <input name="qty"  type="hidden" min="1" value="1" />
                        <input name="productid_hidden" type="hidden"  value="{{ $product->product_id }}" />
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm giỏ hàng
                        </button>
                    </form>
                    </div>
                       
                  
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
   
    @endforeach
</div><!--features_items-->



@endsection


