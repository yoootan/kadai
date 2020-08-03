<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div id="message"></div>
      <form id="formEvent">

      <div class="form-group row">
        <label for="reservations" class="col-sm-4 col-form-label">予約人数</label>
        <div class="col-sm-8">
        <p id="reservations-html"></p>
        </div>
        </div>

      
        <div class="form-group row">
        <label for="title" class="col-sm-4 col-form-label">title</label>
        <div class="col-sm-8">
        <input type="text" name="title" class="form-control" id="title" >
        <input type="hidden" name="id">

        </div>
        </div>

       

        <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">開始時間</label>
        <div class="col-sm-8">
        <input type="text" name="start" class="form-control date-time" id="start" >
        </div>
        </div>

      

       
        
    
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary deleteEvent">削除</button>
        <button type="button" class="btn btn-primary saveEvent">更新</button>
      </div>
    </div>
  </div>
</div>