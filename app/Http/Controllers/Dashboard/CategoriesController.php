<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request=request();
        $query=Category::query();
        $name=$request->query('name');
        // $status=$request->query('status');
        // if($name){
        //     $query->where('name','LIKE',"%{$name}%");
        // }
        // if($status=$request->query('status')){
        //     $query->where('status','=',"{$status}");
        // }
        // $categories =$query->paginate(1);

        //SELECT a.* ,b.name as parent_name
        //FROM categories as a
        //LEFT JOIN categories as b
        //ON b.id = a.parent_id
        $categories=Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])->withCount('products')
        ->filter($request->query())
        ->paginate(2);
       // $categories =Category::filter($request->query())->paginate(2);

        return response()->view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (Gate::define('categories.create')){
//            abort(403);
//        }
        $parents = Category::get();
        $category = new Category();
        return response()->view('dashboard.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::rouls());
        $categoy=new Category();
        $new_image=$this->uploadeFile($request);
        $categoy->name= $request->input('name');
        $categoy->parent_id= $request->input('parent_id');
        $categoy->description= $request->input('description');
        $categoy->status= $request->input('status');
        $categoy->slug=Str::slug($request->post('name'));
        $categoy->image=$new_image;

        //$categoy=Category::create([ $request->all()]);

        $categoy->save();
       return redirect()->route('dashboard.categories.index')->with('success','Category Created ');
        // return Redirect::route('categories.store')->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       try {
        $category=Category::findOrFail($id);
       } catch (Exception $e) {
        return Redirect::route('dashboard.categories.index')->with('info','item not found ');
       }
        //    SELECT * FROM categories WHERE id <> $id
        //    AND (parent_id IS NULL OR parent_id <> $id)

       $parents = Category::where('id','<>',$id)
       ->where(function($query) use ($id){
        $query->whereNull('parent_id')
        ->OrWhere('parent_id','<>',$id);

       })->get();

       return response()->view('dashboard.categories.edit',compact('category','parents'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(Category::rouls());
        $category=Category::findOrFail($id);

        $old_image=$category->image;
       // dd($old_image);
        $category->name = $request->post('name');
        $category->parent_id = $request->post('parent_id');
        $category->description = $request->post('description');
        $category->status = $request->post('status');

        $new_image=$this->uploadeFile($request);

       // dd($new_image);// فى حالة أنه ما بعتت صورة رح يرجع قيمة نل

        if($new_image){
            $category->image=$new_image;
        }
        $category->update();

        if($old_image && $new_image ){
            Storage::disk('public')->delete($old_image);
        }



        return redirect('dashboard/categories')->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category=Category::findOrFail($id);
       $category->delete();

    //    if($category->image){
    //     Storage::disk('public')->delete($category->image);

    //    }
       return redirect('dashboard/categories')->with('success', 'Category Deleted!');


    }

    protected function uploadeFile(Request $request){
        // if لازم نخلى ال  انها تكون أقصر
        if(!$request->hasFile('image')){
            return;
        }
        $file=$request->file('image');
        $new_image=$file->store('uploades',['disk'=>'public']);
        return $new_image;
    }

    //functions to delets

    public function trash(){
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));

    }

    public function restore(Request $request, $id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category restore!');


    }

    public function forceDelete($id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if($category->image){
        Storage::disk('public')->delete($category->image);

       }
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category deleted forver!');


    }































}












    // $file->getClientOriginalName(); ترجع الاسم الحقيقى للصورة
    // $file->getSize();
     //$file->getClientOriginalExtension();
