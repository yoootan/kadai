@include('customer_app')
<body>

@include('finish-modal-calendar')

<div class="container">


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >予約完了</h5>
       
      </div>

<div class="modal-body">
      
      <div id="message">

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">日時</label>
        <div class="col-sm-8">
        {{ $event->start->format('n月d日G時i分') }}〜
       
        </div>
        </div>

        <div class="form-group row">
        <label for="menu" class="col-sm-4 col-form-label">メニュー</label>
        <div class="col-sm-8">
        {{ $menu->name }}
     
        </div>
        </div>

        <div class="form-group row">
        <label for="nailist" class="col-sm-4 col-form-label">ネイリスト</label>
        <div class="col-sm-8">
       
        @if($nailist == null)
        {{ 'おまかせ '}}
       @else
        {{ $nailist->name}}
        @endif
        </div>
        </div>
       

        <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>
        <div class="col-sm-8">
        {{ $event->name }}
        
        </div>
        </div>

        <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-sm-8">
        {{ $event->email }}
        </div>
        </div>
        
        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">電話番号</label>
        <div class="col-sm-8">
        {{ $event->tel }}
        </div>
        </div>

        <div class="form-group row">
        <label for="note" class="col-sm-4 col-form-label">ご要望</label>
        <div class="col-sm-8">
        <textarea style="border:none; id="c-note" name="note" cols="35" rows="4" readonly>{{ $event->note }}</textarea>
        </div>
        </div>
       
        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">合計金額</label>
        <div class="col-sm-8 event-text event-text">
        {{ $event->price }}円
        </div>
        </div>

        <div class="modal-footer">
        <a class="btn btn-secondary" href="/customer_index" >トップページへ</a>

        </div>
        </div>
       
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</body>

<style>

.modal-content{
    opacity: 0.9;
    margin-top:50px;
    
}
.modal-dialog{
  
}

</style>

<script>
window.onload = function() {

    $("#finishModalCalendar").modal('show');

}
</script>