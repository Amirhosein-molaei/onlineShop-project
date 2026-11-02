<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\storeCommentRequest;
use App\Models\Comment;
use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeProductComment(storeCommentRequest $request, Product $product)
    {
        if (Auth::check()) {
            $inputs = $request->validated();
            $inputs['user_id'] = Auth::user()->id;
            $inputs['commentable_type'] = 'App\Models\Market\Product';
            $inputs['commentable_id'] = $product->id;
            $comment = Comment::create($inputs);
            return redirect()->back()->with('swal-success', 'نظر شما با موفقیت ثبت شد و پس از تایید نماش داده خواهد شد');
        } else {
            return redirect()->back()->with('swal-success', 'برای ثبت کامنت  ابتدا لاگین کنید');
        }
    }
}
