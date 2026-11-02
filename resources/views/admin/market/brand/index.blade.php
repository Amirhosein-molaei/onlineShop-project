@extends('admin.layouts.master')
@section('title', 'دسته بندی محصولات')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    برند محصولات
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد برند ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.market.brand.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام انگلیسی</th>
                        <th scope="col">اسلاگ</th>
                        <th scope="col">لوگو</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $brand->persian_name }}</td>
                            <td>{{ $brand->english_name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->persian_name }}" class="img-fluid" width="100" height="100">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.market.brand.destroy', $brand) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.brand.edit', $brand) }}"
                                            class="text-warning">
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
