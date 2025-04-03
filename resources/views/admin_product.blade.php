@extends('layouts.app') 

@section('title', 'Orders')  
@section('body-class', 'adm-order-body')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Ad_Style.css') }}">
@endpush

@section('content')  <!-- The content section -->
 
<div class="page">
    <header tabindex="0">Ariya's Admin Panel</header>
    <div id="nav-container">
      <div class="bg"></div>
      <div class="button" tabindex="0">
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </div> 
      <div id="nav-content" tabindex="0">
        <ul>
          <li><a href="#0">Products</a></li>
          <li><a href="{{ route('admin.orders.view') }}">Orders</a></li>
          <li><a href="#0">Customers</a></li>
          <li><a href="#0">Reviews</a></li>
          <li class="small"><a href="#0">Facebook</a><a href="#0">Instagram</a></li>
        </ul> 
      </div> 
    </div>  
  
    <main>
      <div class="content">
        <div class="ap-table">
        <h1>All Products</h1>
          <table class="table table-striped table-bordered" id="orders-table">
            <thead> 
              <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th> 
                <th>Price</th>  
                <th>Category</th> 
              </tr>
            </thead>
            <tbody id="products-table-body">
              <!-- Orders will be populated here by JavaScript -->


            </tbody>
          </table>
        </div>
      </div>
    </main> 
  </div>
  

@endsection  <!-- End content section -->  

@section('scripts') 
<script>
   window.onload = function() {
    fetchProducts();} 


    function fetchProducts() {
      fetch("{{ route('admin.products.fetch') }}")
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById("products-table-body");
            tableBody.innerHTML = ""; 
            data.forEach(product => {
                tableBody.innerHTML += `
                  <tr class="order-tr"> 
                        <td>${product.product_img_link}</td> 
                        <td>${product.id}</td>
                        <td>${product.product_name}</td> 
                        <td>${product.product_desc}</td>
                        <td>${product.product_price}</td> 
                        <td>${product.category}</td>  
                  </tr>  
                `; 
            }); 
        });   
    }

    setInterval(fetchProducts, 12000); // Refresh every 20 seconds




</script>

@endsection    
