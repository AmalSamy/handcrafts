<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::paginate();
        return response()->view('dashboard.settings.index', compact("settings",));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = new Setting();
        return response()->view('dashboard.settings.create', compact("settings"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings=new Setting();

        $settings->key= $request->input('key');
        $settings->name= $request->input('name');
        $settings->value= $request->input('value');
        $settings->status= $request->input('status');


        $settings->save();
        return redirect()->route('dashboard.settings.index')->with('success','Setting Created ');

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return response()->view('dashboard.settings.show',compact('setting'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $settings=Setting::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.settings.index')->with('info','item not found ');
        }

        return response()->view('dashboard.settings.edit',compact('settings'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $settings=Setting::findOrFail($id);


        $settings->key = $request->post('key');
        $settings->name = $request->post('name');
        $settings->value = $request->post('value');
        $settings->status = $request->post('status');

        $settings->update();


        return redirect('dashboard/settings')->with('success', 'Setting Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $settings=Setting::findOrFail($id);
        $settings->delete();


        return redirect('dashboard/settings')->with('success', 'Setting Deleted!');
    }
    public function trash(){
        $settings=Setting::onlyTrashed()->paginate();
        return view('dashboard.settings.trash',compact('settings'));

    }

    public function restore(Request $request, $id){
        $settings = Setting::onlyTrashed()->findOrFail($id);
        $settings->restore();
        return redirect()->route('dashboard.settings.trash')
            ->with('success','setting restore!');



    }

    public function forceDelete($id)
    {
        $settings = Setting::onlyTrashed()->findOrFail($id);
        $settings->forceDelete();


        return redirect()->route('dashboard.settings.trash')
            ->with('success', 'setting deleted forver!');

}
}
