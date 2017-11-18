<?php
namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\CommentService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    private $userService;
    private $articleService;
    private $commentService;
    public function __construct(ArticleService $articleService,CommentService $commentService,UserService $userService){
        $this->articleService=$articleService;
        $this->commentService=$commentService;
        $this->userService=$userService;
    }
    public function index()
    {
        return view('home',['route'=>'addnew']);
    }
    public function addNew(Request $request)
    {
        $rule=[
            'title'=>'required',
            'postContent'=>'required',
            'type'=>'required'
        ];
        $this->validate($request,$rule);
        $this->articleService->addArticle($request);
        return redirect('/admin/article');
//        dd($request->user());
    }
    public function updata(Request $request)
    {
        $rule=[
            'title'=>'required',
            'postContent'=>'required',
            'type'=>'required',
            'article_id'=>'required'
        ];
        $this->validate($request,$rule);
        $this->articleService->updataArticle($request);
        return redirect('/admin/article');
    }
    public function delArticle($article_id)
    {
        $this->articleService->delArticle($article_id);
        return back();
    }
    public function showSingleArticle($article_id)
    {
        $parser = new CommonMarkConverter(['html_input' => 'escape']);
        $article=$this->articleService->selectSingleArticle($article_id);
        $article->content=$parser->convertTohtml($article->content);
        $article->comments=$this->commentService->selectComment($article_id);
        //循环查找数据库,这么写不好
        foreach ($article->comments as $comment)
        {
            $comment->user_name=$this->userService->getUser($comment->user_id)->name;
        }
        if (Auth::check()) {
            return view('home', [
                'route' => 'article',
                'article' => $article
        ]);
        }
        else
            return view('home', [
                'route' => 'article',
                'article' => $article
            ]);
    }
    public function showArticles()
    {
        $article_list=$this->articleService->selectArticleList();
        return view('home',[
            'route'=>'article_list',
            'article_list'=>$article_list
        ]);
    }
    public function showArticlesByType($type_id)
    {
        $articles=$this->articleService->selectArticleListByType($type_id);

        return view('home',[
           'route'=>'type',
           'articles'=>$articles
        ]);
    }

}
