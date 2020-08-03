<div class="modal fade" id="customerModalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleCustomerModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      
      <div id="message"></div>
      <form id="formEvent">

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">開始時間</label>
        <div class="col-sm-8">
        <input type="text" name="start" class="form-control date-time" id="c-start" readonly>
        <input type="hidden" name="id,confirmed">
        </div>
        </div>

        <p id="id-html"></p>
       

        <div class="form-group row">
        <label for="nailist" class="col-sm-4 col-form-label">ネイリスト</label>
        <div class="col-sm-8">
        <select  name="nailist_id" class="form-control" id="c-nailist_id" >
        <option disabled selected value>選択してください</option>

        @foreach ( $nailists as $nailist )
        @if ( $nailist->id == 5)
        @continue
        @endif
　　　　        <option  value="{{ $nailist->id }}" >{{ $nailist->name }}<span >　　　+ ¥{{$nailist->price}}</span></option>

        
        @endforeach
       
        
        </select>
        </div>
        </div>

        <div class="form-group row">
        <label for="menu" class="col-sm-4 col-form-label">メニュー</label>
        <div class="col-sm-8">
        <select  name="menu_id" class="form-control" id="c-menu_id" >
        <option disabled selected value>選択してください</option>

        @foreach ( $menus as $menu )
　　　　        <option  value="{{ $menu->id }}" >{{ $menu->name }}<span >　　　+ ¥{{$menu->price}}</span></option>
        @endforeach
        </select>
        </div>
        </div>

        <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>
        <div class="col-sm-8">
        <input type="text" name="name" class="form-control" id="c-name" >
        
        </div>
        </div>

        <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-sm-8">
        <input type="text" name="email" class="form-control" id="c-email" >
        </div>
        </div>
        
        <div class="form-group row">
        <label for="tel" class="col-sm-4 col-form-label">電話番号</label>
        <div class="col-sm-8">
        <input type="text" name="tel" class="form-control" id="c-tel" >
        </div>
        </div>


       
        
        <div class="form-group row">
        <label for="note" class="col-sm-4 col-form-label">ご要望</label>
        <div class="col-sm-8">
        <textarea id="c-note" name="note" cols="35" rows="4" ></textarea>
        </div>
        </div>
        </form>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
      <button type="button" class="btn btn-primary saveCustomerEvent" >登録</button>

        
      </div>
    </div>
  </div>
</div>