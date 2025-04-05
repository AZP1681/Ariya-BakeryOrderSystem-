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


        <div class="adp-table">
        <h1>All Products</h1>
          <table class="table table-striped table-bordered" id="orders-table">
            <thead> 
              <tr> 
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th class="apd-desc-th">Description</th> 
                <th>Price</th>  
                <th>Category</th>  
                <th>Functions</th> 
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
  
<div class="product-update-popup" id="productUpdateForm">
  <div class="product-update-container">
    <h2>Update Product</h2>
    <form method="POST" action="/admin/products/update">
      @csrf

      <label for="product-name">Product Name</label>
      <input type="text" id="ed-product-name" name="name" required>

      <label for="product-description">Description</label>
      <textarea id="ed-product-description" name="description" rows="4" required></textarea>

      <label for="product-image">Product Image</label>
      <input type="text" id="ed-product-image-link" name="product image url" required>
 
      <label  for="product-category">Category</label>
      <select id="ed-product-category" name="category" required>
        <option value="breads" {{ request('type') == 'breads' ? 'selected' : '' }}>Breads</option>
        <option value="cakes" {{ request('type') == 'cakes' ? 'selected' : '' }}>Cakes</option>
        <option value="pastries" {{ request('type') == 'pastries' ? 'selected' : '' }}>Pastries</option>
        <option value="drinks" {{ request('type') == 'drinks' ? 'selected' : '' }}>Drinks</option>
      </select>

      <label for="product-price">Price (€)</label>
      <input type="number" step="0.01" id="ed-product-price" name="price" required>

      <div class="product-update-actions">
        <button type="submit" class="submit-btn" onclick="editProduct()">Update</button>
        <button type="button" class="cancel-btn" onclick="hideProductUpdateForm()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<div class="product-add-popup" id="productAddForm">
  <div class="product-add-container">
    <h2>Insert Product</h2>
    <form method="POST" action="/admin/products/add">
      @csrf 

      <label for="product-name">Product Name</label>
      <input type="text" id="ed-product-name" name="name" required>

      <label for="product-description">Description</label>
      <textarea id="ed-product-description" name="description" rows="4" required></textarea>

      <label for="product-image">Product Image</label>
      <input type="text" id="ed-product-image-link" name="product image url" required>
 
      <label  for="product-category">Category</label>
      <select id="ed-product-category" name="category" required>
        <option value="breads" {{ request('type') == 'breads' ? 'selected' : '' }}>Breads</option>
        <option value="cakes" {{ request('type') == 'cakes' ? 'selected' : '' }}>Cakes</option>
        <option value="pastries" {{ request('type') == 'pastries' ? 'selected' : '' }}>Pastries</option>
        <option value="drinks" {{ request('type') == 'drinks' ? 'selected' : '' }}>Drinks</option>
      </select>

      <label for="product-price">Price (€)</label>
      <input type="number" step="0.01" id="ed-product-price" name="price" required>

      <div class="product-add-actions">
        <button type="submit" class="submit-btn" onclick="insertProduct()">Insert</button> 
        <button type="button" class="cancel-btn" onclick="hideProductAddForm()">Cancel</button>
      </div>
    </form>
  </div>
</div>


<div class="cd-popup" role="alert">
  <div class="cd-popup-container">
     <p>Are you sure you want to delete this product?</p>
     <label for="input">Comfirm Product ID - </label>
     <input type="text" id="product_id_comfirm" value="" >
     <ul class="cd-buttons">
        <li><a  onclick="delete_product()">Yes</a></li> 
        <li><a  onclick="closePopup()">No</a></li> 
     </ul>  
     <a class="cd-popup-close img-replace"  onclick="closePopup()"></a>
  </div> 
</div> 
 
@endsection  <!-- End content section -->  

@section('scripts') 
<script>
   window.onload = function() {
    fetchProducts();
    
  } 


    function fetchProducts() {
      fetch("{{ route('admin.products.fetch') }}")
        .then(response => response.json())
        .then(data => {

            data.sort((a, b) => a.id - b.id);

            let tableBody = document.getElementById("products-table-body");
            tableBody.innerHTML = ""; 
            data.forEach(product => {
                tableBody.innerHTML += `
                  <tr class="product-tr"> 
                        <td> 
                          <div class="adp-img-container">
                           <img src="${product.product_img_link}" alt="">
                          </div> 
                        </td> 
                        <td class="adp-id">${product.id}</td>
                        <td class="adp-name">${product.product_name}</td> 
                        <td class="adp-desc">${product.product_desc}</td>
                        <td class="adp-price">€${parseFloat(product.product_price).toFixed(2)}</td>
                        <td class="adp-cate">${product.category.charAt(0).toUpperCase() + product.category.slice(1)}</td>
                        <td class="adp-func">  
                          <div class="adp-btn-container">
                            <a  onclick="showProductUpdateForm(${product.id},'${product.product_name}','${product.product_desc}', '${product.product_img_link}' ,'${product.product_price}','${product.category}')" class="adp-edit-btn">Edit</a>

                            <a  onclick="showPopup(); setSelectedProductId(${product.id})" class="adp-delete-btn">Delete</a> 
                          </div>     
                        </td>  
                  </tr>   
                `;  
            });   
        });    
    }

    setInterval(fetchProducts, 12000); // Refresh every 20 seconds



  
    let selectedProductId = null;

    function showProductUpdateForm(id, name, description, imgUrl, price, category) {
      
      document.getElementById('ed-product-name').value = name;
      document.getElementById('ed-product-description').value = description;
      document.getElementById('ed-product-price').value = price;
      document.getElementById('ed-product-category').value = category; 
      document.getElementById('ed-product-image-link').value = imgUrl;
      
      selectedProductId = id;
  
      document.getElementById('productUpdateForm').classList.add('is-visible');

    } 

    function hideProductUpdateForm() {
      document.getElementById('productUpdateForm').classList.remove('is-visible');
    }
  
    document.addEventListener('keyup', function (e) {
      if (e.key === 'Escape') {
        hideProductUpdateForm();
      }
    }); 

    function showProductAddForm() {
      document.getElementById('productAddForm').classList.add('is-visible');
    } 

    function hideProductAddForm() {
      document.getElementById('productAddForm').classList.remove('is-visible');
    }
 
    document.addEventListener('keyup', function (e) {
      if (e.key === 'Escape') {
        hideProductAddForm();
      }
    });

    function editProduct() {
     
      let productId = selectedProductId;
      let productName = document.getElementById('ed-product-name').value;
      let productDesc = document.getElementById('ed-product-description').value;
      let productPrice = document.getElementById('ed-product-price').value;
      let productImgLink = document.getElementById('ed-product-image-link').value;
      let productCategory = document.getElementById('ed-product-category').value; 


      fetch("{{ route('admin.products.update') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
        },
        body: JSON.stringify({ 
            product_id: productId,  
            product_name: productName,
            product_desc: productDesc,
            product_price: productPrice,
            product_img_link: productImgLink, 
            category: productCategory 
        }) 
      })
      .then(response => response.json())   
      .then(data => {
        window.location.href = "{{ route('admin.products.view') }}"; 
      })  
      .catch(error => console.error("Error updating product's data:", error));
 
    }  
    
   //Delete product
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

    function setSelectedProductId(id) {
        selectedProductId = id; 
    }

    function delete_product(){
      let product_id = document.getElementById('product_id_comfirm').value;
  
        if (product_id == selectedProductId) {
            fetch("{{ route('admin.products.delete') }}", {
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
                    window.location.href = "{{ route('admin.products.view') }}";  
                } else { 
                    alert('Something went wrong. Please try again.'); 
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert("Product ID does not match");  
        }
    } 

    //Add product
    function insert_product(name,desc,imglink,cate,price){
  
      fetch("{{ route('admin.products.add') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
        },
        body: JSON.stringify({ 
            product_name: name,  
            product_desc: desc,
            product_price: price,
            product_img_link: imglink,  
            category: cate 
        }) 
      })
      .then(response => response.json())  
      .then(data => {
        window.location.href = "{{ route('admin.products.view') }}"; 
      })  
      .catch(error => console.error("Error updating product's data:", error));
 
    }

</script>

@endsection    
