<!-- /resources/views/admin/layouts/sidebar.blade.php -->
<aside class="sidebar">
  <div class="menu">
    
    <ul>
      <li><div class="ms-auto d-flex align-items-center">
    <span class="me-2">{{ Auth::user()->name }}</span>
    <img 
      src="{{ asset('images/' . Auth::guard('admin')->user()->admin_profile_image) }}" 
      alt="Profile" 
      class="rounded-circle" 
      style="width: 50px; height: 50px; object-fit: cover;"
    >
  </div></li>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.rewards') }}">Company Management</a></li>
        <li><a href="{{ route('admin.rewards') }}">Rewards Management</a></li>
        <li><a href="{{ route('admin.users') }}">Users Management</a></li>
        <!-- <li><a href="{{ route('admin.logs') }}">View Logs</a></li> -->
        <!-- <li><a href="{{ route('admin.settings') }}">Settings</a></li> -->
        
        <li><a href="{{ route('staffs') }}">Staffs Management</a></li>
        <li><a href="{{ route('staffs') }}">Transaction History</a></li>

        <li><a href="{{ route('admin.profile') }}">👤 My Profile</a></li>
        
    </ul>
  </div>
</aside>

