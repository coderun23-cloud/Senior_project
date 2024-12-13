<!DOCTYPE html>
<html>
  <head> 
    <style>
      .sidebar-nav-item {
      margin-bottom: 15px; /* Adds space between each sidebar item */
  }
  
  .sidebar-nav-link {
      display: flex;
      align-items: center;
      padding: 10px 15px; /* Adds padding to the links for better spacing */
  }
  
  .sidebar-nav-link i {
      margin-right: 10px; /* Adds space between the icon and the text */
  }
  
  *{
    color: black;
  }
  </style>
   @include('superadmin.css')

  </head>
  <body>
  @include('superadmin.header')
 
      <!-- Sidebar Navigation-->
      <div class="flex flex-col md:flex-row">
   @include('superadmin.sidebar')
      <!-- Sidebar Navigation end-->
      
        @include('superadmin.body')
      </div>
      @include('superadmin.footer')
  <script>
    
  </script>
  </body>
</html>
