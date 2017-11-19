<?php
namespace App\Http\Controllers;


use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService=$commentService;
    }
    public function addComment(Request $request)
    {
        $rule=[
            'user_id'=>'required',
            'postContent'=>'required',
            'article_id'=>'required'
        ];
        $this->validate($request,$rule);
        $this->commentService->addComment($request);
        return back();
    }
    public function delComment($comment_id)
    {
        $this->commentService->delComment($comment_id);
        return back();
    }
}