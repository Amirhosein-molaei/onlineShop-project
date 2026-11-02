@extends('admin.layouts.master')
@section('title', 'استان ها')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    استان ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد استان ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.province.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($provinces as $province)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $province->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.province.destroy', $province) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.province.edit', $province) }}"
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
        <div class="text-center">
            {{ $provinces->links() }}
        </div>
    </section>
@endsection
