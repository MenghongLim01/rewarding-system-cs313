<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'active' => 'admin-dashboard',
        ];

        return view('admin.admin-dashboard', compact('data'));
    }
    
    public function adminSettings()
    {
        $data = [
            'title' => 'Admin Settings',
            'active' => 'admin-settings',
        ];

        return view('admin.admin-setting', compact('data'));
    }

    public function manageUser()
    {
        $data = [
            'title' => 'Manage User',
            'active' => 'manage-user',
        ];

        return view('admin.manage-users', compact('data'));
    }

    public function managerReward()
    {
        $data = [
            'title' => 'Manage Reward',
            'active' => 'manage-reward',
        ];

        return view('admin.manage-reward', compact('data'));
    }

    public function adminUserLog()
    {
        $data = [
            'title' => 'Admin User Log',
            'active' => 'admin-user-log',
        ];

        return view('admin.admin-user-logs', compact('data'));
    }

    public function apiDocumentation()
    {
        $data = [
            'title' => 'API Documentation',
            'active' => 'api-documentation',
        ];

        return view('admin.api-docs', compact('data'));
    }
    public function manageStaffs()
    {
        $data = [
            'title' => 'Manage Staffs',
            'active' => 'manage-staffs',
        ];

        return view('admin.manage-staffs', compact('data'));
    }
    public function processCustomerOrders()
    {
        $data = [
            'title' => 'Process Customer Orders',
            'active' => 'process-customer-orders',
        ];

        return view('admin.process-customer-orders', compact('data'));
    }

}
