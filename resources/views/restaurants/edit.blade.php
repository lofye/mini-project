@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{route('restaurants.index')}}">List Restaurants</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('restaurants.update', ['restaurant' => $restaurant])}}" method="POST">
                                @method('put')
                                @csrf
                                <input class="form-control" type="text" name="name" value="{{$restaurant->name}}" placeholder="Name of Restaurant" /><br />
                                <textarea class="form-control" name="description" placeholder="Description of Restaurant">{{$restaurant->description}}</textarea><br />

                                <input type="hidden" name="user_id" value="{{$restaurant->user_id}}" />
                                <input class="form-control btn btn-primary" type="submit" name="submit" value="Save Changes" />
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
