@extends('admin.layouts.master')
@section('title', 'تنظیمات')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            تنظیمات
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.setting.') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.setting.set.store') }}" method="post" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="عنوان" value="{{ old('title', $setting->title ?? '') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea name="description" id="description" cols="100" rows="5" class="form-control">{{ old('description', $setting->description ?? '') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="keywords" class="form-label">کلمات کلیدی</label>
                            <textarea name="keywords" id="keywords" cols="100" rows="5" class="form-control">{{ old('keywords', $setting->keywords ?? '') }}</textarea>
                            @error('keywords')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="logo">لوگو</label>
                            <input type="file" name="logo" id="logo" class="form-control-file">
                            @if ($setting->logo)
                                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->title }}" class="mt-2">
                            @endif
                            @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="icon">آیکون</label>
                            <input type="file" name="icon" id="icon" class="form-control-file">
                            @if ($setting->icon)
                            <img src="{{ asset($setting->icon) }}" alt="{{ $setting->title }}" class="mt-2">
                            @endif
                            @error('icon')
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