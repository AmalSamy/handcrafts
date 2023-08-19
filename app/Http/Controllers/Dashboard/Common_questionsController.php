<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class Common_questionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $common_questions = CommonQuestion::paginate();
        return response()->view('dashboard.common_questions.index', compact("common_questions",));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $common_questions = new CommonQuestion();
        return response()->view('dashboard.common_questions.create', compact("common_questions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $common_questions=new CommonQuestion();

        $common_questions->title= $request->input('title');
        $common_questions->desc= $request->input('desc');
        $common_questions->status= $request->input('status');

        $common_questions->save();
        return redirect()->route('dashboard.common_questions.index')->with('success','CommonQuestions Created ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CommonQuestion $common_questions)
    {
        return response()->view('dashboard.common_questions.show',compact('common_questions'));


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
            $common_questions=CommonQuestion::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.common_questions.index')->with('info','item not found ');
        }

        return response()->view('dashboard.common_questions.edit',compact('common_questions'));
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
        $common_questions=CommonQuestion::findOrFail($id);


        $common_questions->title = $request->post('title');
        $common_questions->desc = $request->post('desc');
        $common_questions->status = $request->post('status');

        $common_questions->update();


        return redirect('dashboard/common_questions')->with('success', 'CommonQuestions Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $common_questions=CommonQuestion::findOrFail($id);
        $common_questions->delete();


        return redirect('dashboard/common_questions')->with('success', 'CommonQuestions Deleted!');
    }

    public function trash(){
        $common_questions=CommonQuestion::onlyTrashed()->paginate();
        return view('dashboard.common_questions.trash',compact('common_questions'));

    }

    public function restore(Request $request, $id){
        $common_questions = CommonQuestion::onlyTrashed()->findOrFail($id);
        $common_questions->restore();
        return redirect()->route('dashboard.common_questions.trash')
            ->with('success','CommonQuestions restore!');



    }

    public function forceDelete($id)
    {
        $common_questions = CommonQuestion::onlyTrashed()->findOrFail($id);
        $common_questions->forceDelete();


        return redirect()->route('dashboard.common_questions.trash')
            ->with('success', 'CommonQuestions deleted forver!');

    }
}
