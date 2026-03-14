@extends('layouts.app') 

@section('title', 'About Ariya')  
@section('body-class', 'about-body')  


@section('content')  <!-- The content section -->

<nav class="navcontainer"> 
    <div class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('order') }}">Order Online</a>
        <a href="{{ route('about') }}">About</a> 
        <a href="{{ route('contact') }}">Contact</a>
    </div>
</nav>
 

<div class="abt-cont-image-container">
    <img src="/images/bakes_counter-graded.jpg" alt=""> 
    <h3>About Us</h3>  
    <h1>A cozy bakery & café in Prague offering high-quality pastries, breads, and drinks made with the finest ingredients.</h1>
</div>

<div class="about-one">
     
    <div class="abt-img-con-wrapper">
      <div class="abt-img-con">
        <img src="/images/tablefillwithcakes.jpg" alt="Baked Goods">
      </div>
    </div> 

   <div class="about-segment-txts">     

        <div class="emailandphone-txts">
            <h2>Who are we?</h2>
            <p>Welcome to Ariya – where quality meets comfort! We take pride in crafting delicious, 
                high-quality baked goods and freshly brewed coffee, perfect for any moment of your day.
                Whether you're grabbing a quick bite, enjoying a relaxing break in our cozy café (with free Wi-Fi!),
                or ordering your favorites online for delivery, we're here to serve you with care and flavor.
           </p>
        </div>

        <div class="abt-information-txts">
            <h2>Come for food, stay for the vibe!</h2> 
            <p class="abt-different-p">
                Open Daily: 9:00 AM - 6:00 PM  
                <br>🚚 Online Orders & Delivery Available
                <br>📶 Free Wi-Fi for a Relaxing Stay
           </p>
        </div>
   </div>

</div>


<div class="location-footer"> 
    <h3>Location</h3>
    <p>Malesicka ec. 74, Praha 3, Prague</p>
 </div> 

@endsection  <!-- End content section -->  