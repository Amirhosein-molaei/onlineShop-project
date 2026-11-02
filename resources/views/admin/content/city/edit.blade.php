@extends('admin.layouts.master')
@section('title', 'ویرایش شهر')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش شهر
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.city.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.city.update', $city) }}" method="post" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="نام" value="{{ old('name', $city->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="province_id" class="form-label">استان</label>
                            <select name="province_id" id="province_id" class="form-control">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @if ($province->id == $city->province->id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
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