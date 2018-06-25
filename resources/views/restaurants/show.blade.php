@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{route('restaurants.index')}}">List Restaurants</a> @can('edit', $restaurant)- <a href="{{route('restaurants.edit')}}">Edit</a>@endcan @can('delete',$restaurant)- <a href="/restaurants/delete/{{$restaurant->id}}" class="delete" data-confirm="Really Delete Restaurant?">Delete</a>@endcan</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>{{$restaurant->name}}</h2>
                        {{$restaurant->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
