@extends('admin.layouts.master')
@section('title', 'ساخت بلاگ')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت بلاگ
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.blog.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.blog.store') }}" method="post" class="row g-3">
                        @csrf

                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="عنوان" value="{{ old('title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="body" class="form-label">بدنه اصلی</label>
                            <textarea name="body" id="body" cols="100" rows="10" class="form-control">{{ old('body') }}</textarea>
                            @error('body')
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