@extends('front.layouts.master')
@section('title',$category->name)
@section('content')


<div class="col-lg-8 col-md-9 mx-auto">
    @include('front\widgets\content-list')
</div>

@include('front\widgets\category')

@endsection