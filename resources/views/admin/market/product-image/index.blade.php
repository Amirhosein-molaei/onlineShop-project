@extends('admin.layouts.master')
@section('title', 'گالری')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    گالری
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد گالری به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.market.product-image.create', $product) }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset($image->image) }}" alt="" class="img-fluid" width="100" height="100">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.market.product-image.destroy', [$product, $image]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.product-image.edit', [$product, $image]) }}"
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
