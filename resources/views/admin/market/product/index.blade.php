@extends('admin.layouts.master')
@section('title', 'محصولات')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    محصولات
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد محصولات به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.market.product.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid" width="100" height="100">
                            </td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.market.product.destroy', $product) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.product.edit', $product) }}"
                                            class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.product.show', $product) }}"
                                            class="text-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.market.product-image.index', $product) }}"
                                            class="text-success">
                                            <i class="fa fa-image"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{ $products->links() }}

                </tbody>
            </table>
        </section>
    </section>
@endsection
