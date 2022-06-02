<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return redirect()->to('/my-profile')->with('error', 'Neteisingas senas slaptažodis');
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->to('/my-profile')->with('success', 'Slaptažodis sėkmingai pakeistas');
    }

    public function updateMyAccount(UpdateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
//        dd('test');
        $data = $request->validated();
//        dd($request->all());
        //$data = $request->all();
        $user = User::find(auth()->user()->id);
        $user->subscribed = 0;
        $user->save();
        if (isset($data['subscribed'])) {
            $user->subscribed = 1;
            $user->save();
        }

        $user->update($data);

        return redirect()->route('users.myAccount')
            ->with('success','Profilis atnaujintas sėkmingai');
    }
}
