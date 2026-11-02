@extends('admin.layouts.master')
@section('title', 'اسلایدر ها')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    اسلایدر ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد اسلایدر ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.slider.create') }}" class="btn btn-success">ساخت</a>
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
                    @foreach ($sliders as $slider)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset($slider->image) }}" alt="" class="img-fluid" width="100"
                                height="100">
                            </td>
                            <td>
                                @if ($slider->position == 0)
                                    اسلایدر اصلی
                                @endif
                                @if ($slider->position == 1)
                                    بالا سمت چپ اسلایدر اصلی
                                @endif
                                @if ($slider->position == 2)
                                    پایین سمت چپ اسلایدر اصلی
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.slider.destroy', $slider) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.slider.edit', $slider) }}" class="text-warning">
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
