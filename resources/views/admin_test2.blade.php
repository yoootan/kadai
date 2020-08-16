
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Vue.js</title>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin_index') }}">
                    {{ config('app.name', 'ネイルサロン予約システム') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/admin_edit">
                                        {{ __('管理者情報') }}
                                    </a>
                                <a class="dropdown-item" href="/admin_test2">
                                        {{ __('シフト管理') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                   

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
<div class="container">
<div id="app">

<th colspan="2"><a href="<?php $_SERVER['SCRIPT_NAME'];?>?date=<?php echo $pre_week;?>">&laquo; 前週</a></td>
<th colspan="3"><?php echo $year;?> 年 <?php echo $month;?> 月</td>
<th colspan="2"><a href="<?php $_SERVER['SCRIPT_NAME'];?>?date=<?php echo $next_week;?>">次週 &raquo;</a></td>
<table id="show_table_contents" class="table table-bordered">
<thead>
<tr>

</tr>
<tr>

<td></td>

<td>月</td>
<td>火</td>
<td>水</td>
<td>木</td>
<td>金</td>
<td>土</td>
<td>日</td>
</tr>
<tr>
<td></td>
<?php echo $table;?>
</tr>
  </thead>
  <tbody id="show_table_contents_tbody">
          <tr is="nailist-table" v-for="(nailist,index) in nailists" 
          v-bind:nailist="nailist" v-bind:key="nailist.id" v-bind:index="index"
          v-on:from-child2="deleteRow"></tr>
        </tbody>
  </table>
  <h3>表示エリア</h3>
  <p>選択した色 <span id="span4"></span></p>

  </div>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    
    $("#shift").change(function() {
		// value値を取得
		const str1 = $("#shift").val();
		$("#span4").text(str1);
	});
    

  






function RowColChange() {
 // ====================================================
 //  選択された行と列の値を取得し入力域に設定する
 // ====================================================
  var objInRow  = document.getElementById('rewriteRow');
  var objInCol  = document.getElementById('rewriteCol');
  var objInText = document.getElementById('rewriteText');
  var objTable  = document.getElementById('tableArea');
  var wRow = objInRow.options[objInRow.selectedIndex].value;
  var wCol = objInCol.options[objInCol.selectedIndex].value;
  objInText.value = objTable.rows[wRow].cells[wCol].innerHTML;
  objInText.focus();
  objInText.select();
}
function goRewrite() {
 // ====================================================
 //  指定されたセルを書き換える
 // ====================================================
  var objInRow  = document.getElementById('rewriteRow');
  var objInCol  = document.getElementById('rewriteCol');
  var objInText = document.getElementById('rewriteText');
  var objTable  = document.getElementById('tableArea');
  var wRow = objInRow.options[objInRow.selectedIndex].value;
  var wCol = objInCol.options[objInCol.selectedIndex].value;
  objTable.rows[wRow].cells[wCol].innerHTML = objInText.value;
}

Vue.component('nailist-table',{
  template : `<tr>
                 <td v-if="!isName" v-on:dblclick="isName=true">@{{ nailist.name }}</td>
                 <td v-else><input type="text" class="form-control" v-model="nailist.name" v-on:blur="updateName2(nailist.id,nailist.name)"></td>
                 <td><select>
                         <option value="1" selected>休み</option>
                       </select></td>
                 <td v-for="n in 6"><select id="shift"><option value="0">出勤</option>
                         <option value="1">休み</option>
                         <option value="2">朝番</option>
                         <option value="3">遅番</option></select></td>
      
                 </tr>`,
props : ['nailist','index'],
methods: {
    deleteRow : function(id,index){
        axios.delete('http://127.0.0.1:8000/api/nailists/' + id)
        .then((response) => {
            this.$emit('from-child2',index)
        }).catch((error) =>{
            console.log(error)
        })
    },
    updateName2 : function(id,name){
    axios.patch('http://127.0.0.1:8000/api/nailists/' + id, {id : id, name: name})
    .then((response) => {
        this.isName = false
      }).catch((error) =>{
        console.log(error)
      })
},
    updatePrice : function(id,price){
    axios.patch('http://127.0.0.1:8000/api/nailists/' + id, {id : id, price: price})
    .then((response) => {
        this.isPrice = false
      }).catch((error) =>{
        console.log(error)
      })
},
    
},
data: function(){
    return {
      isName : false,
      isPrice : false
    }
}
});


var app = new Vue({
  el: '#app',
  data: {
    nailists: []
  },
  mounted: function(){
    axios.get('http://127.0.0.1:8000/api/nailists').then(response => this.nailists = response.data);
  },

methods: {
	deleteRow : function(index){
    this.$delete(this.nailists,index)
	}
},
})


</script> 


