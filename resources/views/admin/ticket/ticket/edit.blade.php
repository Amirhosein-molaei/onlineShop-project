@extends('admin.layouts.master')
@section('title', 'ویرایش تیکت')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش تیکت 
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.tickets.ticket.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.tickets.ticket.update', $ticket) }}" method="post" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 mb-2">
                            <label for="subject" class="form-label">عنوان</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="عنوان" value="{{ old('subject', $ticket->subject) }}" readonly>
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="category_id" class="form-label">دسته بندی</label>
                            <select name="category_id" id="category_id" class="form-control col-12">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{$category->id == $ticket->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="body" class="form-label">متن تیکت</label>
                            <textarea readonly name="body" id="body" cols="100" rows="10" class="form-control">{{ old('body', $ticket->body) }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="user" class="form-label">سوال کننده</label>
                            <input type="text" name="user" id="user" class="form-control" placeholder="عنوان" readonly value="{{ $ticket->user->name }}">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="reference_id" class="form-label">پاسخ دهنده</label>
                            <select name="reference_id" id="reference_id" class="form-control col-12">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->user->name }}</option>
                                @endforeach
                            </select>
                            @error('reference_id')
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