@include('customer_app')
<body>

@include('cancel-finish-modal-calendar')

<div class="container">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >キャンセル予約完了</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">
      
      <div id="message">

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">日時</label>
        <div class="col-sm-8">
        {{ $event->start }}
       
        </div>
        </div>

        <div class="form-group row">
        <label for="menu" class="col-sm-4 col-form-label">メニュー</label>
        <div class="col-sm-8">
        {{ $menu->name }}
     
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

    $("#cancelfinishModalCalendar").modal('show');

}
</script>