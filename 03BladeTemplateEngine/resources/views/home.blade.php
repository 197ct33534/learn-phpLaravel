<h1>đây là trang home</h1>
{{-- <h2><?= // $welcom;?></h2> --}}

<h2>{{$welcom}}</h2>

{{-- xẩy ra lỗi xss
<h3><?=request()->keyword;?></h3> --}}

<h3>{{request()->keyword ? request()->keyword :"không có gì"}}</h3>

<div class="container">
    {!!  !empty($content) ?$content :"không có gì"!!}
</div>

<hr>
@for($i = 1;$i<=3;$i++)
    @if ($i === 2)
        @break
    @endif
    <p>vòng for thứ  {{$i}}</p>
@endfor


<hr>
@while ($index <=3)
    <p>vòng while thứ {{$index}}</p>
    @php
        $index++;
    @endphp
@endwhile

<hr>
@foreach ($arrData as $key=> $item)
    <p>foreach thứ  {{$key}}: {{$item}}</p>

@endforeach

<hr>
@forelse ($arrData   as $key=> $item)
    <p>forelse thứ  {{$key}}: {{$item}}</p>

@empty
    <p>không có phần tử nào</p>
@endforelse
<hr>
@if ($number > 0)
    <p>đây là số dương {{$number}}</p>
@elseif($number > 0)
    <p>đây là số âm {{$number}}</p>
@else
    <p>đây là số không chẵn không lẻ: {{$number}}</p>

@endif

<hr>
@switch($date)
    @case(1)
        <p>chủ nhất</p>
        @break
    @case(2)
        <p>thứ 2</p>
        @break
    @default
    <p>là 1 thứ j đó</p>
@endswitch
