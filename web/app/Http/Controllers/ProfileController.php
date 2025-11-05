<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $contentView = 'profile.avatar';
        $viewData = [
            'title' => 'Avatar',
            'contentView' => $contentView,
        ];
        return view('layouts.profile', $viewData);
    }

}
