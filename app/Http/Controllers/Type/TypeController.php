<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\TypeRequest;
use App\Http\Resources\Type\TypeResource;
use App\Models\Type;

class TypeController extends Controller
{
    public function web_index()
    {
        return TypeResource::collection(Type::all());
    }

    public function index()
    {
        return TypeResource::collection(Type::all());
    }

    public function store(TypeRequest $request)
    {
        $type = new Type();
        $name_ar = $request->input('name_ar');
        $name_en = $request->input('name_en');
        $type->translateOrNew('ar')->name = $name_ar ?? $name_en;
        $type->translateOrNew('en')->name = $name_en ?? $name_ar ;
        $type->save();

        return response()->json([
            'message' => __('response.created'),
        ]);
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return response()->json([
            'message' => __('response.deleted'),
        ]);
    }

}
