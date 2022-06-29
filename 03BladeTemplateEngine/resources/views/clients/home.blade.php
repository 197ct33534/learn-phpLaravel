@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section>
        <div class="container">
            <h1>Trang Chủ</h1>
            @include('clients.content.slide')
            @include('clients.content.about')

            @env('local')
            <p>môi trường dev</p>
            @elseenv('production')
            <p>môi trường production</p>
        @else
            <p>không phải môi trường dev</p>
            @endenv
        </div>
        <x-alert dataIcon='times' type="success" content="chúc mừng bạn đã đặt hàng thành công" :chart="$chart" />
        {{-- <x-button /> --}}
        <x-inputs.button />
    </section>
@endsection

@section('sidebar')
    {{-- mún thay thế thì bỏ @parent --}}
    @parent
    <h3>Home sidebar</h3>
@endsection
