@extends('admin.layouts.master')
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('admin-assets/persiandatepicker/persian-datepicker.min.css') }}">
@endsection
@section('title', 'ساخت کد تخفیف')

@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت کد تخفیف
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.market.copan.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.market.copan.store') }}" method="post" class="row g-3">
                        @csrf

                        <div class="col-md-6 mb-2">
                            <label for="code" class="form-label">کد</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="کد"
                                value="{{ old('code') }}">
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="status" class="form-label">وضعیت</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
                                <option value="0" @if (old('status') == 0) selected @endif>غیر فعال</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="amount" class="form-label">مقدار</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="مقدار"
                                value="{{ old('amount') }}">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="amount_type" class="form-label">نوع مقدار</label>
                            <select name="amount_type" id="amount_type" class="form-control">
                                <option value="1" @if (old('amount_type') == 1) selected @endif>تومان</option>
                                <option value="0" @if (old('amount_type') == 0) selected @endif>درصد</option>
                            </select>
                            @error('amount_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="discount_ceiling" class="form-label">سقف تخفیف</label>
                            <input type="number" name="discount_ceiling" id="discount_ceiling" class="form-control"
                                placeholder="مقدار" value="{{ old('discount_ceiling') }}">
                            @error('discount_ceiling')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="start_date" class="form-label">تاریخ شروع</label>
                            <input type="text" name="start_date" id="start_date" class="form-control d-none" value="{{ old('start_date') }}">
                            <input type="text" id="start_date_view" class="form-control" placeholder="تاریخ شروع">
                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="end_date" class="form-label">تاریخ پایان</label>
                            <input type="text" name="end_date" id="end_date" class="form-control d-none" value="{{ old('end_date') }}">
                            <input type="text" id="end_date_view" class="form-control" placeholder="تاریخ پایان">
                            @error('end_date')
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
@section('scripts')
    @parent
    <script src="{{ asset('admin-assets/persiandatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/persiandatepicker/persian-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#start_date_view').persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            altField: '#start_date'
        });

        $('#end_date_view').persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            altField: '#end_date'
        });
    </script>
@endsection
