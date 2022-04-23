<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SendInformationRequest;
use App\Http\Requests\StoreDecisionRequest;
use App\Http\Requests\UpdateConflictStatusRequest;
use App\Mail\Conflicts\InformationRequested;
use App\Mail\Conflicts\NewConflictUser;
use App\Models\Conflict;
use App\Models\ConflictHistory;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ModeratorController extends Controller
{

    public function getConflicts(): View
    {
        $user = Auth::user();
        $conflicts = Conflict::latest()->with('conflictOrders')->paginate(5);
        if ($user->role === 2) {
            $conflicts = Auth::user()->resolvedConflicts()->with('conflictOrders')->paginate(5);
        }

        return view('moderator.conflicts.index', compact('conflicts'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function showConflict(Conflict $conflict): View
    {
       // $conflict = $conflict->with('conflictOrders', 'files', 'additionalInfo')->first();
        //$conflict = $conflict->with('conflictOrders');
        ConflictHistory::create([
            'details' => 'Skundas buvo perziuretas',
            'user_id' => Auth::user()->id,
            'conflict_id' => $conflict->id
        ]);

        return view('moderator.conflicts.show', compact('conflict'));
    }

    public function storeConflict(UpdateConflictStatusRequest $request)
    {
        $data = $request->validated();

    }

    public function openInformationRequest(Conflict $conflict): View
    {
        return view('moderator.conflicts.information_request', compact('conflict'));
    }

    public function sendInformationRequest(SendInformationRequest $request, Conflict $conflict)
    {
        $data = $request->validated();
        $user = Auth::user();
        ConflictHistory::create([
            'details' => 'Informacijos užklausa buvo išsiųsta',
            'user_id' => $user->id,
            'conflict_id' => $conflict->id
        ]);


        $token = Token::create([
            'user_id' => User::where('email', $data['user'])->first()->id,
            'token' => base64_encode(md5($data['user'] . $conflict->id . rand(15,100))),
            'conflict_id' => $conflict->id
        ]);

        Mail::to($data['user'])->send(new InformationRequested('http://localhost/submit/' . $token->token . '/information'));

        $conflict->update([
            'status' => 2
        ]);

        return redirect()->route('moderator.conflicts')->with('success', 'Informacijos užklausa sėkmingai išsiųsta');
    }

    public function openConflictResolveForm(Conflict $conflict): View
    {
        return view('moderator.conflicts.resolve', compact('conflict'));
    }

    public function saveDecision(StoreDecisionRequest $request, Conflict $conflict)
    {
        $data = $request->validated();

        $user = Auth::user();
        ConflictHistory::create([
            'details' => 'priėmė sprendimą',
            'user_id' => $user->id,
            'conflict_id' => $conflict->id
        ]);

        $conflict->update([
            'status' => 4,
            'decision' => $data['decision'],
        ]);

        return redirect()->route('moderator.conflicts')->with('success', 'Skundas išspręstas');
    }

}
