@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="main-content">
    <h2>System Statistics</h2>
    <div class="courses">
      <div class="course-card">
        <div class="course-icon">👤</div>
        <p>Total Users: {{ number_format($totalUsers) }}</p>
      </div>

      <div class="course-card">
        <div class="course-icon">🏢</div>
        <p>Total Companies: {{ number_format($totalCompanies) }}</p>
      </div>
      <div class="course-card">
        <div class="course-icon">🧑‍🍳</div>
        <p>Total Staffs: {{ number_format($totalStaffs) }}</p>
      </div>
    </div>
    <div class="courses">
      <div class="course-card">
        <div class="course-icon">👤</div>
        <p>Total Users: {{ number_format($totalUsers) }}</p>
      </div>
      <!-- <div class="course-card bg-white rounded-xl shadow-md p-6 text-center w-full max-w-sm mx-auto">
    <div class="course-icon text-4xl mb-4 text-purple-600">👤</div>
    <p class="text-lg font-semibold text-gray-700">Total Users: {{ number_format($totalUsers) }}</p>
</div> -->

      <div class="course-card">
        <div class="course-icon">🎁</div>
        <p>Total Rewards: {{ number_format($totalRewards) }}</p>
      </div>
      <div class="course-card">
        <div class="course-icon">💎</div>
        <p>Points Issued: {{ number_format($totalPoints) }}</p>
      </div>
    </div>
  
  </div>
@endsection
