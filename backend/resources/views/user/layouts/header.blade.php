 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<nav class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
    <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-purple-700">Reward System</a>
    <ul class="flex space-x-6">
        <li><a href="{{ route('dashboard') }}" class="text-purple-600 font-medium transition duration-300">Dashboard</a></li>
        <!-- <li><a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">View Points</a></li> -->
        <li><a href="{{ route('user.redeem') }}" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Redeem Rewards</a></li>
        <li><a href="{{ route('user.history') }}" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">History</a></li>
        <li><a href="{{ route('user.profile') }}" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Profile</a></li>
        <li><form method="POST" action="{{ route('user.logout') }}">
            @csrf
              <button type="submit" 
                class="text-red-600 border-0 bg-transparent text-start font-normal hover:underline hover:font-bold"
                style="font: inherit; cursor: pointer; font-weight:bold; color:red;">
                Logout
            </button>
          </form></li>
    </ul>
</nav>
