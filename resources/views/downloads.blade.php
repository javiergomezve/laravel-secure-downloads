@extends('layouts.app')

@section('content')
    <downloads-component
        :contracts="{{ json_encode($contracts) }}"
    ></downloads-component>
@endsection
