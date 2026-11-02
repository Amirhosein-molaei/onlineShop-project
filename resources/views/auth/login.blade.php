@extends('auth.layouts.master')
@section('title', 'ورود / ثبت نام')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <section class="login-wrapper mb-5">
            <section class="login-logo">
                <img src="{{ asset('assets/images/logo/4.png') }}" alt="">
            </section>
            <section class="login-title">ورود / ثبت نام</section>
            <section class="login-info">شماره موبایل خود را وارد کنید</section>
            <form action="{{ route('otp.send') }}" method="post">
                @csrf
                <section class="login-input-text">
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" name="mobile" placeholder="شماره موبایل" required>
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </section>

                @if (session('error'))
                    <section class="alert alert-danger">
                        {{ session('error') }}
                    </section>
                @endif
                
                <section class="login-btn d-grid g-2">
                    <button class="btn btn-danger">ورود</button>
                </section>
            </form>
        </section>
    </section>
@endsection
