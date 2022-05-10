<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Messages\MailMessage;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Http\Service\RabbitMQ\RabbitSender;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class NewsletterController extends Controller
{
    protected RabbitSender $rabbitSender;

    public function __construct(RabbitSender $rabbitSender)
    {
        $this->rabbitSender = $rabbitSender;
    }

    public function index(): View
    {
        $newsletters = Newsletter::latest()->paginate(10);

        return view('newsletters.index',compact('newsletters'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('newsletters.create');
    }

    public function store(StoreNewsletterRequest $request): RedirectResponse
    {
        Newsletter::create($request->validated());

        return redirect()->route('newsletters.index')
            ->with('success','Naujienlaiškis sėkmingai sukurtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsletterRequest  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }

    public function generatePDF(Newsletter $newsletter) {
        $pdf = PDF::loadHTML($newsletter->content);

        return $pdf->save(public_path().'/uploads/pdf/'.$newsletter->name . '.pdf')->stream($newsletter->name . '.pdf');
    }

    public function sendPDF(Newsletter $newsletter)
    {
        $pdf = PDF::loadHTML($newsletter->content);

        $pdf->save(public_path().'/uploads/pdf/'.$newsletter->name . '.pdf')->stream($newsletter->name . '.pdf');

        $subscribers = User::where('subscribed', 1)->get();

        foreach($subscribers as $subscriber) {
            $this->rabbitSender->send(new MailMessage(new \App\Mail\Newsletter($newsletter->name), $subscriber->email));
        }

        return redirect()->route('newsletters.index')
            ->with('success','Naujienlaiškis sėkmingai išsiųstas');
    }
}
