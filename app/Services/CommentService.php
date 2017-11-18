<?php

namespace App\Services;


use App\Comment;
use Illuminate\Http\Request;

class CommentService
{
    private $Comments;
    public function __construct(Comment $Comments)
    {
        $this->Comments=$Comments;
    }

    public function addComment(Request $request)
    {
            $comment=new Comment();
            $comment->user_id=$request->user_id;
            $comment->article_id=$request->article_id;
            $comment->content=$request->postContent;
            $comment->save();
    }
    public function delComment($comment_id)
    {
        $this->Comments->destroy($comment_id);
    }
    public function selectComment($article_id)
    {
        return $this->Comments->where('article_id',$article_id)->paginate(4);
    }
    public function delCommentByArticle($article_id)
    {
        $this->Comments->where('article_id',$article_id)
                        ->delete();
    }
}