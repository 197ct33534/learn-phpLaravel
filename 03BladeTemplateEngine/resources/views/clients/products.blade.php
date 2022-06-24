@extends('layouts.client')
@section('title')
   {{ $title}}
@endsection
@section('content')
    @datetime("2021-06-24 12:45:30")
    <h1>sản phẩm</h1>
@endsection

{{-- @section('sidebar')
    mún thay thế thì bỏ @parent
    @parent
    <h3>product sidebar</h3>
@endsection --}}
@push('scripts')
    <script>
        console.log(456)
    </script>
@endpush
@push('scripts')
    <script>
        console.log(123)
    </script>
@endpush

@prepend('scripts')
    <script>
        console.log(0)
    </script>
@endprepend


