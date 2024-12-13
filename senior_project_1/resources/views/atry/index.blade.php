<!DOCTYPE html>
<html>
  <head> 
   @include('atry.css')
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


</style>
  </head>
  <body>
  @include('atry.header')
 
      <!-- Sidebar Navigation-->
      <div class="flex flex-col md:flex-row">
   @include('atry.sidebar')
      <!-- Sidebar Navigation end-->
      
        @include('atry.body')
      </div>
      @include('atry.footer')
  <script>
    
  </script>
  </body>
</html>
