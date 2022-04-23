<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $loggedInUser = Auth::user();

        return view('admin.dashboard', compact('loggedInUser'));
    }

    public function getOffers()
    {
        $offers = Offer::latest()->with('cities', 'category')->paginate(5);

        return view('admin.offers.index', compact('offers'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function recommendOffer(Offer $offer)
    {
        $offer->recommended = true;
        $offer->save();

        return redirect()->back()->with('success', 'Pasiūlymas pažymėtas rekomenduotu.');
    }
}
