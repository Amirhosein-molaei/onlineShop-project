<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unseenComments = Comment::where('status', 0)->get();
        foreach ($unseenComments as $comment) {
            $comment->status = 1;
            $comment->save();
        }
        
        $comments = Comment::all();
        return view('admin.content.comment.index', compact('comments'));
    }

    public function changeStatus(Comment $comment)
    {
        if ($comment->status == 1) {
            $comment->update(['status' => 2]);
            return redirect()->back()->with('swal-success', 'وضعیت نظر تغییر یافت');
        } else {
            $comment->update(['status' => 1]);
            foreach ($comment->answers as $answer) {
                $answer->update(['status' => 1]);
            }
            return redirect()->back()->with('swal-success', 'وضعیت نظر و پاسخ های آن به رد شده تغییر یافت');
        }
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
