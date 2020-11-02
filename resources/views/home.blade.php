@extends('layouts.user_layout')

@section('content')
	@include('layouts.includes.home_pic')
    @auth
	@include('layouts.includes.mycourses')
    @endauth
    @include('layouts.includes.track_famous_courses')
@endsection
