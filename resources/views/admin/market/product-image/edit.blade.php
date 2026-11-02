@extends('admin.layouts.master')
@section('title', 'ویرایش تصویر')

@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش تصویر
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.market.product-image.index', $product) }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.market.product-image.update', [$product, $productImage]) }}" method="post" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <label for="image">تصویر</label>
                            <br>
                            <input type="file" name="image" id="image" class="form-file-control">
                            <br>
                            <img src="{{ asset($productImage->image) }}" alt="" class="mt-2">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
