<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Conflict;
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
        return view('moderator.conflicts.show', compact('conflict'));
    }

}
