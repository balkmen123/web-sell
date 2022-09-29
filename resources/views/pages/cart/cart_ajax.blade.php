@extends('layout')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
              <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="table-responsive cart_info">
            <form action="{{ url('/update-cart') }}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá sản phẩm</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                        
                    @php
                            $total = 0;
                    @endphp
                    @foreach(Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        @endphp

                    <tr>
                        <td class="cart_product">
                            <img src="{{asset('uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                        </td>
                        <td class="cart_description">
                            <h4><a href=""></a></h4>
                            <p>{{$cart['product_name']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                               
                            
                                <input class="cart_quantity" type="number" min="1" name="cart_qty[{{ $cart['session_id'] }}]" value="{{$cart['product_qty']}}"  >
                            
                                
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.')}}đ
                                
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ url('/del-product/'.$cart['session_id']) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    
                    @endforeach
                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
                    </tr>
                </tbody>
                </form>
            </table>
        </div>

    </div>
</section> <!--/#cart_items-->


<section id="do_action">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền: <span>  {{number_format($total,0,',','.')}}đ</span></li>
                        <li>Thuế <span>{{Cart::tax(0, ',' , '.').' '.'vnđ'  }}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(0, ',' , '.').' '.'vnđ'  }}</span></li>
                    </ul>
                    <?php 
                    $customer_id = Session::get('customer_id');
                    $shipping_id=Session::get('shipping_id');
                    if($customer_id!=NULL && $shipping_id == NULL) {							
                ?>								
                 <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Thanh toán</a>
                <?php 
                }elseif($customer_id!=NULL && $shipping_id != NULL){
                ?>
                <a class="btn btn-default check_out" href="{{ URL::to('/payment') }}">Thanh toán</a>
                <?php 
                }else{
                ?>
                 <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh toán</a>
                <?php 
                }
                ?>
                 <a class="btn btn-default check_out" href="">Tính mã giảm giá</a>
                 <a class="btn btn-default check_out" href="">Xóa tất cả</a>
                       
                     
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection