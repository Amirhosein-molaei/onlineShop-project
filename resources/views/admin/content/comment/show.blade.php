@extends('admin.layouts.master')
@section('title', 'اطلاعات نظر')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div class="mb-2">
                <h5>
                    اطلاعات نظر
                </h5>
                <p>نظر نوشته شده برای مدل
                    @if ($comment->commentable_type == 'App\Models\Market\Product')
                        <b>محصول</b>
                    @else
                        <b>بلاگ</b>
                    @endif
                    با نام
                    @if ($comment->commentable_type == 'App\Models\Market\Product')
                        <b>{{ $comment->commentable->name }}</b>
                    @else
                        <b>{{ $comment->commentable->title }}</b>
                    @endif
                </p>
            </div>
        </section>
        <section class="body-content">
            <div class="">
                <p class="mb-2">نوشته شده توسط {{ $comment->user->name }}</p>
                <div>
                    <h6>متن نظر</h6>
                    <p>{{ $comment->body }}</p>
                </div>
            </div>

            <div class="mt-4 mr-4">
                <h6 class="mb-2">پاسخ ها ({{ count($comment->answers) }})</h6>
                @forelse ($comment->answers as $answer)
                    <div class="border-top mt-2">
                        <p class="mt-2">نوشته شده توسط {{ $answer->user->name }} در {{ jdate($answer->created_at) }}</p>
                        <div>
                            <h6>متن نظر</h6>
                            <p>{{ $answer->body }}</p>
                        </div>
                    </div>
                @empty
                    <p>پاسخی وجود ندارد</p>
                @endforelse
            </div>
        </section>
    </section>
@endsection
