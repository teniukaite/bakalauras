<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RequestAnswerStoreRequest;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Models\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequestController extends Controller
{
    public function index(): View
    {
        $requests = Request::latest()->paginate(5);

        return view('requests.index',compact('requests'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestRequest $request)
    {
        //
    }

    public function show(Request $request): View
    {
        return view('requests.show',compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestRequest  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function answer(Request $request, RequestAnswerStoreRequest $answerStoreRequest): RedirectResponse
    {
        $data = $answerStoreRequest->validated();
        $request->update([
            'answer' => $data['answer'],
            'state' => 2,
            'answeredBy_id' => Auth::user()->id,
        ]);

        return redirect()->route('requests.index')
            ->with('success','Užklausa atsakyta sėkmingai');
    }
}
