@extends('layouts.app')
@section('content')

<div class="container">

@if(session()->has('message'))
        <div class="alert alert-info mb-3">
            {{session('message')}}
        </div>
 @endif

<form method="post" action="/admin_update_caution">
@csrf
  <div class="form-group">
    <label for="text">注意事項編集</label>
    <textarea type="text" name="text" class="form-control" >{{old('text',$text)}}</textarea>
    <small id="emailHelp" class="form-text text-muted">100文字以内</small>
  </div>


  <button type="submit" class="btn btn-primary">変更</button>
</form>

</div>
@endsection