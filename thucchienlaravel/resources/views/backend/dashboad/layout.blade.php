
<!DOCTYPE html>
<html>

<head>
      @include('backend.dashboad.component.head')
</head>

<body>
    <div id="wrapper">
  @include('backend.dashboad.component.sidebar')
<div id="page-wrapper" class="gray-bg">

@include('backend.dashboad.component.nav')
@include($template)
 
    
        </div>
    </div>
 </div>
 @include('backend.dashboad.component.footer')
    <!-- Mainly scripts -->
  
        
    
</body>

  @include('backend.dashboad.component.script')
</html>
