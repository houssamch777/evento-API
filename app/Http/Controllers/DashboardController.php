<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        return view('dashboard.dashboard');
    }
    public function profile()
    {
        $icons = [
            'facebook.com' => ['icon' => 'bxl-facebook', 'color' => 'border-facebook','bg-color' => 'bg-facebook'],
            'twitter.com' => ['icon' => 'bxl-twitter', 'color' => 'border-twitter', 'bg-color' => 'bg-twitter'],
            'instagram.com' => ['icon' => 'bxl-instagram', 'color' => 'border-instagram', 'bg-color' => 'bg-instagram'],
            'linkedin.com' => ['icon' => 'bxl-linkedin', 'color' => 'border-linkedin', 'bg-color' => 'bg-linkedin'],
            'github.com' => ['icon' => 'bxl-github', 'color' => 'border-github', 'bg-color' => 'bg-github'],
            'telegram.me' => ['icon' => 'bxl-telegram', 'color' => 'border-telegram', 'bg-color' => 'bg-telegram'],
            't.me' => ['icon' => 'bxl-telegram', 'color' => 'border-telegram', 'bg-color' => 'bg-telegram'],
            'behance.net' => ['icon' => 'bxl-behance', 'color' => 'border-behance', 'bg-color' => 'bg-behance'],
            'dribbble.com' => ['icon' => 'bxl-dribbble', 'color' => 'border-dribbble', 'bg-color' => 'bg-dribbble'],
            'youtube.com' => ['icon' => 'bxl-youtube', 'color' => 'border-youtube', 'bg-color' => 'bg-youtube'],
            'pinterest.com' => ['icon' => 'bxl-pinterest', 'color' => 'border-pinterest', 'bg-color' => 'bg-pinterest'],
            'whatsapp.com' => ['icon' => 'bxl-whatsapp', 'color' => 'border-whatsapp', 'bg-color' => 'bg-whatsapp'],
            'snapchat.com' => ['icon' => 'bxl-snapchat', 'color' => 'border-snapchat', 'bg-color' => 'bg-snapchat'],
            'tiktok.com' => ['icon' => 'bx-unlink', 'color' => 'border-tiktok', 'bg-color' => 'bg-tiktok'], // TikTok icon
        ];
        
        
        

        return view('user.profile', compact('icons'));
    }
}
