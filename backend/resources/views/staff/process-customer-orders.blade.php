@extends('staff.layouts.layout')

@section('title', 'Customer Order - Staff Panel')

@section('content')
<style>
    .receipt-line {
        display: flex;
        justify-content: space-between;
    }

    .hidden {
        display: none;
    }
</style>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Customer Order (Staff Panel)</h1>
@if ($errors->any())
    <div class="mb-6 p-4 bg-red-200 text-red-700 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('staff.process-order') }}">
        @csrf
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Company:</label>
            <select disabled class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                <option selected>{{ $company->company_name }}</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="user_id" class="block text-gray-700 font-semibold mb-2">Select User</label>
            <select id="user_id" name="user_id" class="w-full p-3 border border-gray-300 rounded-lg" required>
                <option value="" disabled selected>-- Choose a User --</option>
                @foreach($users as $user)
             <option value="{{ $user->user_id }}">{{ $user->user_name }} - {{ $user->user_email }}</option>
         @endforeach
            
            </select>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-purple-700 mb-3">Order Items</h2>
            <div id="foodItemsContainer"></div>
            <button id="addFoodItemBtn" type="button" class="w-full mt-4 bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700">Add Food Item</button>
        </div>

        <div class="border-t pt-4 mt-6">
            <div class="flex justify-between mb-4 text-lg">
                <span>Total:</span>
                <span id="totalCost" class="font-bold text-purple-700">$0.00</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <label for="manualPoints" class="text-lg font-semibold text-gray-800">Points to Award:</label>
                <input type="number" id="manualPoints" name="points_awarded" value="0" min="0" step="1"
                    class="w-32 text-right p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-green-700 font-bold">
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" id="processOrderBtn" class="flex-1 bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700">Process Order</button>
            <button type="button" id="clearOrderBtn" class="flex-1 bg-gray-400 text-white py-3 rounded-md hover:bg-gray-500">Clear Order</button>
        </div>
    </form>
</div>

<div id="receiptForm" class="max-w-2xl mx-auto bg-white mt-10 p-6 rounded-xl shadow-lg hidden">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🧾 Order Receipt</h2>
    <div class="mb-4">
        <p><strong>Customer:</strong> <span id="receiptCustomer" class="text-gray-700"></span></p>
        <p><strong>Date:</strong> <span id="receiptDate" class="text-gray-700"></span></p>
    </div>
    <div id="receiptItems" class="space-y-2 mb-4"></div>
    <div class="border-t pt-4 text-lg">
        <p><strong>Total:</strong> <span id="receiptTotal" class="text-purple-700 font-bold"></span></p>
        <p><strong>Points Awarded:</strong> <span id="receiptPoints" class="text-green-600 font-bold"></span></p>
    </div>
    <div class="mt-6 text-center">
        <button onclick="document.getElementById('receiptForm').classList.add('hidden')" class="text-sm text-blue-600 hover:underline">Hide Receipt</button>
    </div>
</div>

@push('scripts')
<script>
    const foodItemsContainer = document.getElementById("foodItemsContainer");
    const totalCostEl = document.getElementById("totalCost");
    const manualPointsEl = document.getElementById("manualPoints");
    let counter = 0;

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll(".food-price").forEach(input => {
            const price = parseFloat(input.value) || 0;
            total += price;
        });
        totalCostEl.textContent = `$${total.toFixed(2)}`;
    }

    function addFoodItem() {
        counter++;
        const row = document.createElement("div");
        row.className = "food-item flex gap-4 mb-3 items-center";
        row.innerHTML = `
            <input type="text" class="food-name flex-grow p-2 border rounded-md" placeholder="Item ${counter}" />
            <input type="number" class="food-price w-32 p-2 border rounded-md" placeholder="0.00" min="0" step="0.01" />
            <button class="remove-item bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">X</button>
        `;
        row.querySelector(".food-price").addEventListener("input", calculateTotal);
        row.querySelector(".remove-item").addEventListener("click", () => {
            row.remove();
            calculateTotal();
        });
        foodItemsContainer.appendChild(row);
    }

    document.getElementById("addFoodItemBtn").addEventListener("click", addFoodItem);

    document.getElementById("clearOrderBtn").addEventListener("click", () => {
        foodItemsContainer.innerHTML = "";
        totalCostEl.textContent = "$0.00";
        manualPointsEl.value = 0;
        document.getElementById("receiptForm").classList.add("hidden");
        counter = 0;
        addFoodItem();
    });

    document.getElementById("processOrderBtn").addEventListener("click", () => {
        const customer = document.getElementById("user_id").value.trim();
        const points = manualPointsEl.value;
        const total = totalCostEl.textContent;

        if (!customer) {
            alert("Please select a user.");
            return;
        }

        const items = [];
        document.querySelectorAll(".food-item").forEach((row) => {
            const name = row.querySelector(".food-name").value.trim();
            const price = parseFloat(row.querySelector(".food-price").value || 0).toFixed(2);
            if (name && price > 0) {
                items.push({ name, price });
            }
        });

        if (items.length === 0) {
            alert("Please add at least one food item.");
            return;
        }

        document.getElementById("receiptCustomer").textContent = customer;
        document.getElementById("receiptDate").textContent = new Date().toLocaleString();
        document.getElementById("receiptTotal").textContent = total;
        document.getElementById("receiptPoints").textContent = `${points} pts`;

        const receiptItems = items.map(item => `
            <div class="receipt-line">
                <span>${item.name}</span>
                <span>$${item.price}</span>
            </div>
        `).join("");
        document.getElementById("receiptItems").innerHTML = receiptItems;

        document.getElementById("receiptForm").classList.remove("hidden");
    });

    addFoodItem();
</script>
@endpush

@endsection
