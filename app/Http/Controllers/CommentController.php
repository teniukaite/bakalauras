<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\File;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(File $file): View
    {
        return view('files.comments.create', compact('file'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        Comment::create([
            'comment' => $data['comment'],
            'file_id' =>  $data['file'],
            'user_id' => Auth::user()->id
        ]);
        $file = File::where('id', '=', $data['file'])->first();
        $comments = $file->comments()->latest()->paginate(10);
        return view('files.comments.show', compact('comments', 'file'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    public function show(File $file)
    {
        $comments = $file->comments()->latest()->paginate(10);

        return view('files.comments.show', compact('comments', 'file'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
