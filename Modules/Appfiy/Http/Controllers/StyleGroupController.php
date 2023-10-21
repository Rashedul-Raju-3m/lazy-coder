<?php

namespace Modules\Appfiy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Appfiy\Entities\Component;
use Modules\Appfiy\Entities\ComponentLayout;
use Modules\Appfiy\Entities\ComponentProperties;
use Modules\Appfiy\Entities\LayoutTypeProperties;
use Modules\Appfiy\Entities\MedicineBrand;
use Modules\Appfiy\Entities\StyleGroup;
use Modules\Appfiy\Entities\StyleGroupProperties;
use Modules\Appfiy\Entities\StyleProperties;

class StyleGroupController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(){
        $styleGroups = StyleGroup::where('is_active',1)->paginate(20);
        return view('appfiy::styleGroup/index',['styleGroups'=>$styleGroups]);
    }

    public function assignProperties($ln,$id){
        $styleGroup = StyleGroup::find($id);
        $styleProperties = StyleProperties::where('is_active',1)->get();
        $existsStyleProperties = $styleGroup->groupProperties->toArray();
        $existsPropertiesArray = [];
        if (count($existsStyleProperties)>0){
            foreach ($existsStyleProperties as $pro) {
                array_push($existsPropertiesArray,$pro['style_property_id']);
            }
        }
        return view('appfiy::styleGroup/edit',['styleGroup'=>$styleGroup,'styleProperties'=>$styleProperties,'existsPropertiesArray'=>$existsPropertiesArray]);
    }

    public function assignPropertiesUpdate(Request $request,$ln,$id){

        $this->validate($request, [
            'properties_id' => 'required',
        ],[
            'properties_id.required' => __('appfiy::messages.chooseStyleProperties'),
        ]);

        $input = $request->all();
        $styleGroup = StyleGroup::find($id);

        DB::beginTransaction();
        try {
            if (isset($input['properties_id'])){
                $styleGroupPropertiesExists = $styleGroup->groupProperties->toArray();
                $styleGroupPropertiesArray = [];
                if (count($styleGroupPropertiesExists)>0){
                    foreach ($styleGroupPropertiesExists as $lay){
                        array_push($styleGroupPropertiesArray,$lay['style_property_id']);
                    }
                }
                $insertLayoutArray = array_diff($input['properties_id'],$styleGroupPropertiesArray);
                $deleteArrayList = array_diff($styleGroupPropertiesArray, $input['properties_id']);

                if (count($deleteArrayList)>0){
                    foreach ($deleteArrayList as $deleteID){
                        StyleGroupProperties::where('style_group_id',$id)->where('style_property_id',$deleteID)->first()->delete();
                    }
                }
                if (count($insertLayoutArray)>0){
                    foreach ($insertLayoutArray as $properties_id){
                        StyleGroupProperties::create([
                            'style_group_id' => $id,
                            'style_property_id' => $properties_id
                        ]);
                    }
                }
            }
            DB::commit();

            Session::flash('message',__('appfiy::messages.updateMessage'));
            return redirect()->route('style_group_list',app()->getLocale());

        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('appfiy::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
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
    public function edit($id)
    {
        return view('appfiy::edit');
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
