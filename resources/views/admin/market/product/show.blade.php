@extends('admin.layouts.master')
@section('title', 'اطلاعات محصول')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    اطلاعات محصول
                </h5>
            </div>
            <div>
                <a href="{{ route('admin.market.product.index') }}" class="btn btn-warning">بازگشت</a>
            </div>
        </section>
        <section class="body-content mt-3">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">مقدار</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>نام</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>برند</td>
                        <td>{{ $product->brand->persian_name }}</td>
                    </tr>
                    <tr>
                        <td>دسته بندی</td>
                        <td>{{ $product->productCategory->name }}</td>
                    </tr>
                    <tr>
                        <td>توضیحات</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <td>اسلاگ</td>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <td>تصویر</td>
                        <td><img src="{{ asset($product->image) }}" alt="" width="100" height="100"></td>
                    </tr>
                    <tr>
                        <td>وزن</td>
                        <td>{{ $product->weight ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>طول</td>
                        <td>{{ $product->length ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>عرض</td>
                        <td>{{ $product->width ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>ارتفاع</td>
                        <td>{{ $product->height ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>قیمت</td>
                        <td>{{ number_format($product->price) }}</td>
                    </tr>
                    <tr>
                        <td>تگ ها</td>
                        <td>{{ $product->tags }}</td>
                    </tr>
                    <tr>
                        <td>تعداد فروخته شده</td>
                        <td>{{ $product->sold_number }}</td>
                    </tr>
                    <tr>
                        <td>موجودی انبار</td>
                        <td>{{ $product->marketable_number }}</td>
                    </tr>
                    <tr>
                        <td>وضعیت</td>
                        <td>{{ $product->status ? 'فعال' : 'غیر فعال' }}</td>
                    </tr>
                    <tr>
                        <td>وضعیت فروش</td>
                        <td>{{ $product->marketable ? 'فعال' : 'غیر فعال' }}</td>
                    </tr>
                    <tr>
                        <td>ایجاد شده در</td>
                        <td>{{ jdate($product->created_at) }}</td>
                    </tr>
                    <tr>
                        <td>آخرین ویرایش در</td>
                        <td>{{ jdate($product->updated_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
@endsection
