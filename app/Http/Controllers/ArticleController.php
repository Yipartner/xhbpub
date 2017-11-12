<?php
namespace App\Http\Controllers;

use App\Services\ArticleService;

class ArticleController extends Controller
{
    private $articleService;
    public function __construct(ArticleService $articleService){
        $this->articleService=$articleService;
    }
    public function addNew()
    {

    }
}
