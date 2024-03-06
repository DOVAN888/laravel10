  
<?php

  $segment = request()->segment(1);
  //dong nay de lay segment 
  //http://vantuongcongnghe.com:8000/user/catalogue/index vi du nay http://vantuongcongnghe.com:8000 la mien lay gia tri sau dau gach cheo dau tien la segment(1)
  //va gia tri sau dau gach dau tien do la user 
  //<li class="{{(in_array($segment ,$val['name']))?'active':''}}">sau do them dong nay duoi html 
  // neu duoc dan co gia tri name thi active con khong thi ko active 
 
  ?>


  <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="backend/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">ドバン</strong>
                             </span> <span class="text-muted text-xs block">アートディレクター" <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                             <li><a href="{{route('auth.logout')}}">Logout</a></li>
                            
                            
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                @foreach(config('apps.module.module') as $key=>$val)
                     <li class="{{(in_array($segment ,$val['name']))?'active':''}}">
                        <a><i class="{{$val['icon']}}"></i> <span class="nav-label">{{$val['title']}} </span> <span class="fa arrow"></span></a>
                        @if(isset($val['subModule']))

                        <ul class="nav nav-second-level">
                            @foreach($val['subModule'] as $module)
                           <li> <a href="{{$module['route']}}" class="submenu-item"> <i class="fas fa-people-group"></i><span class="nav-label">{{$module['title']}}</span></a></li>
                           @endforeach

                           
                        </ul>
                        @endif
                    </li>
                    @endforeach


             </ul>
    </nav>

    <!-- doan nay de khi click vao quan ly thi se hien ra jhai thag con  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-Z2UDzdR0sslnA9ofKcmFDoKu8PTDNUTPH2eBUylOgDAV5VYSczojIEAgx7I9t0Wr" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#quan-li-menu").click(function() {
            $(".nav-second-level").slideToggle("fast");
        });

        $(".submenu-item").click(function(e) {
            e.stopPropagation(); // Prevent the menu from closing when clicking on submenu items
        });
    });
</script>