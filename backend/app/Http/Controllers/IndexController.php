<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
        ];

        return view('dashboard', compact('data'));
    }

    public function error()
    {
        $data = [
            'title' => 'Error',
            'active' => 'error',
        ];

        return view('error', compact('data'));
    }

    public function logoutLoading()
    {
        $data = [
            'title' => 'Logout Loading',
            'active' => 'logout-loading',
        ];

        return view('logout-loading', compact('data'));
    }

    public function notificationPage()
    {
        $data = [
            'title' => 'Notification',
            'active' => 'notification',
        ];

        return view('notification-page', compact('data'));
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'active' => 'profile',
        ];

        return view('profile', compact('data'));
    }

    public function privatePolicy()
    {
        $data = [
            'title' => 'Privacy Policy',
            'active' => 'privacy-policy',
        ];

        return view('privacy-policy', compact('data'));
    }

    public function redeemHistory()
    {
        $data = [
            'title' => 'Redeem History',
            'active' => 'redeem-history',
        ];

        return view('redeem-history', compact('data'));
    }

    public function redeemReward()
    {
        $data = [
            'title' => 'Redeem Reward',
            'active' => 'redeem-reward',
        ];

        return view('redeem-rewards', compact('data'));
    }

    public function termConditions()
    {
        $data = [
            'title' => 'Terms and Conditions',
            'active' => 'terms-conditions',
        ];

        return view('term-condition', compact('data'));
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'active' => 'login',
        ];

        return view('auth.login', compact('data'));
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'active' => 'register',
        ];

        return view('Auth.register', compact('data'));
    }

}

