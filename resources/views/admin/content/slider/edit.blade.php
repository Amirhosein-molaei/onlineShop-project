@extends('admin.layouts.master')
@section('title', 'ویرایش اسلایدر')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش اسلایدر
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.slider.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.slider.update', $slider) }}" method="post" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <label for="image">تصویر</label>
                            <br>
                            <input type="file" name="image" id="image" class="form-file-control d-block">
                            <img src="{{ asset($slider->image) }}" alt="" class="my-3 w-100">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="position" class="form-label">محل قرارگیری</label>
                            <select name="position" id="position" class="form-control col-12">
                                <option value="0" @if ($slider['position'] == 0) selected @endif>اسلایدر اصلی</option>
                                <option value="1" @if ($slider['position'] == 1) selected @endif>بالا سمت چپ اسلایدر اصلی</option>
                                <option value="2" @if ($slider['position'] == 2) selected @endif>پایین سمت چپ اسلایدر اصلی</option>
                            </select>
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