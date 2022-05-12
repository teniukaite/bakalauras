<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Models\Offer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function index(): View
    {
        $offers = Offer::FreelancerOffers()->latest()->paginate(10);

        return view('freelancer.offers.index',compact('offers'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view ('freelancer.offers.create');
    }

    public function store(StoreOffersRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['freelancer_id'] = Auth::user()->id;
        $offer =  Offer::create($data);

        if ($files = $request->file('file')) {
            foreach ($files as $file) {
                $destinationPath = 'files/offers/';
                $name = $file->hashName();
                move_uploaded_file($file->getRealPath(), 'uploads/'.$destinationPath.$name);
                $fileData['file_path'] = 'uploads/'.$destinationPath.$name;
                $fileData['name'] = $name;
                $offer->files()->create($fileData);
            }
        }

        return redirect()->route('offers.index')
            ->with('success','Pasiulymas sėkmingai sukurtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show(Offer $offer)
    {
        return view('freelancer.offers.show', compact('offer'));
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

    public function list(): View
    {
        $offers = Offer::with(['files', 'cities'])->latest()->paginate(9);

        return view('freelancer.offers.list',compact('offers'))
            ->with('i', (request()->input('page', 1) - 1) * 9);
    }
}
