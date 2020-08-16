@extends('layouts.app')
@section('content')
@if( $event->reservations == 0)
<div class="container">
<h2> {{$start}} 予約一覧</h2>
<div class="non-reserved">
<h4>予約はまだありません</h4>
</div>
<a href="/admin_index" class="btn btn-secondary">戻る</a>

</div>

@else


<div class="container">

<h2> {{$start}} 予約一覧</h2>
   @foreach($reservedEvents as $r) 
    <div class="card" >
  <div class="card-header">
  
    お名前　　　　　　　{{ $r->name }}様
    <button id="delete_button" style="float:right;">削除</button>
   
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">ネイリスト　　　　@if($r->nailist_id == null)おまかせ@else{{$r->nailist->name}}@endif</li>
    <li class="list-group-item">メニュー　　　　　{{$r->menu->name}}</li>
    <li class="list-group-item">メールアドレス　　　{{ $r->email}}</li>
    <li class="list-group-item">電話番号　　　　　　{{ $r->tel}}</li>
    <li class="list-group-item">合計金額　　　　　　{{ $r->price}}円</li>
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

<script>

</script>