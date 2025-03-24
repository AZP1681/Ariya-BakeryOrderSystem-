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
              <td class="cp-name">{{ $product->product_name }}</td>
              <td class="cp-price">€{{ number_format($product->product_price, 2) }}</td>
              <td>
                  <input type="number" name="quantity" class="quantity-input" value="1">
              </td>
              <td class="cp-total"></td>
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
             <p>$4.00</p>
        </div>

        <div class="amount-couple">
             <h1>Taxes</h1>  
              <p>$2.00</p>
        </div>

        <div class="amount-couple">
             <h1>Total Amount</h1>   
             <p>$18.00</p>
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



          


        });


    </script>

@endsection