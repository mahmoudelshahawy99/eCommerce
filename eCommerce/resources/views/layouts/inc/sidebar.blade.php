<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="#" class="simple-text logo-normal">
        Marioma-Shop
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item {{ Request::is('categories') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('categories') }}">
              <i class="material-icons">store</i>
              <p>Categories</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('add-category') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('add-category') }}">
              <i class="material-icons">category</i>
              <p>Add Category</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('products') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('products') }}">
              <i class="material-icons">production_quantity_limits</i>
              <p>Products</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('add-product') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('add-product') }}">
              <i class="material-icons">add_shopping_cart</i>
              <p>Add Product</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('orders') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('orders') }}">
              <i class="material-icons">shopping_bag</i>
              <p>Orders</p>
            </a>
        </li>
        <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('users') }}">
              <i class="material-icons">supervisor_account</i>
              <p>Users</p>
            </a>
        </li>
      </ul>
    </div>
  </div>
