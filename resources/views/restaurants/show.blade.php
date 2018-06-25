@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{route('restaurants.index')}}">List Restaurants</a> @can('update', $restaurant)- <a href="{{route('restaurants.edit', ['restaurant' => $restaurant])}}">Edit</a>@endcan @can('delete',$restaurant)- <a href="/restaurants/delete/{{$restaurant->id}}" class="delete" data-confirm="Really Delete Restaurant?">Delete</a>@endcan</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>{{$restaurant->name}}</h2>
                        {{$restaurant->description}}

                        @if(count($reviews) > 0)
                            <hr />
                            <h3>Reviews</h3>
                        @endif

                        @foreach($reviews as $review)
                            <div>
                                <strong>{{$review->title}} - {{$review->value}}/10</strong><br />
                                {{$user->name}}: {{$review->content}}<br />
                                {{$review->created_at}}
                            </div>
                        @endforeach

                        <form action="{{route('reviews.store')}}" method="POST">
                            @method('post')
                            @csrf
                            Review:<br />
                            <input class="form-control" type="text" name="title" placeholder="Title of Your Review" /><br />
                            <textarea class="form-control" name="content" placeholder="Your Review of Restaurant"></textarea><br />
                            <input class="form-control" type="text" name="value" placeholder="Your Rating: 1-10" /><br />

                            <input type="hidden" name="user_id" value="{{$user->id}}" />
                            <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}" />
                            <input class="form-control btn btn-primary" type="submit" name="submit" value="submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
