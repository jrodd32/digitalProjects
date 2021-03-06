
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: 100;
    height: 100vh;
    margin: 0;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    font-size: 84px;
}

.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}

.m-b-md {
    margin-bottom: 30px;
}
</style>

@extends('layouts.app')

@section('content')
<div class="content">
    <div class="title m-b-md">
        Doe-Anderson Digital
    </div>
    @if (Auth::check())
    <div class="container">

        Welcome {{ Auth::user()->name }}. You currently have access to:
        <div class="links">
            <a href="{{ url('/goals') }}">Goals</a> |
            <a href="{{ url('/profile') }}">Profile</a>
        </div>

        <!-- Passport Clients:
        <passport-clients></passport-clients>

        Passport Authorized Clients:
        <passport-authorized-clients></passport-authorized-clients>

        Passport Personal Access Tokens:
        <passport-personal-access-tokens></passport-personal-access-tokens> -->
    </div>
    @else
        You are not signed in. We current support <a href="{{ url('/auth/basecamp') }}">logging in with Basecamp</a>. More providers will be coming soon.
    @endif
</div>
@endsection