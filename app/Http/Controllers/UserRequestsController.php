<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequestRequest;
use App\Models\Request;

class UserRequestsController extends Controller
{
    public function index()
    {
        $requests = auth()->user()->askedQuestions()->orderBy('id', 'DESC')->paginate(10);

        return view('user-requests.index', compact('requests'));
    }

    public function store(UserRequestRequest $request)
    {
        // Check if similar question already exists
        $question = Request::where('question', $request->question)->first();

        if ($question && $question->answer != null) {
            return redirect()->back()->with('error', 'Šio klausimo jau buvo klausta. Atsakymas: ' . $question->answer);
        }

        // Create new question
        $question = new Request();
        $question->question = $request->question;
        $question->askedBy_id = auth()->id();

        $question->save();

        return redirect()->back()->with('success', 'Klausimas pridėtas');
    }
}
