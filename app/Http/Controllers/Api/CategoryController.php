<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result =Category::with(['products'])->orderBy('id','desc')->simplePaginate();
        if($result)
        {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'),true,$result),200);
        }else{
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);

        }


    }

    // public function filter(Request $request){
    //      //Filter category handmade
    //     //  $request=request();
    //     //  $query=Category::query();
    //     //  $name=$request->query('name');
    //      //ON b.id = a.parent_id
    //       $result=Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
    //       ->select([
    //           'categories.*',
    //           'parents.name as parent_name'
    //       ])->withCount('products')
    //       ->filter($request->query())
    //       ->simplePaginate;
    //       if($result){
    //          return response($this->getResponse(__('my_keywords.operationSuccessfully'),true,$result),200);
    //       }else{
    //          return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);

    //      }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruls = [
            'name' => 'required|string',
            'image' => 'required|image',
        ];

        if ($this->getErrorIfAny($request->all(), $ruls)) {
            return $this->getErrorIfAny($request->all(), $ruls);
        }

        $imageName = $request['image']->store(config('paths.category_image_path'), 'public');
        $urlImage =  config('paths.storage_path') . $imageName;

        $category = new Category();
        $category['name'] =  $request['name'];
        $category['image'] =  $urlImage;
        $category['parent_id'] =  $request['parent_id'];

        $result = $category->save();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $category), 200);
        } else {
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruls = ['id' => 'required|numeric'];

        if ($this->getErrorIfAny(['id' => $id], $ruls)) {
            return $this->getErrorIfAny(['id' => $id], $ruls);
        }

        $result = Category::find($id);

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);
        }

    }

    public function update(){

    }

}
