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
            'facebook.com' => 'fab fa-facebook',
            'twitter.com' => 'fab fa-twitter',
            'instagram.com' => 'fab fa-instagram',
            'linkedin.com' => 'fab fa-linkedin',
            'github.com' => 'fab fa-github',
            'telegram.me' => 'fab fa-telegram',
            't.me' => 'fab fa-telegram',
            'behance.net' => 'fab fa-behance',
            'dribbble.com' => 'fab fa-dribbble',
            'youtube.com' => 'fab fa-youtube',
            'pinterest.com' => 'fab fa-pinterest',
            'whatsapp.com' => 'fab fa-whatsapp',
            'snapchat.com' => 'fab fa-snapchat',
            'tiktok.com' => 'fas fa-link',
        ];
        

        return view('dashboard.profile', compact('icons'));
    }
}
