@extends('base')

@section('content')
    PUBLIC USER PAGE
{{$user->getNicknameOrName()}}
    {{$user->email}}
@endsection
