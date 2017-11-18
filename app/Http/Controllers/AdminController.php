<?php
/**
 * Created by PhpStorm.
 * User: neuqer_admin
 * Date: 17/11/14
 * Time: 下午3:30
 */
namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\TypeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $articleService;
    private $typeService;
    public function __construct(ArticleService $articleService,TypeService $typeService){
        $this->articleService=$articleService;
        $this->typeService=$typeService;
    }
    public function index()
    {
        return view('home',[
            'route'=>'admin',
        ]);
    }
    public function typeIndex()
    {
        return view('home',[
            'route'=>'addtype'
        ]);
    }
    public function showArticles()
    {
        $article_list=$this->articleService->selectArticleList();
        return view('home',[
            'route'=>'admin/article',
            'article_list'=>$article_list,
        ]);
    }
    public function showTypes()
    {
        $type_list=$this->typeService->selectTypeList();
        return view('home',[
            'route'=>'admin/type',
            'type_list'=>$type_list,
        ]);
    }
    public function editArticle($article_id)
    {
        $article=$this->articleService->selectSingleArticle($article_id);
        return view('home',[
            'route'=>'admin/editArticle',
            'article'=>$article
        ]);
    }
    public function addType(Request $request)
    {
        $rule=[
            'postContent'=>'required',
        ];
        $this->validate($request,$rule);
        $this->typeService->addType($request);
        return redirect('/admin/article');
    }
    public function delType($type_id)
    {
        $this->typeService->delType($type_id);
        return back();
    }

}