<!-- /resources/views/admin/layouts/sidebar.blade.php -->
<aside class="sidebar">
  <div class="logo">Admin Panel</div>
  <div class="menu">
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.rewards') }}">Manage Rewards</a></li>
        <li><a href="{{ route('admin.users') }}">Users Management</a></li>
        <!-- <li><a href="{{ route('admin.logs') }}">View Logs</a></li> -->
        <!-- <li><a href="{{ route('admin.settings') }}">Settings</a></li> -->
        
        <li><a href="{{ route('staffs') }}">Manage Staffs</a></li>
        <li><a href="{{ route('staffs') }}">Transaction History</a></li>

        <li><a href="{{ route('admin.profile') }}">👤 My Profile</a></li>
    </ul>
  </div>
</aside>
