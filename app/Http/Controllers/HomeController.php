<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return redirect('/offers');
    }

    public function landingPage(): View
    {
        $offers = Offer::with('cities')->where('recommended', 1)->limit(9)->get();

        return view('welcome', compact('offers'));
    }
}
