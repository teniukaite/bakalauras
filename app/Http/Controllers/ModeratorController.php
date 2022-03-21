<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConflictStatusRequest;
use App\Models\Conflict;
use App\Models\ConflictHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ModeratorController extends Controller
{

    public function getConflicts(): View
    {
        $conflicts = Auth::user()->resolvedConflicts()->paginate(5);

        return view('moderator.conflicts.index', compact('conflicts'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function showConflict(Conflict $conflict): View
    {
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

}
