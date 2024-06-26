<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Offer;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::latest()->paginate(5);
     //   dd($reviews);

        return view('moderator.reviews.index', compact('reviews'))
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

    public function store(StoreReviewRequest $request, Offer $offer)
    {
        $user = auth()->user();
        $text = $request->input('text');

        $review = new Review();
        $review->text = $text;
        $review->user_id = $user->id;
        $review->offer_id = $offer->id;
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->route('offers.show', $offer->id);
    }

    public function show(Review $review): View
    {
        return view('moderator.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('success','Atsiliepimas sėkmingai ištrintas');
    }
}
