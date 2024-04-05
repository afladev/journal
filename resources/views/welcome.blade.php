@extends('layouts.app')

@section('content')
    <div class="h-screen flex items-center">
        <div class="w-full text-center text-9xl font-semibold text-gray-800">
            {{ config('app.name') }}
        </div>
    </div>
@endsection
