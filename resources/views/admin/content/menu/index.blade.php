@extends('admin.layouts.master')
@section('title', 'منو')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    منو ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد منو ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.menu.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">آدرس</th>
                        <th scope="col">منو والد</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->url }}</td>
                            <td>{{ $menu->parent_id ? $menu->parent->name : 'منو اصلی' }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.menu.destroy', $menu) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.menu.edit', $menu) }}"
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
