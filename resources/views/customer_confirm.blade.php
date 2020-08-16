@include('customer_app')
<body>
<div class="container">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >予約確認</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">
      
      <div id="message">
      <form method="post" action="/customer_update">
      @csrf

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">日時</label>
        <div class="col-sm-8 event-text">
        {{ $event->start->format('n月d日G時i分') }}〜
        <input type="hidden" value="{{ $event->id }}" name="id">
        <input type="hidden" value="{{ $event->start }}" name="start">

        <input type="hidden" name="id,confirmed,price,start">
        </div>
        </div>

        <div class="form-group row">
        <label for="menu" class="col-sm-4 col-form-label">メニュー</label>
        <div class="col-sm-8 event-text">
        {{ $menu->name }}
     
        </div>
        </div>

        <div class="form-group row">
        <label for="nailist" class="col-sm-4 col-form-label">ネイリスト</label>
        <div class="col-sm-8 event-text">
        @if($nailist == null)
        {{ 'おまかせ '}}
        @else
        {{ $nailist->name}}
        @endif
        </div>
        </div>
       



        <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>
        <div class="col-sm-8 event-text">
        {{ $event->name }}
        
        </div>
        </div>

        <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-sm-8 event-text">
        {{ $event->email }}
        </div>
        </div>
        
        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">電話番号</label>
        <div class="col-sm-8 event-text">
        {{ $event->tel }}
        </div>
        </div>

        <div class="form-group row">
        <label for="note" class="col-sm-4 col-form-label">ご要望</label>
        <div class="col-sm-8 event-text">
        <textarea style="border:none; id="c-note" name="note" cols="35" rows="4" readonly>{{ $event->note }}</textarea>
        </div>
        </div>

        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">合計金額</label>
        <div class="col-sm-8 event-text event-text">
        <input type="hidden" value="{{ $price }}" name="price">

        {{ $price }}円
        </div>
        </div>
       
        </div>
      

      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>    
      <input type="submit" class="btn btn-primary" value="完了">

      </form>

        
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</body>

<style>
.container{
    width:80%;
}
.modal-content{
    opacity: 0.9;
    margin-top:50px;
}
.event-text{
    padding-bottom:-15PX;
}

</style>