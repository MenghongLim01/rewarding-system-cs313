@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="main-content">
    <h2>System Statistics</h2>
    <div class="courses">
      <div class="course-card">
        <div class="course-icon">👤</div>
        <p>Total Users: 1,250</p>
      </div>
      <div class="course-card">
        <div class="course-icon">🎁</div>
        <p>Total Redemptions: 875</p>
      </div>
      <div class="course-card">
        <div class="course-icon">💎</div>
        <p>Points Issued: 150,000</p>
      </div>
    </div>
  </div>
@endsection
