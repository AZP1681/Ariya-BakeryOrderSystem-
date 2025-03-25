@extends('layouts.app') 

@section('title', "Ariya's Online Order")  
@section('body-class', 'cart-body')   


@section('content')  <!-- The content section -->

<nav class="navcontainer"> 
    <div class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('order') }}">Order Online</a>
        <a href="{{ route('about') }}">About</a> 
        <a href="{{ route('contact') }}">Contact</a>
    </div> 
</nav> 
 
 <div class="cart-color-container">
    <h3>Order Cart</h3> 
    <div class="cart-color-box"></div>
 </div> 
 
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

          @foreach ($products as $product)
            <tr>
              <td class="cp-img">  
                  <div class="cp-img-container">
                    <img src="{{$product->product_img_link}}" alt="">
                  </div>
              </td> 
              <td class="cp-name" id="cp_name_{{$product->id}}">{{ $product->product_name }}</td>
              <td class="cp-price" id="cp_price_{{$product->id}}">€{{ number_format($product->product_price, 2) }}</td>
              <td>
                  <input id="cp_quantity_input_{{$product->id}}" type="number" name="quantity" class="quantity-input" value="{{session('cart')[$product->id] ?? 1}}"  onchange="quantity_change({{$product->id}}) ">
              </td> 
              <td id="cp_total_{{$product->id}}" class="cp-total">calculate_each_product_total_with_id_forstart({{$product->id}})</td> 
            </tr> 
          @endforeach   
  
        </tbody>
    </table>  
 </div>  

<div class="RightBoxes-Con"> 

    <div class="order-summary" id="ordersumbox"> 
        <h2>Order Summary</h2>

        <div class="amount-couple">
             <h1>Delivery Fees</h1>   
             <p id="deli_fee_txt">€4.00</p>
        </div>

        <div class="amount-couple">
             <h1>Taxes</h1>  
              <p id="tax_txt">€1.20</p>
        </div>

        <div class="amount-couple"> 
             <h1>Total Amount</h1>   
             <p id="order_total_txt">$0</p>
        </div>

        <button class="check-out-btn">Check Out!</button>
    </div>  
    
    <div class="check-out" id="checkoutbox"> 
        <h2>Check Out</h2>

        <input type="text" name="name" class="name-input" placeholder="Name">
        <input type="number" name="phone" class="phone-input" placeholder="Phone">
        <input type="text" name="address" class="address-input" placeholder="Address"> 
        <input type="text" name="district" class="district-input" placeholder="District">
        
        <div class="Payment-options">
           
            <h1>Payment Method</h1> 

            <div class="cod-radio-container">
                <input type="radio" id="cod" name="payment-method" value="cod" onchange="handleRadioChange()">
                <label for="cod">Cash On Delivery</label>
            </div>
            
            <div class="credit-radio-container">
                <input type="radio" id="credit" name="payment-method" value="credit" onchange="handleRadioChange()">
                <label for="credit">Credit Cards</label>
            </div> 
        </div>
         <!--The Credit Inputs-->
         
         <input type="number" name="card-num" class="card-num-input" id="creditpay-object" placeholder="Card Number">
         <input type="text" name="expiration-date" class="expire-date-input" id="creditpay-object" placeholder="Expiration date(MM/YY)">
         <input type="text" name="name-on-card" class="name-on-card-input" id="creditpay-object" placeholder="Name on Card">
      
         <div class="co-btn-container">
            <button class="back-to-ordersum-btn">&#x21e0;</button>
            <button class="send-order-btn">Send Order</button>
         </div>
    </div>
    
    
</div>


@endsection  <!-- End content section -->  


@section('scripts') 
    <script>
         function showCheckout() { 
            let checkoutBox = document.getElementById("checkoutbox");
            let ordersumBox = document.getElementById("ordersumbox");
        
            checkoutBox.style.display = "flex";
            ordersumBox.style.display = "none";
        }

        function showOrderSummary() {
            let checkoutBox = document.getElementById("checkoutbox"); 
            let ordersumBox = document.getElementById("ordersumbox");
        
            checkoutBox.style.display = "none";
            ordersumBox.style.display = "flex";
        }

        document.querySelector(".check-out-btn").addEventListener("click", showCheckout);
        document.querySelector(".back-to-ordersum-btn").addEventListener("click", showOrderSummary);


        /*Radio Buttons Logic*/
        function handleRadioChange(){
            if (document.getElementById('cod').checked) {
               Paywith_Cod();
            }

            if (document.getElementById('credit').checked) {
               Paywith_Credit();
            }
        }

        function Paywith_Cod() { 
            const cardInputs = document.querySelectorAll('.card-num-input, .expire-date-input, .name-on-card-input');
        
            cardInputs.forEach(input => {
              input.style.display = "none";
            });

        }

        function Paywith_Credit() {
            const cardInputs = document.querySelectorAll('.card-num-input, .expire-date-input, .name-on-card-input');
        
            cardInputs.forEach(input => {
              input.style.display = "inline";
            });
        } 

        document.addEventListener('DOMContentLoaded', () => {
          
          const cardInputs = document.querySelectorAll('.card-num-input, .expire-date-input, .name-on-card-input');
          let cod_radio = document.getElementById('cod');
          cod_radio.checked = true;
          cardInputs.forEach(input => { 
            input.style.display = "none";
          }); 

          let checkoutBox = document.getElementById("checkoutbox"); 
          let ordersumBox = document.getElementById("ordersumbox"); 
        
            checkoutBox.style.display = "none";  
            ordersumBox.style.display = "flex";  
          
          //twat total and order sum on start
          @foreach ($products as $product)
          quantity_change({{$product->id}});
          @endforeach 
          
        });


 
        //Cart Quantity and Sum Logics
        //------------------------------------------------------------------------------------------------------
        let products_total = 0;

        function quantity_change(product_id){

            let price_txt = document.getElementById('cp_price_' + product_id);
            let total_txt = document.getElementById('cp_total_' + product_id);
            let quantity_input = document.getElementById('cp_quantity_input_' + product_id);
      
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

            //BE laravel storage update
            updateQuantity(product_id, quantity_value); 

            //update the order summary total  
            calculate_products_total();
        }   

        function calculate_products_total(){
            products_total = 0;
            let each_total_txt = document.querySelectorAll('.cp-total');
            each_total_txt.forEach(total_txt => { 
                let ep_total = parseFloat(total_txt.innerText.replace('€', '')) || 0;
                products_total += ep_total;
            }); 
            
            
            calculate_order_summary();
        }

        function calculate_order_summary(){
           
            let tax_txt = document.getElementById('tax_txt');
            let deli_txt = document.getElementById('deli_fee_txt');
            let all_total = document.getElementById('order_total_txt'); 
            
            let delivery_fees = parseFloat(deli_txt.innerText.replace('€', '')) || 0;
            let taxes = parseFloat(tax_txt.innerText.replace('€', '')) || 0;   

            let order_total = products_total + delivery_fees + taxes; 
            all_total.innerText = '€' + order_total.toFixed(2);    
        }
        
        function updateQuantity(product_id, quantity) {
        fetch('/cart/update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: product_id,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Quantity Updated:", data.cart);
        })
        .catch(error => console.error('Error:', error));
    }
 
    </script> 

@endsection    