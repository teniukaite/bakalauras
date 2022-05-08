<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::where('receiver_id', '=', Auth::user()->id)->latest()->paginate(10);

        return view('messages.index',compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('messages.create');
    }

    public function store(StoreMessageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['receiver_id'] = User::where('email', '=', $data['receiver_id'])->first()->id;
        $data['sender_id'] = Auth::user()->id;
        Message::create($data);

        return redirect()->route('messages.index')
            ->with('success','Pranešimas išsiųstas sėkmingai');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message): View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function showSentMessages(): View
    {
        $messages = Message::where('sender_id', '=', Auth::user()->id)->latest()->paginate(10);

        return view('messages.index',compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
