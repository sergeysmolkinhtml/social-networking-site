@extends('base')

@section('content')

<form action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <input type="file" name="invoice">
    <button type="submit">
        Submit
    </button>
</form>

@endsection
