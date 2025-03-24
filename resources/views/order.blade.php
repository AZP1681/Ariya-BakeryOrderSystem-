@extends('layouts.app') 

@section('title', "Ariya's Online Order")  
@section('body-class', 'order-body')   


@section('content')  <!-- The content section -->

<nav class="order-navcontainer"> 
    <div class="order-navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a> 
        <a href="{{ route('contact') }}">Contact</a>
    </div> 

    
    <a class="cart-btn" href="{{ route('cart') }}"> 
        <img src="/Images/Cart.svg" alt="">  
     </a>   
</nav> 

 <div class="color-container"> 
    <div class="color-box"></div>
    <h3>Order Now!</h3> 
    <h1>If you are from Prague, you can order our foods and coffees directly from
        this page! The Delivery will be available 
        from 9:00 AM to 4:00 PM. 
    </h1>
 </div>

 
<div class="product-nav-container">

    <div class="productnav">

        <div class="search-container">
             
            <img class="search-icon" src="/Images/search-solid.svg" alt="Icon description"></i>
            <input placeholder='Search...' class='product-search' type="text">
             
        </div>

 
        <select class="types-dropdown" name="types-dropdown" id="types">
            <option value="all">All</option>
            <option value="breads">Breads</option> 
            <option value="cakes">Cakes</option>
            <option value="pastry">Pastries</option>
            <option value="drinks">Drinks</option> 
          
        </select>

    </div> 

</div>


  <div class="product-parent">
    <div class="products-container">   
    
        @foreach($products as $product) 
 
        <div class="product-box" onclick="open_product_card('{{ $product->product_name }}', '{{ $product->product_desc }}', '{{ $product->product_img_link }}', '€{{ number_format($product->product_price, 2) }}', '{{ $product->id }}')"> 

            <div class="product-img-con">
               <img src="{{ $product->product_img_link }}">
            </div>  

            <div class="product-txts">
               <h1 class="product-name-txt">{{ $product->product_name }}</h1>
               <div class="price-container">
                <h1 class="price-txt"> €{{ number_format($product->product_price, 2) }} </h1>
               </div>  
            </div> 
        </div>    

        @endforeach
            
     </div> 
  </div>

  <div class="product-card-wrapper">


    <div class="product-card">
        <div class="pc-img"> 
            <img src="/Images/Homemade-Classic-Puff-Pastry-Recipe8.jpg" id="card-img">
        </div>
          <div class="pc-info">
            <div class="pc-text">
              <h2 id="card-name">Vegan croissant with water spinach.</h2>
              <h1 id="card-desc">this food is good. this food is great. eat it pls. eat it now. buy it pls. buy it right away. fck you.</h1>
              <p id="card-price">$2.00</p>
            </div> 
          </div>

          <div class="pc-btn-container"> 
                 
            <button class="back-btn" onclick="close_product_card()" type="button">Back</button>
            <button class="add-tocart-btn" id="addtocard-btn" onclick="" type="button">Add to cart </button>

          </div> 
    </div>    
 
  </div> 

 <footer class="foot"> 
    <div class="copyright-con">
        <h3>© 2025 AyZunePaing and AyZy Softworks. All rights reserved</h3> 
    </div> 
    
    <svg class="foot-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#8A5249" fill-opacity="1" 
        d="M0,192L80,181.3C160,171,320,149,480,154.7C640,160,800,192,960,197.3C1120,203,1280,181,1360,170.7L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
    </path> 
    </svg> 
</footer>   
 
@endsection  <!-- End content section -->  


@section('scripts') 
<script>
    
    window.onload = function() {
         let product_card = document.querySelector(".product-card-wrapper");
         if (product_card) {
             product_card.style.display = "none";  
         }
    }; 

    function open_product_card(product_name, product_desc, product_img_link, product_price, product_id){
        let product_card = document.querySelector(".product-card-wrapper"); 
        product_card.style.display = "flex";
        
        console.log(product_name, product_desc);
 
        
        let card_name_txt = document.getElementById("card-name");
        let card_img = document.getElementById("card-img");
        let card_desc_txt = document.getElementById("card-desc");
        let card_price_txt = document.getElementById("card-price")
        let add_to_cart_btn = document.getElementById("addtocard-btn");  
 
        card_name_txt.innerHTML = product_name; 
        card_desc_txt.innerHTML = product_desc;
        card_price_txt.innerHTML = product_price; 
        card_img.src = product_img_link;   
        add_to_cart_btn.onclick = function() {
         addToCart(product_id);
        };
   
    }  

    function close_product_card(){ 
        let product_card = document.querySelector(".product-card-wrapper"); 
        product_card.style.display = "none";  
    }   

  
    const closeBtn = document.querySelector('.back-btn');
    closeBtn.addEventListener('click', close_product_card);


 

    //Add To Cart 
    function addToCart(the_id) {
        
        fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: the_id
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Cart Updated:", data.cart);
        })
        .catch(error => console.error('Error:', error));
    } 

 
</script>
@endsection 