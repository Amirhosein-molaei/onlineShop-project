@extends('admin.layouts.master')
@section('title', 'شهر ها')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    شهر ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد دسته بندی به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.city.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">استان</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->province->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.city.destroy', $city) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.city.edit', $city) }}"
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
            <div>
                {{ $cities->links() }}
            </div>
        </section>
    </section>
@endsection
