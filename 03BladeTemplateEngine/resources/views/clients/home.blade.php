@extends('layouts.client')
@section('title')
   {{ $title}}
@endsection
@section('content')
    <h1>trang chủ</h1>
@endsection

@section('sidebar')
    {{-- mún thay thế thì bỏ @parent --}}
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('css')
<style type="text/css">
    header{
        background-color:#c3c3c3;
    }
</style>

@endsection

@section('js')
<script type="text/javascript">
      document.querySelector('.show').onclick = function() {
        alert('helo world')
    }
</script>

@endsection
