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
          <li><a href="{{ route('admin.products.view') }}">Products</a></li>
          <li><a href="{{ route('admin.orders.view') }}">Orders</a></li>
          <li><a href="#0">Customers</a></li>
          <li><a href="#0">Reviews</a></li>
          <li class="small"><a href="#0">Facebook</a><a href="#0">Instagram</a></li>
        </ul> 
      </div> 
    </div>  
  
    <main>
      <div class="content">
        <div class="ao-table">
        <h1>Arrived Orders</h1>
        
        <div class="search-bar-container">
          <form onsubmit="searchOrders(event); return false;"> 
            <input type="text" id="order-search" placeholder="Search Orders by Name..." class="search-input"
                   name="search" onkeydown="if (event.key === 'Enter') { event.preventDefault(); searchOrders(event); }">
          </form> 
        </div>

          <table class="table table-striped table-bordered" id="orders-table">
            <thead>
              <tr> 
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Phone</th> 
                <th>Address</th> 
                <th>Total Amount</th> 
              </tr>
            </thead>
            <tbody id="orders-table-body">
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
    fetchOrders();} 


    function fetchOrders() {
      fetch("{{ route('admin.orders.fetch') }}")
        .then(response => response.json())
        .then(data => {

            data.sort((a, b) => a.id - b.id);

            let tableBody = document.getElementById("orders-table-body");
            tableBody.innerHTML = ""; 
            data.forEach(order => {
                tableBody.innerHTML += `
                  <tr class="order-tr" onClick="fetchOrderDetail('${order.ordered_products}', '${order.ordered_quantity}', '${order.id}')"> 
                        <td>${order.id}</td>
                        <td>${order.name}</td> 
                        <td>${order.phone}</td>
                        <td>${order.address}</td> 
                        <td>${order.total_amount}</td>
                  </tr>  
                `; 
            });
        });  
    }  


    function searchOrders(event) {
      event.preventDefault();  
      const searchValue = document.getElementById('order-search').value.trim();
     
      if (searchValue === "") {
          console.log("Search field is empty.");
          fetchOrders();  
          return;  
      }


      fetch(`{{ route('admin.order.search') }}?search=${encodeURIComponent(searchValue)}`)
        .then(response => response.json())
        .then(data => { 
            
          data.sort((a, b) => a.id - b.id);

          let tableBody = document.getElementById("orders-table-body");
          tableBody.innerHTML = ""; 

          if (data.length > 0) {
          data.forEach(order => {
              tableBody.innerHTML += `
                <tr class="order-tr" onClick="fetchOrderDetail('${order.ordered_products}', '${order.ordered_quantity}', '${order.id}')"> 
                      <td>${order.id}</td>
                      <td>${order.name}</td> 
                      <td>${order.phone}</td>
                      <td>${order.address}</td> 
                      <td>${order.total_amount}</td>
                </tr>  
              `; 
          });
          }else {
            tableBody.innerHTML = `
              <tr>
                <td colspan="5" class="no-results">No results found for "${searchValue}"</td>
              </tr>   
            `;
          }

        }) 
        .catch(error => {
            console.error("Error fetching products:", error);
        }); 
    } 

    setInterval(fetchOrders, 12000);


    function fetchOrderDetail(orderedProducts, orderedQuantity, orderId) {

      fetch("{{ route('order_detail_fetch') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
        },
        body: JSON.stringify({
            ordered_products: orderedProducts, 
            ordered_quantity: orderedQuantity,
            order_id: orderId
        })
      })
      .then(response => response.json())  
      .then(data => {
        window.location.href = "{{ route('order_detail_page') }}"; 
      })
      .catch(error => console.error("Error fetching order details:", error));

    }






</script>

@endsection    
