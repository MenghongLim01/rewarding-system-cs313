<!-- /resources/views/admin/layouts/sidebar.blade.php -->
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<aside class="sidebar">
  <div class="menu">
    <ul>
      <li>
       <div class="d-flex flex-column align-items-center">
    <a href="{{ route('admin.setting') }}" class="text-decoration-none text-center">
        <img src="{{ asset('images/' . Auth::guard('admin')->user()->admin_profile_image) }}" 
             alt="Avatar"
             class="rounded-circle border border-2 border-secondary shadow-sm "
             style="width: 50px; height: 50px; object-fit: cover;">

        <div class="form-label">
            {{ Auth::guard('admin')->user()->admin_name }}
        </div>
    </a>
</div>

        
      </li>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.companies.index') }}">Company Management</a></li>
        <li><a href="{{ route('admin.rewards') }}">Rewards Management</a></li>
        <li><a href="{{ route('admin.users') }}">Users Management</a></li>
        <!-- <li><a href="{{ route('admin.logs') }}">View Logs</a></li> -->
        <!-- <li><a href="{{ route('admin.settings') }}">Settings</a></li> -->
        
        <li><a href="{{ route('staffs') }}">Staffs Management</a></li>
        <li><a href="{{ route('staffs') }}">Transaction History</a></li>

        <li class="hi hover:bg-light">
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
              <button type="submit" 
                class="text-danger border-0 bg-transparent text-start"
                style="font: inherit; cursor: pointer;">
                Logout
              </button>
          </form>
        </li>

        
    </ul>
  </div>
</aside>

