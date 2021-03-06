@extends('layouts.app')
    @section('content')
  <div class="shift-contents">

    @if(session()->has('message'))
        <div class="alert alert-info mb-3">
            {{session('message')}}
        </div>
    @endif

    <div class="shift-list" style="text-align:center;">
    <h2 >シフト管理</h2>
    @if($year <= 2020 && $month <= 8)
        <h2><span style="font-size:large;"></span>{{ $year }}年{{ $month }}月<span style="font-size:large;"><a href="/admin_management?year={{$nextYear}}&month={{$nextMonth}}">次へ</a></span></h2>
    @else
        <h2><span style="font-size:large;"><a href="/admin_management?year={{$backYear}}&month={{$backMonth}}">前へ</a></span>{{ $year }}年{{ $month }}月<span style="font-size:large;"><a href="/admin_management?year={{$nextYear}}&month={{$nextMonth}}">次へ</a></span></h2>
    @endif
    </div>

    <form  action="/admin_management_store?year={{$year}}&month={{$month}}" method="post" style="text-align:center;">
    @csrf
        <select name="monthDay" >
            @for($i = 1; $i <= $dayEnd ; $i ++)

            <option value="{{$i}}">{{ $month }}月{{ $i }}日</option>
            @endfor
        </select>


        <select  name="nailist_id" >
            @foreach ( $nailists as $nailist )
            <option  value="{{ $nailist->id }}" >{{ $nailist->name }}</option>
            @endforeach
        </select>

        <select name="rest">
            <option value="0">出勤</option>
            <option value="1">休み</option>
            <option value="2">朝番(10-18)</option>
            <option value="3">遅番(12-20)</option>
        </select>

        <input type="submit">
            
    </form>
        <p style="text-align:center;">月曜日は定休日想定のため変更できません</p>

        <table class="table table-bordered">
          <thead>
            <tr>
                <td></td>
                @foreach($dates as $date)
                <td>{{ $date }}</td>
                @endforeach
            </tr>
            <tr>
                <td></td>
                @foreach(range(1,$dayEnd) as $number)
                <td>{{$number}}</td>
                @endforeach
            </tr>
          </thead>
          <tbody class="shift-tbody">
                @foreach($nailists_ids as $nailists_id)
              
              <tr>
             <td>{{ $nailists_id[1]}}</td>
           @for($i = 0 ; $i < $dayEnd ;$i ++)
           @if(  $shifts[$nailists_id[0]][$i]["shift"] == 0)
           <td style="background-color:lightblue;">出勤</td>
           @elseif( $shifts[$nailists_id[0]][$i]["shift"]== 1)
           <td  style="background-color:lightgray;">休み</td>
           @elseif( $shifts[$nailists_id[0]][$i]["shift"] == 2)
           <td style="background-color:lightpink;">早番</td>
           @elseif( $shifts[$nailists_id[0]][$i]["shift"] == 3)
           <td style="background-color:lightgreen;">遅番</td>
           @endif

           @endfor  
                </tr>
                @endforeach

          
         
          </tbody>
        </table> 









  </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='js/script.js'></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

<style>
.shift-contents{
    margin-left:20px;
}

.shift-list{
    margin-top:20px;
}
.shift-tbody tr td:hover{
   opacity:0.8;
}
.table{
    border-radius:6px;
}
</style>