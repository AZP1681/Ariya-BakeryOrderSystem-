@extends('layouts.app') 

@section('title', "Ariya's Online Order")  
@section('body-class', 'admin-cart-body')   

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Ad_Style.css') }}">
@endpush
@section('content')  <!-- The content section -->
 
 <header class="admin_panel_nav" tabindex="0">Ariya's Admin Panel
  <button onclick="window.location.href='{{ route('admin.orders.view') }}'">Back</button>
 </header>
 
 

  <div class="ad-scrollable-table">
    <table class="admin-cart-table"> 
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
            <tr class="acp-tr">
              <td class="acp-img">  
                  <div class="acp-img-container">
                    <img src="{{ $item['product']->product_img_link }}" alt="">
                  </div>
              </td> 
              <td class="acp-name" id="acp_name_{{ $item['product']->id }}">{{ $item['product']->product_name }}</td> 
              <td class="acp-price" id="acp_price_{{ $item['product']->id }}">€{{ number_format($item['product']->product_price, 2) }}</td>
              <td>
                  <input id="acp_quantity_input_{{ $item['product']->id }}" type="number" name="quantity" class="ad-quantity-input" value="{{ $item['quantity'] }}" readonly>
              </td> 
              <td id="acp_total_{{ $item['product']->id }}" class="acp-total"></td> 
            </tr> 
          @endforeach   
  
        </tbody>
    </table>  
 </div>  

<div class="RightBoxes-ForAdmin"> 

    <div class="ad-order-summary" id="ordersumbox"> 
        <h2>Order Summary</h2>

        <div class="ad-amount-couple">
             <h1>Delivery Fees</h1>   
             <p id="deli_fee_txt">€4.00</p> 
        </div> 

        <div class="ad-amount-couple">
             <h1>Taxes</h1>  
              <p id="tax_txt">€1.20</p>
        </div>

        <div class="ad-amount-couple"> 
             <h1>Total Amount</h1>   
             <p id="ad-order_total_txt"></p> 
        </div>

        <button class="order-delete-btn"  onclick="showPopup()">Delete Order</button>
    </div>  
    
</div>

<div class="cd-popup" role="alert">
  <div class="cd-popup-container">
     <p>Are you sure you want to delete this order?</p>
     <label for="input">Comfirm Order ID - </label>
     <input type="text" id="order_id_comfirm" value="" >
     <ul class="cd-buttons">
        <li><a  onclick="delete_order()">Yes</a></li>
        <li><a  onclick="closePopup()">No</a></li> 
     </ul>  
     <a class="cd-popup-close img-replace"  onclick="closePopup()"></a>
  </div> 
</div> 



@endsection 

@section('scripts') 
<script>

 document.addEventListener('DOMContentLoaded', () => { 

    @foreach ($ordered_items as $item)
        each_product_total({{$item['product']->id}});
    @endforeach  

 }); 

 let products_total = 0;

 function each_product_total(product_id){
   let price_txt = document.getElementById('acp_price_' + product_id);
   let total_txt = document.getElementById('acp_total_' + product_id);
   let quantity_input = document.getElementById('acp_quantity_input_' + product_id);
   
   let price = parseFloat(price_txt.innerText.replace('€', ''));
   let quantity_value = parseInt(quantity_input.value, 10);
   
   if (quantity_value < 1) {
       alert("Quantity must be at least 1");
       this.value = 1;
       quantity_value = 1; 
   }
      
   let total = 0; 
   total = price * quantity_value;  
   console.log(total); 
   total_txt.innerText = '€' + total.toFixed(2); 
  
   calculate_products_total();
} 
 
function calculate_products_total(){

    products_total = 0;
    let each_total_txt = document.querySelectorAll('.acp-total');
    each_total_txt.forEach(total_txt => { 
    let ep_total = parseFloat(total_txt.innerText.replace('€', '')) || 0;
    products_total += ep_total;

   }); 
   calculate_order_summary();
}

  function calculate_order_summary(){
    let tax_txt = document.getElementById('tax_txt'); 
    let deli_txt = document.getElementById('deli_fee_txt');
    let all_total = document.getElementById('ad-order_total_txt'); 
     
    let delivery_fees = parseFloat(deli_txt.innerText.replace('€', '')) || 0;
    let taxes = parseFloat(tax_txt.innerText.replace('€', '')) || 0;  
    let order_total = products_total + delivery_fees + taxes; 
    all_total.innerText = '€' + order_total.toFixed(2);    
  }
 
  document.addEventListener("DOMContentLoaded", function () {
    const popup = document.querySelector(".cd-popup");

    window.showPopup = function () { 
        if (popup) {
            popup.classList.add("is-visible");
            console.log("Popup opened");
        }
    };

    window.closePopup = function () {
        if (popup) {
            popup.classList.remove("is-visible");
            console.log("Popup closed");
        }
    };

    document.addEventListener("keyup", function (event) {
        if (event.key === "Escape") {
            closePopup();
        }
    });
}); 

 
function delete_order(){
  let order_id = document.getElementById('order_id_comfirm').value;
  let o_id = '{{ session("o_id") }}';
    if (order_id == o_id) {
        fetch("{{ route('order_detail_delete') }}", {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ order_id: order_id })
        })
        .then(response => response.json())  
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('admin.orders.view') }}";  
            } else { 
                alert('Something went wrong. Please try again.'); 
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Order ID does not match");  
    }
} 

</script>


@endsection    
