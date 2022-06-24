@extends('layouts.client')

@section('title')
    {{$title}}
@endsection


@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="" method="POST">
        <input type="text" name='ten'>

        <button type="submit">submit</button>
        @csrf
        @method('PUT')
    </form>
@endsection
