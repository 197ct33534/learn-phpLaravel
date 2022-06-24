@extends('layouts.client')
@section('title')
   {{ $title}}
@endsection
@section('content')
    <section>
        <div class="container">
            <h1>Trang Chủ</h1>
            @include('clients.content.slide')
            @include('clients.content.about')
        </div>
    </section>
@endsection

@section('sidebar')
    {{-- mún thay thế thì bỏ @parent --}}
    @parent
    <h3>Home sidebar</h3>
@endsection

