@extends('admin.layouts.master')
@section('title', 'ساخت روش ارسال')

@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت روش ارسال
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.market.delivery.store') }}" method="post" class="row g-3">
                        @csrf

                        <div class="col-12 mb-2">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="نام"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="amount" class="form-label">مبلغ</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="مبلغ"
                                value="{{ old('amount') }}">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="delivery_time" class="form-label">زمان</label>
                            <input type="number" name="delivery_time" id="delivery_time" class="form-control" placeholder="زمان"
                                value="{{ old('delivery_time') }}">
                            @error('delivery_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="delivery_time_unit" class="form-label">واحد زمان</label>
                            <input type="text" name="delivery_time_unit" id="delivery_time_unit" class="form-control"
                                placeholder="واحد زمان" value="{{ old('delivery_time_unit') }}">
                            @error('delivery_time_unit')
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