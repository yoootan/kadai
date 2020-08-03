@include('customer_app')
<body>
<div class="modal fade" id="customerModalCalendar2" tabindex="-1" role="dialog" aria-labelledby="titleModal2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleCustomerModal2"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div id="message"></div>
      <form id="formEvent2">

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">開始時間</label>
        <div class="col-sm-8">
        <p id="start-html"></p>
        <input type="hidden" name=" menu_id nailist_id start name email tel note confirmed">
   

        </div>
        </div>
       

        <div class="form-group row">
        <label for="nailist" class="col-sm-4 col-form-label">ネイリスト</label>
        <div class="col-sm-8">
        <p id="nailist_id-html"></p>

        </div>
        </div>

        <div class="form-group row">
        <label for="menu" class="col-sm-4 col-form-label">メニュー</label>
        <div class="col-sm-8">
        <p id="menu_id-html"></p>

        </div>
        </div>

       

        <input type="hidden" name="id">
        <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>
        <div class="col-sm-8">
        <p id="name-html"></p>
        
        </div>
        </div>

        <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-sm-8">
        <p id="email-html"></p>
        </div>
        </div>
        
        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">電話番号</label>
        <div class="col-sm-8">
        <p id="tel-html"></p>
        </div>
        </div>


       
        
        <div class="form-group row">
        <label for="note" class="col-sm-4 col-form-label">ご要望</label>
        <div class="col-sm-8">
        <p id="note-html"></p>
        </div>
        </div>

        <div class="form-group row">
        <label for="price" class="col-sm-4 col-form-label">合計金額</label>
        <div class="col-sm-8">
        <p id="price-html" ></p>
        </div>
        </div>
        </form>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"　onclick="location.reload()";>閉じる</button>
      <button type="button" class="btn btn-primary"  finishCustomerEvent">完了</button>



        
      </div>
    </div>
  </div>
</div>
</body>