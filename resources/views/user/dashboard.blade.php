@extends('user.layout.app')
@section('content')
@section('page_title','Dashboard')
@section('dashboard','active')
<h2>{{Auth::guard('web')->user()->name}}</h2>

@if (session('success'))
<div class="alert alert-success">{{(session('success'))}}</div>
@endif

@endsection