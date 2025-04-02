@extends('layouts.app') 

@section('title', "Ariya's Online Order")  
@section('body-class', 'admin-cart-body')   


@section('content')  <!-- The content section -->


 <div class="scrollable-table">
    <table class="cart-table">
        <thead> 
            <tr>
                <th>Product</th>
                <th></th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

          @foreach ($ordered_items as $item) 
            <tr>
              <td class="cp-img">  
                  <div class="cp-img-container">
                    <img src="{{ $item['product']->product_img_link }}" alt="">
                  </div>
              </td> 
              <td class="cp-name" id="cp_name_{{ $item['product']->id }}">{{ $item['product']->product_name }}</td> 
              <td class="cp-price" id="cp_price_{{ $item['product']->id }}">€{{ number_format($item['product']->product_price, 2) }}</td>
              <td>
                  <input id="cp_quantity_input_{{ $item['product']->id }}" type="number" name="quantity" class="quantity-input" value="{{ $item['quantity'] }}">
              </td> 
              <td id="cp_total_{{ $item['product']->id }}" class="cp-total"></td> 
            </tr> 
          @endforeach   
  
        </tbody>
    </table>  
 </div>  

<div class="RightBoxes-ForAdmin"> 

    <div class="order-summary-ad" id="ordersumbox"> 
        <h2>Order Summary</h2>

        <div class="amount-couple-ad">
             <h1>Delivery Fees</h1>   
             <p id="deli_fee_txt">€4.00</p> 
        </div>

        <div class="amount-couple-ad">
             <h1>Taxes</h1>  
              <p id="tax_txt">€1.20</p>
        </div>

        <div class="amount-couple-ad"> 
             <h1>Total Amount</h1>   
             <p id="order_total_txt"></p> 
        </div>

        <button class="check-out-btn-ad">Check Out!</button>
    </div>  
    
</div>


@endsection 

@section('scripts') 



@endsection    
