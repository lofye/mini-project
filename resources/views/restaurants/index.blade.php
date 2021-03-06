@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Restaurants @can('create', App\Restaurant::class)- <a href="{{route('restaurants.create')}}">Add</a>@endcan</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(count($restaurants) == 0)
                            You Have No Restaurants :(
                        @else
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th><th style="padding-left:2em;">Actions</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                @foreach($restaurants as $restaurant)
                                    <tr>
                                        <td><a href="{{route('restaurants.show', ['restaurant' => $restaurant->id])}}">{{$restaurant->name}}</a></td>
                                        <td style="padding-left:2em;">
                                            @can('update', $restaurant)<a href="{{route('restaurants.edit', ['restaurant' => $restaurant])}}">Edit</a>@endcan | @can('delete',$restaurant)<a href="/restaurants/delete/{{$restaurant->id}}" class="delete" data-confirm="Really Delete Restaurant?">Delete</a>@endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
