@extends('layouts.app')

@section('content')
    @if($route!='登录后跳转')
        <div class="container">
    @endif
    <div class="row">
        {{--<div class="col-md-8 col-md-offset-2">--}}
                @if($route=='addnew')
                    @inject('typeServices','App\Services\TypeService')
                    <div class="col-md-6" id="add_new_form" >
                        <form action="{{url('/post/addnew')}}" method="post">
                            {!! csrf_field() !!}
                            {{--没有csrf域post会被deny，然后直接返回500--}}
                            <h3>标题</h3>
                            <input class="form-control" type="text" name="title" size="20" value=""/>
                            <br>
                            <h3>分类</h3>
                            <select name="type">
                                @foreach($typeServices->selectTypeList() as $type)
                                    <option value="{{$type->id}}">{{$type->content}}</option>
                                @endforeach
                            </select>
                            <h3>内容</h3>
                            {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
                            <textarea  class="form-control" rows="10" name="postContent" value="postContent" id="text_editor" oninput="update()"></textarea>
                            <br>
                            <button type="submit" class="btn btn-default">提交</button>

                        </form>
                </div>
                    <div class="col-md-6">

                    <h3>实时预览</h3>
                    <div id="preview">
                        随便写点什么就可以查看预览了哦...
                    </div>

                </div>
                    <script>
                    var editor = document.getElementById('text_editor');
                    var preview = document.getElementById('preview');
                    var parser = new HyperDown;

                    function update()
                    {
                        preview.innerHTML = parser.makeHtml(editor.value);
                    }
                </script>
                @elseif($route=='addtype')
                    <div class="col-md-6" id="add_new_form" >
                        <form action="{{url('/post/addtype')}}" method="post">
                            {!! csrf_field() !!}
                            {{--没有csrf域post会被deny，然后直接返回500--}}
                            <h3>分类名称</h3>
                            <input class="form-control" type="text" name="postContent" size="20" value=""/>
                            <button type="submit" class="btn btn-default">提交</button>

                        </form>
                    </div>
                @elseif($route=='admin/editArticle')
                    @inject('typeServices','App\Services\TypeService')
                    <div class="col-md-6" id="add_new_form" >
                        <form action="{{url('/post/updata')}}" method="post">
                            {!! csrf_field() !!}
                            {{--没有csrf域post会被deny，然后直接返回500--}}
                            <h3>标题</h3>
                            <input type="hidden" name="article_id" value={{$article->id}}>
                            <input class="form-control" type="text" name="title" size="20"  value={{$article->title}} />
                            <br>
                            <h3>分类</h3>
                            <select name="type">
                                @foreach($typeServices->selectTypeList() as $type)
                                    <option value="{{$type->id}}">{{$type->content}}</option>
                                @endforeach
                            </select>
                            <h3>内容</h3>
                            {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
                            <textarea  class="form-control" rows="10" name="postContent" value="postContent" id="text_editor" oninput="update()">{{$article->content}}</textarea>
                            <br>
                            <button type="submit" class="btn btn-default">提交</button>

                        </form>
                    </div>
                    <div class="col-md-6">

                        <h3>实时预览</h3>
                        <div id="preview">
                            随便写点什么就可以查看预览了哦...
                        </div>

                    </div>
                    <script>
                        var editor = document.getElementById('text_editor');
                        var preview = document.getElementById('preview');
                        var parser = new HyperDown;

                        function update()
                        {
                            preview.innerHTML = parser.makeHtml(editor.value);
                        }
                    </script>
                @elseif($route=='登录后跳转')
                    <div class="header" style="background-image: url(http://of1deuret.bkt.clouddn.com/17-11-21/69568559.jpg);margin:-20px;height:800px">                    <div class="conptainer">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="logotxt"><h1><a href={{url('/')}}>MariaSeal's Pub</a></h1></div>

                                <h1 style="color: white"><span>小伙伴</span></h1>
                            </div>
                        </div>
                    </div>
                    </div>
                @elseif($route=='admin')
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{url('/admin/addnew')}}">添加文章</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('/admin/addtype')}}">添加分类</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('/admin/article')}}">管理文章</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{url('/admin/type')}}">管理分类</a>
                    </li>
                    {{--<li class="list-group-item">Vestibulum at eros</li>--}}
                </ul>
                @elseif($route=='article_list')
                    <ul class="list-group">
                    @foreach ($article_list as $article)
                        <li class="list-group-item">
                            <a href="{{url('/article/'.$article->id)}}">{{ $article->title }}</a>
                        </li>
                    @endforeach
                    </ul>
                    <nav aria-label="Page navigation" style="float: right">
                        <ul class="pagination">
                                    {{$article_list->links()}}

                        </ul>
                    </nav>
                @elseif($route=='article')
                    <h1>{{$article->title}}</h1>
                    <div>
                        {!! $article->content !!}
                        @if(Auth::check())
                        <div class= id="add_new_form" >
                            <form action="{{url('/post/addcomment')}}" method="post">
                                {!! csrf_field() !!}
                                {{--没有csrf域post会被deny，然后直接返回500--}}
                                {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
                                <input type="hidden" name="article_id" value={{ $article->id }}>
                                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                                <textarea  class="form-control" rows="6" name="postContent" value="postContent" id="text_editor" oninput="update()"></textarea>
                                <br>
                                <button type="submit" class="btn btn-default">添加评论</button>
                            </form>
                        </div>
                        @else
                            <div class="panel-body">
                                <p>登录后进行评论</p>
                                <hr>
                            </div>
                        @endif
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            评论
                        </div>
                        <?php  $X=0; ?>
                        <div class="container">
                        @foreach($article->comments as $comment)

                            <h4>{{'用户 '.$comment->user_name.' '}}评论:</h4>
                            <div class="container">
                            <h5>{{$comment->content}}</h5>
                                @if(Auth::check())
                                    @if(Auth::user()->id==1||$comment->user_id==Auth::user()->id)
                                    <form action="{{url('/comment/'.$comment->id)}}" method="POST" style="float: right">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button type="submit">删除</button>
                                    </form>
                                    @endif
                                @endif
                            </div>
                           <?php $X++; ?>
                        @endforeach
                        </div>
                        @if($X==0)
                            <div class="panel-body">
                                <p>还没有评论</p>
                                <hr>
                            </div>
                        @endif
                        <nav aria-label="Page navigation" style="float: right">
                            <ul class="pagination">
                                {{$article->comments->links()}}
                            </ul>
                        </nav>
                    </div>

                @elseif($route=='admin/article')
                    <ul class="list-group">
                    @foreach ($article_list as $article)
                            <div>
                            <a href="{{url('/article/'.$article->id)}}">{{ $article->title }}</a>

                            <form action="{{url('/article/'.$article->id)}}" method="POST" style="float: right">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit">删除</button>
                            </form>

                                <a href="{{url('/admin/editarticle/'.$article->id)}}"><button  style="float: right ">编辑</button></a>
                            </div>
                        <br>
                        @endforeach
                    </ul>
                    <nav aria-label="Page navigation" style="float: right">
                        <ul class="pagination">
                            {{$article_list->links()}}

                        </ul>
                    </nav>
                @elseif($route=='admin/type')
                    <ul class="list-group">
                        @foreach ($type_list as $type)
                            <div>
                                <a href="{{url('/type/'.$type->id)}}">{{ $type->content }}</a>

                                <form action="{{url('/type/'.$type->id)}}" method="POST" style="float: right">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit">删除</button>
                                </form>
                            </div>
                            <br>
                        @endforeach
                    </ul>
                    <nav aria-label="Page navigation" style="float: right">
                        <ul class="pagination">
                            {{$type_list->links()}}

                        </ul>
                    </nav>
                @elseif($route=='type')
                    <ul class="list-group">
                        @foreach ($articles as $article)
                            <li class="list-group-item">
                                <a href="{{url('/article/'.$article->id)}}">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <nav aria-label="Page navigation" style="float: right">
                        <ul class="pagination">
                            {{$articles->links()}}
                        </ul>
                    </nav>
                @endif

        {{--</div>--}}
    </div>
</div>

@endsection
