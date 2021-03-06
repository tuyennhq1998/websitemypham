@if (isset($product))
    <div class="product-item">
        <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}" title="" class="avatar image contain">
            <img alt="{{  $product->pro_name }}" data-src="{{ pare_url_file($product->pro_avatar) }}" src="{{  asset('images/preloader.gif') }}" class="lazyload lazy">
        </a>
        <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}"
         title="{{  $product->pro_name }}" class="title">
            <h3>{{  $product->pro_name }}</h3>
        </a>
        @if ($product->pro_number <= 0)
            <p style="position: absolute;right: 10px;color: #E91E63;font-weight: bold;">Tạm hết hàng</p>
        @endif
        
        </p>
        @if ($product->pro_sale)
            <p>
               
                <!-- @php 
                    $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                @endphp -->
                <span class="price">{{  number_format($product->pro_price-($product->pro_price*$product->pro_sale)/100,0,',','.') }} VNĐ</span>
                <span class="price-sale">{{ number_format($product->pro_price,0,',','.') }} VNĐ</span>
            </p>
        @else 
            <p class="price">{{  number_format($product->pro_price,0,',','.') }} đ</p>
        @endif
        
    </div>
@endif