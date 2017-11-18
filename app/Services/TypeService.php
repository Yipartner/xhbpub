<?php

namespace App\Services;

use App\Type;
use Illuminate\Http\Request;

class TypeService
{
    private $Types;
    public function __construct(Type $Types)
    {
        $this->Types=$Types;
    }

    public function addType(Request $request)
    {
        $type=new Type;
        $type->content=$request->postContent;
        $type->save();
    }
    public function selectTypeList()
    {
        $Types=$this->Types->paginate(10);
        return $Types;
    }
    public function delType($type_id)
    {
        $this->Types->destroy($type_id);

    }

}