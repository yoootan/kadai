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
      <form id="formEvent" action="/admin_reserved_show/{start}" method="get">


      <div class="form-group row">
        <p for="start" class="col-sm-5">開始時間</p>
        <div class="col-sm-7">
        <p id="start-html"></p>
        </div>
        </div>

        <div class="form-group row">
          <label for="title" class="col-sm-5 ">受付状況</label>
          <div class="col-sm-7">
          <p id="title-html"></p>
          <input type="hidden" name="id">
          <input type="hidden" name="start">
          </div>
        </div>

      <div class="form-group row">
        <label for="reservations" class="col-sm-5 ">予約人数</label>
        <div class="col-sm-4">
        <p id="reservations-html"></p>
        </div>
        <div class="col-sm-3">
        <input  type="submit"  name="reserved" value="詳細">
        </div>
        </div>
       
       


      <div class="form-group row">
        <label for="reservations" class="col-sm-5 ">キャンセル待ち人数</label>
        <div class="col-sm-4">
        <p id="waitings-html"></p>
        </div>
        <div class="col-sm-3">
        <input  type="submit"  name="cancel" value="詳細">
        </div>
        </div>

        </form>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
     
      </div>
    </div>
  </div>
</div>