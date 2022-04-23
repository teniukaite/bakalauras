<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function landingPage()
    {
        $offers = Offer::with('cities')->get();

        return view('welcome', compact('offers'));
    }
}
