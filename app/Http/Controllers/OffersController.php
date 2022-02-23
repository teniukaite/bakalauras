<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Models\Offer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function index(): View
    {
        $offers = Offer::latest()->paginate(10);

        return view('offers.index',compact('offers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view ('offers.create');
    }

    public function store(StoreOffersRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($file = $request->file('file')) {
            $destinationPath = 'files/offers/';
            $name = $file->hashName();
            Storage::disk('local')->put($destinationPath.$name, $file);
            $data['file'] = $destinationPath.$name;
        }

        $data['freelancer_id'] = Auth::user()->id;

        Offer::create($data);

        return redirect()->route('offers.index')
            ->with('success','Pasiulymas sėkmingai sukurtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offers
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offers
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffersRequest  $request
     * @param  \App\Models\Offer  $offers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffersRequest $request, Offer $offers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offers)
    {
        //
    }
}
