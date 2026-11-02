@extends('admin.layouts.master')
@section('title', 'اسلایدر ها')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    بنر ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد بنر ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.banner.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">محل قرارگیری</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset($banner->image) }}" alt="" class="img-fluid" width="100"
                                height="100">
                            </td>
                            <td>
                                @if ($banner->position == 0)
                                    بنر میانی سمت چپ
                                @endif
                                @if ($banner->position == 1)
                                    بنر میانی سمت راست
                                @endif
                                @if ($banner->position == 2)
                                    بنر انتهایی
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.banner.destroy', $banner) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.banner.edit', $banner) }}" class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </section>
    </section>
@endsection
