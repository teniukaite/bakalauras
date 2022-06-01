<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PointsRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        //dd($search);
        $users = User::latest()->paginate(10);

        if ($search) {
            $users = User::where('name', 'like', "%{$search}%")
                ->orWhere('lastName', 'like', "%{$search}%")
                ->paginate(10);
        }


        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['password'] = Hash::make(Str::random(20));
        User::create($data);

        return redirect()->route('users.index')
            ->with('success','Naudotojas sukurtas sėkmingai');
    }

    public function show(User $user): View
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success','Naudotojas redaguotas sėkmingai.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','Naudotojas ištrintas sėkmingai');
    }

    public function myAccount(): View
    {
        $user = Auth::user();
        return view('users.myAccount', compact('user'));
    }

    public function addPoints(PointsRequest $request, User $user): RedirectResponse
    {
        $points = $request->validated()['points'];
        $user->points += $points;
        $user->save();

        return redirect()->route('users.index')
            ->with('success','Taškai pridėti sėkmingai');
    }

    public function removePoints(PointsRequest $request, User $user): RedirectResponse
    {
        $points = $request->validated()['points'];
        $user->points -= $points;
        $user->save();

        return redirect()->route('users.index')
            ->with('success','Taškai pašalinti sėkmingai');
    }

    public function blacklist(): View
    {
        $users = User::withCount('receivedConflicts')->having('received_conflicts_count', '>', 2)->paginate(10);

        return view('users.blacklist',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function countPoints(): RedirectResponse
    {
        $points = 0;
        $freelancers = User::where('role', 1)->get();

        foreach ($freelancers as $freelancer) {
            $offers = $freelancer->offers;
            foreach ($offers as $offer) {
                $reviews = $offer->reviews;
                foreach ($reviews as $review) {
                    if ($review->created_at->diffInDays(now()) <= 7) {
                        $points += $review->points;
                        switch ($review->rating) {
                            case 2:
                            case 3:
                            case 1:
                                $points += 0;
                                break;
                            case 4:
                                $points += 1;
                                break;
                            case 5:
                                $points += 2;
                                break;
                        }
                    }
                }
            }

            $freelancer->points += $points;
            $freelancer->save();

            $points = 0;
        }

        return redirect()->route('users.index')
            ->with('success','Taškai suskaičiuoti ir priskirti sėkmingai');
    }

    public function getDeleted(): View
    {
        $users = User::onlyTrashed()->paginate(10);

        return view('users.deleted',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function showDeleted(User $user): View
    {
        return view('users.showDeleted',compact('user'));
    }
}
