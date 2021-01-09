@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://picsum.photos/id/18/750/300')
@section('content')

<div class="col-lg-8 col-md-10 mx-auto">
           @if(session('success'))
           <div class="alert alert-success">
               {{session('success')}}

           </div>
           @endif 
           @if($errors->any())
           <div class="alert alert-danger">
               <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
               </ul>
           </div>
           @endif
        <p>Bizimle iletişime geçebilirsiniz.</p>
        <form  metod="post" action="{{route('contact_post')}}">
        @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Ad Soyad</label>
              <input type="text" value="{{old('name')}}" class="form-control" placeholder="Ad Soyad" name="name" required
                data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Adresi</label>
              <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email Adresiniz" name="email" required
                data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Konu</label>
              <select name="topic" class="form-control">
                  <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                  <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                  <option @if(old('topic')=="Genel") selected @endif>Genel</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mesajınız</label>
              <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" required
                data-validation-required-message="Please enter a message.">{{old('message')}}</textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" name="send">Gönder</button>
        </form>
      </div>
</div>


@endsection