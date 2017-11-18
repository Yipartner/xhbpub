@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{url()}}" method="post">


                    </form>
                    <form action="{{url('/addnew')}}" method="POST">
                        {!! csrf_field() !!}
                        {{--没有csrf域post会被deny，然后直接返回500--}}
                        <h3>标题</h3>
                        <input class="form-control" type="text" name="title" size="20" value="<?php old('blog_title'); ?>"/>
                        <br>
                        <h3>分类</h3>
                        <select name="cid">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <h3>内容</h3>
                        {{--下面这个textarea如果不写在一行里就会导致输入框自带一堆烦人的空格--}}
                        <textarea  class="form-control" rows="10" name="postContent" id="text_editor" oninput="update()"><?php old('postContent'); ?></textarea>
                        <br>
                        <button type="submit" class="btn btn-default">提交</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
