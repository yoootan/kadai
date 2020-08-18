<div class="modal fade" id="customerModalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="titleCustomerModal"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     
      <div class="modal-body" id="cancel">
      <div id="message"></div>

      <form action="/customer_cancel" method="get">
      @csrf
      <div id="message"></div>
      <div id="formEvent">
      <input type="hidden" name="id">
      <input type="hidden" name="start">

               
            <div class="form-group row">
              <label for="start" class="col-sm-4 col-form-label">開始時間</label>
              <div class="col-sm-8">
              <p id="start-html"></p>
              </div>
              </div>
      
      
            <div class="form-group row">
              <label for="situation" class="col-sm-4 col-form-label">受付状況</label>
              <div class="col-sm-8">
              <p id="situation-html"></p>
              </div>
              </div>
      
            <div class="form-group row">
              <label for="title" class="col-sm-4 col-form-label">空き状況</label>
              <div class="col-sm-8">
              <p id="title-html"></p>
              </div>
              </div>
            
          
            <div   class="modal-footer" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <input  type="submit" class="btn btn-primary" value="キャンセル待ち予約">
            </div>
           
            </div>
      
      </form>
    
      </div>

      <div class="modal-body" id="can">
      <div id="message2"></div>

      <form action="/customer_create" method="get">
      @csrf
      <div id="message2"></div>
      <div id="formEvent2">
      <input type="hidden" name="id">
      <input type="hidden" name="start">

               
            <div class="form-group row">
              <label for="start" class="col-sm-4 col-form-label">開始時間</label>
              <div class="col-sm-8">
              <p id="startCancel-html"></p>
              </div>
              </div>
      
      
            <div class="form-group row">
              <label for="situation" class="col-sm-4 col-form-label">受付状況</label>
              <div class="col-sm-8">
              <p id="situation2-html"></p>
              </div>
              </div>
      
            <div class="form-group row">
              <label for="title" class="col-sm-4 col-form-label">空き状況</label>
              <div class="col-sm-8">
              <p id="title2-html"></p>
              </div>
              </div>
          
           
            </div>
            <div   class="modal-footer" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <input  type="submit" class="btn btn-primary" value="次へ">
            </div>
      
      </form>
      </div>
      <div class="modal-body" id="stop">
      <div id="message3"></div>

      <form action="/customer_create" method="get">
      @csrf
      <div id="message2"></div>
      <div id="formEvent2">
      <input type="hidden" name="id">
      <input type="hidden" name="start">

               
            <div class="form-group row">
              <label for="start" class="col-sm-4 col-form-label">開始時間</label>
              <div class="col-sm-8">
              <p id="startStop-html"></p>
              </div>
              </div>
      
      
            <div class="form-group row">
              <label for="situation" class="col-sm-4 col-form-label">受付状況</label>
              <div class="col-sm-8">
              <p >受付終了</p>
              </div>
              </div>
      
            <div class="form-group row">
              <label for="title" class="col-sm-4 col-form-label">空き状況</label>
              <div class="col-sm-8">
              <p>受付終了</p>
              </div>
              </div>
          
           
            </div>
            <div   class="modal-footer" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
      
      </form>
      </div>


            
          
            
    </div>
  </div>
</div>

