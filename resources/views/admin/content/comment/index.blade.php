@extends('admin.layouts.master')
@section('title', 'نظرات')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    نظرات
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد نظرات به شما داده می شود
                </p>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نظر</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">نظر برای مدل</th>
                        <th scope="col">نام</th>
                        <th scope="col">زمان</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ Str::limit($comment->body, 20, '...') }}</td>
                            <td>{{ $comment->parent_id ? Str::limit($comment->parent->body, 20, '...') : 'نظر اصلی' }}</td>
                            <td>
                                @if ($comment->commentable_type == 'App\Models\Market\Product')
                                    محصول
                                @else
                                    بلاگ
                                @endif
                            </td>
                            <td>
                                @if ($comment->commentable_type == 'App\Models\Market\Product')
                                    {{ $comment->commentable->name }}
                                @else
                                    {{ $comment->commentable->title }}
                                @endif
                            </td>
                            <td>{{ jdate($comment->creaetd_at) }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.comment.show', $comment) }}"
                                            class="text-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                            @if ($comment->status == 1)
                                            <a href="{{ route('admin.content.comment.change-status', $comment) }}"
                                            class="text-white bg-primary p-2 rounded">تایید</a>
                                            @elseif ($comment->status == 2)
                                            <a href="{{ route('admin.content.comment.change-status', $comment) }}"
                                            class="text-white bg-danger p-2 rounded">رد تایید</a>
                                            @endif
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
