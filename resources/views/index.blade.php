<table>
@forelse ($apilogs->reverse() as $key => $log)
<tr>
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$log->method}}</td>
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$log->url}}</td>
<td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$log->response}}</td>
<td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$log->duration * 1000}}  ms</td>

</tr>


                                                @empty

                  @endforelse

</table>

