<?php

namespace App\Services;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    private $Articles;
    private $CommentService;
    public function __construct(Article $Article,CommentService $commentService)
    {
        $this->Articles=$Article;
        $this->CommentService=$commentService;
    }

    public function addArticle(Request $request)
    {
        $article=new Article;
        $article->title=$request->title;
        $article->content=$request->postContent;
        $article->user_id=$request->user()->id;
        $article->article_type=$request->type;
        $article->save();
    }
    public function updataArticle(Request $request)
    {
        $article=$this->Articles->where('id',$request->article_id)->first();
        $article->title=$request->title;
        $article->content=$request->postContent;
        $article->user_id=$request->user()->id;
        $article->article_type=$request->type;
        $article->id=$request->article_id;
        $article->save();
    }
    public function selectSingleArticle($article_id)
    {
        $article=$this->Articles->findOrFail($article_id);
        return $article;
    }
    public function selectArticleList()
    {
        $articles=$this->Articles->paginate(10);
        return $articles;
    }
    public function delArticle($article_id)
    {
        DB::transaction(function ()use ($article_id){

            $this->Articles->destroy($article_id);
            $this->CommentService->delCommentByArticle($article_id);
        });

    }
    public function selectArticleListByType($type_id)
    {
        $articles=$this->Articles->where('article_type','=',$type_id)->paginate(10);
        return $articles;
    }

}