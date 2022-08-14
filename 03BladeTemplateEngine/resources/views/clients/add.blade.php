@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection


@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="{{ route('postadd') }}" method="POST" id="product-form">
        {{-- @if ($errors->any())
    <div class="alert alert-danger text-center">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif --}}
        {{-- @if ($errors->any())
    <div class="alert alert-danger text-center">
        {{ $errorMessage }}
    </div>
    @endif --}}


        <div class="alert alert-danger text-center msg" style="display:none;">

        </div>


        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input value="{{ old('name_product') }}" type="text" name="name_product" placeholder="tên sản phẩm...">

            <span style="color:red" class="error name_product_error"> </span>

        </div>
        <div class="mb-3">
            <label for="">giá sản phẩm</label>
            <input type="text" value="{{ old('price_product') }}" name="price_product" placeholder="giá sản phẩm...">

            <span style="color:red" class="error price_product_error"> </span>

        </div>
        <button type="submit" class="btn btn-primary">submit</button>
        @csrf

    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#product-form').on('submit', function(e) {
                e.preventDefault();
                let productName = $('input[name="name_product"]').val().trim();
                let productPrice = $('input[name="price_product"]').val().trim();
                let actionURL = $(this).attr('action');
                let csrfToken = $('input[name="_token"]').val();
                $('.error').text('');
                $.ajax({
                    url: actionURL,
                    type: 'POST',
                    data: {
                        name_product: productName,
                        price_product: productPrice,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                    },
                    error: function(error) {
                        let responseJSON = error.responseJSON.errors;
                        $('.msg').show();
                        console.log(responseJSON)
                        if (Object.keys(responseJSON).length > 0) {
                            $('.msg').text('Vui lòng kiểm tra lại dữ liệu !');
                            for (let key in responseJSON) {
                                $('.' + key + '_error').text(responseJSON[key][0]);
                            }
                        }

                    }
                })
            })
        })
    </script>
@endsection
