<?php

namespace Modules\Appfiy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Appfiy\Entities\Component;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $components = Component::where('is_active',1)->paginate(10);
        return view('appfiy::component/index',['components'=>$components]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(){
        $input['parent_id'] = null;
        $input['layout_type_id'] = null;
        $input['name'] = null;
        $input['slug'] = null;
        $component = Component::create($input);
        if ($component->id){
            return redirect()->route('component_edit', [app()->getLocale(),$component->id]);
        }
//        return view('appfiy::component/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        dd($request->all());
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('appfiy::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($ln,$id){
        /*$rootWord = RootWord::pluck('name_'.app()->getLocale(),'id')->all();
        $sura = Sura::pluck('name_'.app()->getLocale(),'id')->all();
        $para = Para::pluck('name_'.app()->getLocale(),'id')->all();
        $tafsirAuthor = TafsirAuthor::pluck('name','id')->all();*/
        $data = Component::find($id);
        return view('appfiy::component/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
