@php 
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
  
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ url('admin/dashboard')}}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png')}}" alt="">
						  <h3><b>Bublee</b> </h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="{{ ($route=='admin.dashboard')?'active':''}}">
          <a href="{{ url('admin/dashboard')}}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>  

        <li class="treeview {{ ($route=='all.page')?'active':''}}" >
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('all.user')}}"><i class="ti-more"></i>All User</a></li>  
            <li><a href="{{ route('add.user')}}"><i class="ti-more"></i>Add User</a></li> 
            
          </ul>
        </li>
        <li class=" {{ ($route=='admin.contact.list')?'active':''}}" >
          <a href="{{route('admin.contact.list')}}">
            <i data-feather="message-circle"></i>
            <span>Contact</span>
            
          </a>
          
        </li>
		    <li class=" {{ ($route=='admin.userdata.index')?'active':''}}" >
          <a href="{{route('admin.userdata.index')}}">
            <i data-feather="message-circle"></i>
            <span>User Data</span>
            
          </a>
          
        </li>
		    
        
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>