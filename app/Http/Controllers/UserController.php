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
            ->with('success','User created successfully.');
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
            ->with('success','User updated successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
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
            ->with('success','Points added successfully');
    }

    public function removePoints(PointsRequest $request, User $user): RedirectResponse
    {
        $points = $request->validated()['points'];
        $user->points -= $points;
        $user->save();

        return redirect()->route('users.index')
            ->with('success','Points removed successfully');
    }
}
