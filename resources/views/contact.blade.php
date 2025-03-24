@extends('layouts.app') 

@section('title', 'Contact Us')  
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


<div class="the-contact-image-container">
    <img src="\Images\caffeeandtables_graded.jpg" alt=""> 
    <h3>Reach Out Anytime!</h3>  

    <h1>
        Reach out to us for inquiries, orders, or 
        feedback. We'll get back to you as soon as possible!
    </h1>
</div>  

<div class="cont-one">
      
    <div class="cont-img-con-wrapper">
      <div class="cont-img-con">
        <img src="\Images\outside.jpg">
      </div>
    </div> 

   <div class="cont-segment-txts">     
        <div class="emailandphone-txts">
            <h2>Email and Phone</h2>
            <p>
               ayzune.lovemusic@gmail.com <br>
               +95 09960084000
           </p>
        </div>

        <div class="abt-information-txts">
            <h2>Reviews</h2> 
            <p class="abt-different-p"> 
                Your feedback means the world to us! If you enjoyed our food and service,
                please take a moment to share your experience on Yelp or Facebook.
                Your reviews help us grow and serve you even better. Plus, they help others discover the delicious moments waiting 
                for them here! Thank you for your support!
           </p>
        </div>
   </div>
 
</div>


<div class="location-footer"> 
    <h3>Location</h3>
    <p>Malesicka ec. 74, Praha 3, Prague</p>
 </div>  

@endsection  <!-- End content section -->  