@extends('admin.layouts.master')
@section('title', 'ویرایش بلاگ')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش بلاگ
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.blog.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.blog.update', $blog) }}" method="post" class="row g-3">
                        @csrf
                        @method('PUT')
                        
                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="body" class="form-label">بدنه اصلی</label>
                            <textarea name="body" id="body" cols="100" rows="10" class="form-control">{{ old('body', $blog->body) }}</textarea>
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