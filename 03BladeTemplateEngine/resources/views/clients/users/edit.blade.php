@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-warning">Vui lòng kiểm tra lại dữ liệu</div>
            @endif
            <h1>{{ $title }}</h1>

            <form action="{{ route('users.post_edit') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="họ và tên"></label>
                    <input type="text" class="form-control" name="fullname" placeholder="họ và tên"
                        value="{{ old('fullname') ?? $userDetail->fullname }}">
                    @error('fullname')
                        <span style="color:red">{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="Email"></label>
                    <input type="text" class="form-control" name="email" placeholder="Email.."
                        value="{{ old('email') ?? $userDetail->email }}">
                    @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">cập nhập</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning">Cancel</a>

            </form>
        </div>


    </section>
@endsection
