<?php

namespace App\Services;

use App\Article;
use Illuminate\Http\Request;

class ArticleService
{
    private $Articles;
    public function __construct(Article $Article)
    {
        $this->Articles=$Article;
    }

    public function addArticle(Request $request)
    {
        $article=new Article;
        $article->title=$request->tiele;
        $article->content=$request->postcontent;
        $article->user_id=$request->user_id;
        $article->article_type=$request->article_type;
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
        $this->Articles->destroy($article_id);
    }

}