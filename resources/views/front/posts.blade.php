@extends('front.layouts.master')
@section('title',$content->title)
@section('bg',$content->image)
@section('content')


<!-- Post Content -->

<div class="col-lg-8 col-md-9 mx-auto">

  {!!$content->content!!}
  <b class='float-right'>
    <p>Okunma Sayacı = {{$content->hit}}</p>
  </b>

</div>

@include('front\widgets\category')

@endsection