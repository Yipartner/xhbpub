<?php
namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleService;
    public function __construct(ArticleService $articleService){
        $this->articleService=$articleService;
    }
    public function addNew(Request $request)
    {
        $rule=[
            'title'=>'required',
            'articlecontent'=>'required',
            'user_id'=>'required'
        ];
        $this->validate()
        $this->articleService->addArticle($request);
    }
    public function delArticle($article_id)
    {
        $this->articleService->delArticle($article_id);
    }
    public function showSingleArticle($article_id)
    {
        return $this->articleService->selectSingleArticle($article_id);
    }
    public function showArticles()
    {
        return $this->articleService->selectArticleList();
    }

}
