@extends('layouts.app')  

@section('title', 'Ariya Bakery & Cafe') 

@section('body-class', 'home-body')  

 

@section('content')   
    
    <nav class="navcontainer"> 
        <div class="navbar">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('order') }}">Order Online</a>
            <a href="{{ route('about') }}">About</a> 
            <a href="{{ route('contact') }}">Contact</a>
        </div>
    </nav>
     <div class="image-container">
        <img src="\Images\main_graded.jpg" alt=""> 
        <h3>Ariya</h3> 
        <h1>Bakery & Café</h1>
        <p>Malesicka ec. 74, Praha 3, Prague</p>
     </div> 
  
     <div class="long-one">  
         
        <div class="img-con-wrapper">
        <div class="img-con">
            <img src="\Images\bakes_counter.jpg" alt="Baked Goods">
        </div>
        </div>
 
       <div class="first-segment-txts">
         <h2>High Quality Foods</h2>
         <p>We believe that the best moments in life are shared over freshly baked goods. Each loaf, pastry, and cake is crafted with love,
             using only the finest ingredients to bring you the taste of warmth and comfort.
             From buttery croissants and soft, crusty bread to decadent cakes and delicate cookies, every bite is a celebration of flavor.
        </p>

        <p>✨ Baked Fresh Daily <br> 🍞 Made with Love and Care</p>
       </div>
       
    </div>

     <div class="short-one">
        

        <div class="second-segment-txts">
            <h2>Relax, and Unwind at Ariya</h2>

            <p>Escape the hustle and find your calm in our cozy 
               café. Savor freshly brewed coffee, handcrafted drinks, 
               and delicious pastries in a warm, welcoming space designed for relaxation. 
               Whether you're catching up with friends or enjoying a quiet moment alone, every visit feels like a retreat.
           </p>
   
          </div>


        <div class="short-one-img-con-wrapper">
            <div class="short-one-img-con">
                <img src="\Images\table1.jpg" alt="Baked Goods">
            </div>
        </div>
     
           

     </div>



     <div class="long-two">
        <div class="long-two-img-con-wrapper">
            <div class="long-two-img-con">
                <img src="\Images\caffeeandtables.jpg" alt="Baked Goods">
            </div>
            </div>
     
           <div class="third-segment-txts">
             <h2>Visit us today and taste something difference!</h2>
             <p>
                Step into our cozy bakery and let the aroma of fresh baking wrap around you.  
                Whether you're here for your morning coffee, a sweet treat, or to pick up
                something special for a loved one, we're here to make every visit memorable.
            </p>  
     
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