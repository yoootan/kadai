
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="/admin_shift">
                                        {{ __('シフト調整') }}
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
    <h2 style="margin-top:10px;">シフト変更</h2>

<div id="app">
    <table class="table table-bordered">
        <thead  class="thead-dark">
            <tr>
                <th>名前</th>
                <th>price</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
          <tr is="nailist-table" v-for="(nailist,index) in nailists" 
          v-bind:nailist="nailist" v-bind:key="nailist.id" v-bind:index="index"
          v-on:from-child2="deleteRow"></tr>
        </tbody>
    </table>
</div>
<p>・変更したい項目をWクリックで編集可能</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script>

Vue.component('nailist-table',{
  template : `<tr>
                 <td v-if="!isName" v-on:dblclick="isName=true">@{{ nailist.name }}</td>
                 <td v-else><input type="text" class="form-control" v-model="nailist.name" v-on:blur="updateName2(nailist.id,nailist.name)"></td>
                 <td v-if="!isPrice" v-on:dblclick="isPrice=true">@{{ nailist.price }}</td>
                 <td v-else><input type="text" class="form-control" v-model="nailist.price" v-on:blur="updatePrice(nailist.id,nailist.price)"></td>
   
                 
                 <td><button class="btn btn-danger" v-on:click="deleteRow(nailist.id,index)">削除</button></td>
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
