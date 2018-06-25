<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewStoreRequest;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param ReviewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewStoreRequest $request)
    {
        $this->authorize('create', Review::class);

        $user = Auth::user();
        $review = Review::createFromRequest($user, $request->all());
        $request->session()->flash('status', 'Review Added');
        return redirect()->route('restaurants.show', ['restaurant' => $review->restaurant_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReviewUpdateRequest  $request
     * @param  \App\Review  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewUpdateRequest $request, Review $review)
    {
        $this->authorize('update', $review);

        $user = Auth::user();
        $review->updateFromRequest($user, $request->all());
        $request->session()->flash('status', 'Review Updated');
        return redirect()->route('restaurants.show', ['restaurant' => $review->restaurant_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
