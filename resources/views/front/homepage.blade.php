@extends('front.layouts.master')
@section('title','Ana Sayfa')
@section('content')


<div class="col-md-9 mx-auto">
  @foreach($content as $cont)
  <div class="post-preview">
    <a href="{{route('post',[ $cont->cat, $cont->slug])}}">
      <h2 class="post-title">
        {{$cont->title}}
      </h2>
      <img src="{{$cont->image}}">
      <h3 class="post-subtitle">
        {!!Str::limit($cont->content,150)!!}
      </h3>
    </a>
    <p class="post-meta">
      <span class="float-right">{{$cont->created_at->diffForHumans()}}, Category at <b>{{$cont->name}}</b></span></p>
  </div>
  @if(!$loop->last)
  <hr>
  @endif
  @endforeach
  <!-- Pager -->

  {{ $content->links() }}

</div>

@include('front\widgets\category')

@endsection