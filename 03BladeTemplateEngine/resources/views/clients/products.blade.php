@extends('layouts.client')
@section('title')
   {{ $title}}
@endsection
@section('content')
    <h1>sản phẩm</h1>
@endsection

@section('sidebar')
    {{-- mún thay thế thì bỏ @parent --}}
    @parent
    <h3>product sidebar</h3>
@endsection

@section('css')
<style type="text/css">
    header{
        background-color:pink;
    }
</style>

@endsection

