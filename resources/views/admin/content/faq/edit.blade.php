@extends('admin.layouts.master')
@section('title', 'ویرایش سوال')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش سوال
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.faq.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.faq.update', $faq) }}" method="post" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <label for="question" class="form-label">سوال</label>
                            <input type="text" name="question" id="question" class="form-control" placeholder="سوال" value="{{ old('question', $faq->question) }}">
                            @error('question')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="answer" class="form-label">پاسخ</label>
                            <input type="text" name="answer" id="answer" class="form-control" placeholder="پاسخ" value="{{ old('answer', $faq->answer) }}">
                            @error('answer')
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