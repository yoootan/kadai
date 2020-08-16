@extends('layouts.app')
@section('content')
@if ($cancelEvents->isEmpty())
<div class="container">

<h2> {{$start}} 予約一覧</h2>
<div class="non-reserved">
<h4>キャンセル予約はまだありません</h4>
</div>
<a href="/admin_index" class="btn btn-secondary">戻る</a>

</div>
</div>

@else


<div class="container">

<h2> {{$start}} キャンセル待ち一覧</h2>
   @foreach($cancelEvents as $c) 
    <div class="card" >
  <div class="card-header">
  
    お名前　　　　　　　{{ $c->name }}様
   
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">メールアドレス　　　{{ $c->email}}</li>
    <li class="list-group-item">電話番号　　　　　　{{ $c->tel}}</li>
    <li class="list-group-item">メニュー　　　　　　{{ $c->menu->name}}</li>
  </ul>
</div>

@endforeach
<a href="/admin_index" class="btn btn-secondary">戻る</a>

</div>
@endif

@endsection

<style scoped>
.card{
    margin-top: 10px;
}
h2{
    text-align:center;
}
.non-reserved{
    text-align:center;
    margin-top:30px;
}
.btn{
    margin-top:10px;
    float:right;
}
</style>