@extends('base')

@section('content')
    @foreach($teams as $team)
    <div class="card text-center">
        <div class="card-header">
            {{$team->search_for}}
        </div>
        <div class="card-body">
            <h5 class="card-title">If Your grade : {{$team->accept_with_grade}} <br> My grade:{{$team->user_grade}}</h5>
            <p class="card-text">{{$team->short_description}}</p>
            <a href="#" class="btn btn-primary">Contact</a>
        </div>
        <div class="card-footer text-body-secondary">
            {{$team->created_at}}
        </div>
        <div class="px-4">
            <a href="{{route('team-search.create')}}">Зробити команду</a>
        </div>
    </div>
    @endforeach
@endsection
