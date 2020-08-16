@include('layouts.vue_app')
    <div class="container">
        <div id="app">
        <h2 style="margin-top:30px;">スタッフ一覧</h2>
        <button v-on:click="openModal" style="float:right; margin-bottom:10px;">新規作成</button>
        <open-modal v-show="showContent" v-on:from-child="closeModal">
        <div>
        <h3>メニュー新規作成</h3>
       <form action="/admin_store_nailist" method="post">
       @csrf


       <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">ネイリスト名</label>
        <div class="col-sm-8">
        <input type="text" name="name" class="form-control"  >
        </div>
        </div>

      

       <input type="submit" class="btn btn-primary" value="登録">

       </form>

        
        </div>



        </open-modal>
      
        <table class="table table-bordered" >
   <thead>
    <tr>
      <th scope="col">ネイリスト名</th>
    </tr>
   </thead>
   <tbody>
    <tr v-for="nailist in nailists">
      <td>@{{ nailist.name }}</td>
        </form>
    </tr>
  
   </tbody>
            
            </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script>

            new Vue({
                el: '#app',
                data: {
                    nailists: {},
                    showContent:false,
                    name: '',
                   
                },
                mounted(){
                    var self = this;
                    var url = '/ajax/nailist';
                    axios.get(url).then(function(response){
                        self.nailists = response.data;
                    })
                },
                methods: {
                    openModal: function(){
                        this.showContent = true
                    },
                    closeModal: function(){
                        this.showContent = false
                    },
                    nailistCreate: function(name){
                        var menu = {
                            'name': this.name,
                        };
                        
                        axios.post('http://127.0.0.1:8000/api/nailist/' + {name: name})
                        .then((response) => {
                            console.log(res.data.name);

                        });
                    }
                    
                    
    
                }
            });

            Vue.component('open-modal',{
            template : `
                 <div id="overlay">
                 <div id="content">
                    <p><slot></slot></p>
                    <button v-on:click="clickEvent">close</button>
                </div>
                   
                </div>
                `,
                methods :{
                    clickEvent: function(){
                    this.$emit('from-child')
                    },
                   
                }
            })

        </script>
        <style>
                
        #overlay{
        /*　要素を重ねた時の順番　*/
        z-index:1;

        /*　画面全体を覆う設定　*/
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.5);

        /*　画面の中央に要素を表示させる設定　*/
        display: flex;
        align-items: center;
        justify-content: center;

        }
        #content{
            z-index:2;
            width:50%;
            padding: 1em;
            background:#fff;
        }
        </style>
    </body>
</html>