@foreach($nailist as $n)
@foreach($nailist->events as $e)
{{ $n->name}}
@endforeach
@endforeach







<br>@foreach($reserved as $r)
{{ $r->start}}<br>
@endforeach
<br>
休みの日<br>@foreach($rests as $rest)
{<br>
@endforeach


<br><br>
<!--指定した時間を取得＋休憩＆予約済の時間を除去-->
{{ $nailist->name}}予約可能時間<br>

@foreach($nailist->events as $e)

@foreach($rests as $rest)
@if( $e->start >= $rest->start && $e->end <= $rest->end)
@break
@endif
@endforeach

@foreach($reserved as $r)
@if( $e->start == $r->start)
@break
@endif
@endforeach

@if( $e->start != $r->start)
@if( $e->start < $rest->start || $e->end > $rest->end)
{{ $e->title }}{{ $e->start }}-{{ $e->end}}

@endif
@endif



@endforeach






