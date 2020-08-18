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

      <div class="form-group ">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>

        {{ $r->name }}
        <form action="{{ route('admin_reserved_delete', [$r->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="削除">
        </form>
        </div>
   
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> 
      <label for="menu" class="col-sm-4 col-form-label">ネイリスト</label>@if($r->nailist_id == null)おまかせ@else{{$r->nailist->name}}@endif
    </li>
    <li class="list-group-item"> 
      <label for="menu" class="col-sm-4 col-form-label">メニュー</label>{{$r->menu->name}}
    </li>
    <li class="list-group-item">  
      <label for="menu" class="col-sm-4 col-form-label">メールアドレス</label>{{ $r->email}}
    </li>
    <li class="list-group-item">   
     <label for="menu" class="col-sm-4 col-form-label">電話番号</label>{{ $r->tel}}
    </li>
    <li class="list-group-item">
      <label for="menu" class="col-sm-4 col-form-label">合計金額</label>{{ $r->price}}円
    </li>
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