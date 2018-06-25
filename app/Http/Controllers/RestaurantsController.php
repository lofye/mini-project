<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantShowRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Http\Requests\RestaurantDestroyRequest;

class RestaurantsController extends Controller
{
    /**
     * Display a list of matching restaurants
     * @return jsonified collection
     */
    public function autocomplete(Request $request, $term)
    {
        //laravel auto-converts to JSON if you return a collection
        return Auth::user()->restaurants()->has('reviews')->with('reviews')->where('name','LIKE','%'.$term.'%')->limit(5)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Auth::user()->restaurants()->has('reviews')->paginate(5);

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Restaurant::class);

        $user_id = Auth::user()->id;
        return view('restaurants.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RestaurantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantStoreRequest $request)
    {
        $this->authorize('create', Restaurant::class);

        $user = Auth::user();
        $restaurant = Restaurant::createFromRequest($user, $request->all());
        $request->session()->flash('status', 'Restaurant Added');

        $request_data = $request->all();
        if(!empty($request_data['title']) && !empty($request_data['value']))
        {
            $request_data['restaurant_id'] = $restaurant->id;
            $review = Review::createFromRequest($user, $request_data);
        }

        return redirect()->route('restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $this->authorize('view', $restaurant);

        $reviews = $restaurant->reviews()->get();
        $user = $restaurant->user()->first();
        return view('restaurants.show', compact('restaurant','reviews','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);

        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RestaurantUpdateRequest  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantUpdateRequest $request, Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);

        $user = Auth::user();
        $restaurant->updateFromRequest($user, $request->all());
        $request->session()->flash('status', 'Restaurant Updated');
        return redirect()->route('restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Restaurant $restaurant)
    {
        $this->authorize('delete', $restaurant);

        $restaurant->delete();
        $request->session()->flash('status', 'Restaurant Deleted');
        return redirect()->route('restaurants.index');
    }
}
