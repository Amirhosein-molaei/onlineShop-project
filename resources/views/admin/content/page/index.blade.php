@extends('admin.layouts.master')
@section('title', 'صفحه')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    صفحات
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد صفحات به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.page.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">بدنه اصلی</th>
                        <th scope="col">اسلاگ</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $page->title }}</td>
                            <td>{{ Str::limit($page->body, 10, '...') }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.page.destroy', $page) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.page.edit', $page) }}"
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
