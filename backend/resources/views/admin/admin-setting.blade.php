@extends('admin.layouts.layout')

@section('title', 'Admin Settings')

@section('content')
  <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Admin Settings ⚙️</h1>

  <!-- System Settings Form -->
  <section class="mb-10">
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h2 class="text-2xl font-bold text-gray-700 mb-6 border-b-2 border-purple-300 pb-3">System Configuration</h2>
      <form id="admin-settings-form">
        <div class="form-group">
            <label for="default-points-per-activity">Default Points per Activity</label>
            <input type="number" id="default-points-per-activity" name="default-points-per-activity">
        </div>

        <div class="form-group">
            <label for="min-redemption-threshold">Minimum Redemption Threshold</label>
            <input type="number" id="min-redemption-threshold" name="min-redemption-threshold">
        </div>

        <div class="form-group">
            <label for="reward-expiration-days">Reward Expiration (Days)</label>
            <input type="number" id="reward-expiration-days" name="reward-expiration-days">
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="email-notifications-enabled" name="email-notifications-enabled">
            <label for="email-notifications-enabled">Enable Email Notifications</label>
        </div>

        <div class="form-group">
            <label for="admin-email-for-alerts">Admin Alert Email</label>
            <input type="email" id="admin-email-for-alerts" name="admin-email-for-alerts">
        </div>

        <div class="form-group">
            <button type="submit">Save Settings</button>
        </div>
        </form>

    </div>
  </section>

  <div class="text-center mt-6">
    <a href="{{ route('admin.dashboard') }}" class="text-purple-600 hover:text-purple-500 font-medium">Back to Admin Dashboard</a>
  </div>
@endsection
