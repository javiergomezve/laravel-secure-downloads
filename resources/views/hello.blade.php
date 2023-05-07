@extends('layouts.app')

@section('content')
    <div class="components">
        <div class="hello">
            <h2>Hello.vue</h2>

            <hello-component></hello-component>
        </div>

        <div class="world">
            <h3>World.vue</h3>

            <world-component></world-component>
        </div>
    </div>
@endsection
