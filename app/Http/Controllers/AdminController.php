<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::all()->count();
        $freelancerCount = User::freelancerCount();
        $usersCount = User::userCount();
        $moderatorCount = User::moderatorCount();
        $adminCount = User::adminCount();
        $newUsers = User::newUsers();

        return view('admin.dashboard', compact(
            'userCount',
            'freelancerCount',
            'usersCount',
            'moderatorCount',
            'adminCount',
            'newUsers'
        ));
    }

    public function getOffers()
    {
        $offers = Offer::latest()->with('cities', 'categories')->paginate(5);

        return view('admin.offers.index', compact('offers'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function recommendOffer(Offer $offer)
    {
        $offer->recommended = true;
        $offer->save();

        return redirect()->back()->with('success', 'Pasiūlymas pažymėtas rekomenduotu.');
    }

    public function unrecommendOffer(Offer $offer)
    {
        $offer->recommended = false;
        $offer->save();

        return redirect()->back()->with('success', 'Pasiūlymas pašalintas iš rekomenduojamų.');
    }
}
