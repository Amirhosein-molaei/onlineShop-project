@extends('admin.layouts.master')
@section('title', 'ویرایش محصول')

@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش محصول
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.market.product.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.market.product.update', $product) }}" method="post" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 mb-2">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="brand_id" class="form-label">برند</label>
                            <select name="brand_id" id="brand_id" class="form-control col-12">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @if ($product->brand_id == $brand->id) selected @endif>
                                        {{ $brand->persian_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="product_category_id" class="form-label">دسته بندی</label>
                            <select name="product_category_id" id="product_category_id" class="form-control col-12">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->product_category_id == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="tags" class="form-label">تگ ها</label>
                            <input type="text" name="tags" id="tags" class="form-control" placeholder="تگ ها"
                                value="{{ old('tags', $product->tags) }}">
                            @error('tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="status" class="form-label">وضعیت</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" @if (old('status',$product->status) == 1) selected @endif>فعال</option>
                                <option value="0" @if (old('status',$product->status) == 0) selected @endif>غیر فعال</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="marketable" class="form-label">وضعیت فروش</label>
                            <select name="marketable" id="marketable" class="form-control">
                                <option value="1" @if (old('marketable',$product->marketable) == 1) selected @endif>فعال</option>
                                <option value="0" @if (old('marketable', $product->marketable) == 0) selected @endif>غیر فعال</option>
                            </select>
                            @error('marketable')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea name="description" id="description" cols="100" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="image">تصویر</label>
                            <br>
                            <img src="{{ asset($product->image) }}" alt="" width="200" height="200">
                            <br>
                            <input type="file" name="image" id="image" class="form-file-control mt-2">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-2">
                            <label for="weight" class="form-label">وزن</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="وزن"
                                value="{{ old('weight', $product->weight) }}">
                            @error('weight')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-2">
                            <label for="length" class="form-label">طول</label>
                            <input type="number" name="length" id="length" class="form-control" placeholder="طول"
                                value="{{ old('length', $product->length) }}">
                            @error('length')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-2">
                            <label for="width" class="form-label">عرض</label>
                            <input type="number" name="width" id="width" class="form-control" placeholder="عرض"
                                value="{{ old('width', $product->width) }}">
                            @error('width')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-2">
                            <label for="height" class="form-label">ارتفاع</label>
                            <input type="number" name="height" id="height" class="form-control"
                                placeholder="ارتفاع" value="{{ old('height', $product->height) }}">
                            @error('height')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="price" class="form-label">قیمت</label>
                            <input type="number" name="price" id="price" class="form-control"
                                value="{{ old('price', $product->price) }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="marketable_number" class="form-label">موجودی انبار</label>
                            <input type="text" name="marketable_number" id="marketable_number" class="form-control" value="{{ old('marketable_number', $product->marketable_number) }}">
                            @error('marketable_number')
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
