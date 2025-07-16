<nav class="flex justify-between items-center pb-4 border-b border-gray-200">
    <a href="{{ route('staff.process-customer-orders') }}" class="text-2xl font-extrabold text-indigo-700">
        PointTrix Staff
    </a>

    <ul class="flex space-x-6">
        <li>
            <a href="{{ route('staff.process-customer-orders') }}"
               class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">
                Customer Orders
            </a>
        </li>
        <li>
            <a href="{{ route('staff.transactions') }}"
               class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">
                Order History
            </a>
        </li>
        <li>
            <a href="{{ route('staff.transactions') }}"
               class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">
                Transaction History
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('staff.logout') }}">
                @csrf
                <button type="submit"
                        class="text-red-600 font-medium hover:underline transition duration-300">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
