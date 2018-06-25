<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Restaurant;
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
        return Auth::user()->restaurants()->with('reviews')->where('name','LIKE','%'.$term.'%')->limit(5);//make sure these restaurants HAVE reviews
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Auth::user()->restaurants()->paginate(5);

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create');

        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RestaurantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantStoreRequest $request)
    {
        $this->authorize('create');

        $user = Auth::user();
        $restaurant = Restaurant::createFromRequest($user, $request->all());
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

        return view('restaurants.show', compact('restaurant'));
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
        return redirect()->route('restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RestaurantDestroyRequest $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete(RestaurantDestroyRequest $request, Restaurant $restaurant)
    {
        $this->authorize('delete', $restaurant);

        $restaurant->delete();
        flash('Restaurant Deleted');
        return redirect()->route('restaurants.index');
    }
}
