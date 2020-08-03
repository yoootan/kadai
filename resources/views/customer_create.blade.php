@include('customer_app')
<body>
<div class="container">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >予約登録</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">


      
      <div id="message">
      <form method="post" action="/customer_store">
      @csrf
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

      <div class="form-group row">
        <label for="start" class="col-sm-4 col-form-label">日時</label>
        <div class="col-sm-8">
        {{ $event->start }}〜{{ $event->end}}
        <input type="hidden" value="{{ $event->start }}" name="start">
        <input type="hidden" name="id,confirmed">
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
        <label for="nailist" class="col-sm-4 col-form-label">ネイリスト</label>
        <div class="col-sm-8">
        <select  name="nailist_id" class="form-control" id="c-nailist_id" >
        <option disabled selected value>選択してください</option>
        <option value="">おまかせ</option>

        @foreach ( $nailists as $nailist )
      
        <option  value="{{ $nailist->id }}" >{{ $nailist->name }}<span >　　　+ ¥{{$nailist->price}}</span></option>
        @endforeach
        </select>
        </div>
        </div>
       

     

       

        <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">お名前</label>
        <div class="col-sm-8">
        <input type="text" name="name" class="form-control" id="c-name"  >
        
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
        <textarea id="c-note" name="note" class="form-control" rows="4" ></textarea>
        </div>
        </div>
       
        </div>
      

      <div class="modal-footer">
            <a id="btn" class="btn btn-secondary">キャンセル</a>

      <input type="submit" class="btn btn-primary" value="次へ">


      </form>

        
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</body>

<script>
var btn = document.getElementById('btn');
 
 btn.addEventListener('click', function() {
  
     res = window.confirm('入力内容は破棄されます。ページを移動してよろしいですか？');
     if( res == true ) {
        // OKなら移動
        window.location.href = "/customer_index";
    }
    else {
   
    }
  
 })
</script>

<style>
.container{
    width:80%;
}
.modal-content{
    opacity: 0.9;
    margin-top:50px;
}

#btn{
  color:white;
}
</style>