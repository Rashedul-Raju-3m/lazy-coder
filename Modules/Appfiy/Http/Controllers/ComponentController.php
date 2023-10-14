<?php

namespace Modules\Appfiy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Appfiy\Entities\Component;
use Modules\Appfiy\Entities\ComponentLayout;
use Modules\Appfiy\Entities\ComponentProperties;
use Modules\Appfiy\Entities\LayoutType;
use Modules\Appfiy\Entities\LayoutTypeProperties;
use Modules\Appfiy\Entities\Scope;
use Modules\Quran\Entities\Ayat;

class ComponentController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $deleteComponent = Component::whereNull('slug')->first();
        if (isset($deleteComponent)){
            $deleteComponent->delete();
        }
        $components = Component::where('is_active',1)->orderBy('id','DESC')->paginate(10);
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
        $data = Component::find($id);
        $layoutTypes = LayoutType::where('is_active',1)->get();
        $componentLayouts = ComponentLayout::where('component_id',$id)->get()->toArray();

        $componentLayoutsArray = [];
        if (isset($componentLayouts) && count($componentLayouts)>0){
            foreach ($componentLayouts as $lay){
                array_push($componentLayoutsArray,$lay['layout_type_id']);
            }
        }
        $scopes = Scope::select(['id','name','slug','is_global'])->get()->toArray();

        $scopeArray = [];
        if (count($scopes)>0){
            foreach ($scopes as $val){
                $scopeArray[$val['is_global']==0?'page-scope':'global-scope'][] = $val;
            }
        }

        return view('appfiy::component/edit',['data'=>$data,'layoutTypes'=>$layoutTypes,'componentLayoutsArray'=>$componentLayoutsArray,'scopeArrayData'=>$scopeArray]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,$ln, $id){
        $this->validate($request, [
            'name' => 'required|unique:appfiy_component,name,'.$id,
            'label' => 'required',
            'icon_code' => 'required',
            'event' => 'required',
            'scope' => 'required',
            'layout' => 'required',
        ],[
            'name.required' => __('appfiy::messages.enterComponentName'),
            'name.unique' => __('appfiy::messages.componentNameMustbeUnique'),
            'label.required' => __('appfiy::messages.enterComponentLabel'),
            'icon_code.required' => __('appfiy::messages.enterIconName'),
            'event.required' => __('appfiy::messages.EnterEvent'),
            'scope.required' => __('appfiy::messages.ChooseScope'),
            'layout.required' => __('appfiy::messages.chooseLayoutType'),
        ]);

        $input = $request->all();
//        dd($input);
        $input['slug'] = Str::slug($request->name);
        $input['scope'] = json_encode($input['scope']);
        $component = Component::find($id);

        /*if ($request->file('app_icon') != '') {
            $target_location = 'upload/component-image/';
            File::delete(public_path().'/'.$target_location.$component->app_icon);
            $avatar = $request->file('app_icon');
            $file_title = bin2hex(random_bytes(15)).'.'.$avatar->getClientOriginalExtension();
            $input['app_icon'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['app_icon']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }else{
            $input['app_icon'] = $component->app_icon;
        }

        if ($request->file('web_icon') != '') {
            $target_location = 'upload/component-image/';
            File::delete(public_path().'/'.$target_location.$component->web_icon);
            $avatar = $request->file('web_icon');
            $file_title = bin2hex(random_bytes(15)).'.'.$avatar->getClientOriginalExtension();
            $input['web_icon'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['web_icon']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }else{
            $input['web_icon'] = $component->audio_bn;
        }

        if ($request->file('image') != '') {
            $target_location = 'upload/component-image/';
            File::delete(public_path().'/'.$target_location.$component->image);
            $avatar = $request->file('image');
            $file_title = bin2hex(random_bytes(15)).'.'.$avatar->getClientOriginalExtension();
            $input['image'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['image']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }else{
            $input['image'] = $component->audio_en;
        }*/


        DB::beginTransaction();
        try {
            $component->update($input);
            $component->save();

            if (isset($input['layout'])){
                foreach ($input['layout'] as $layout){
                    $layoutProperties = LayoutTypeProperties::where('appfiy_layout_type_group_style.layout_type_id',$layout)
                                        ->where('appfiy_layout_type_style_properties.is_active',1)
                                        ->join('appfiy_layout_type_group_style','appfiy_layout_type_group_style.property_id','=','appfiy_layout_type_style_properties.id')
                                        ->select([
                                            'appfiy_layout_type_style_properties.name',
                                            'appfiy_layout_type_style_properties.input_type',
                                            'appfiy_layout_type_style_properties.value',
                                            'appfiy_layout_type_style_properties.default_value',
                                        ])
                                        ->get();

                    $componentLayoutsExists = ComponentLayout::where('component_id',$id)->get()->toArray();
                    $componentLayoutsArray = [];
                    if (isset($componentLayoutsExists) && count($componentLayoutsExists)>0){
                        foreach ($componentLayoutsExists as $lay){
                            array_push($componentLayoutsArray,$lay['layout_type_id']);
                        }
                    }
                    $insertLayoutArray = array_diff($input['layout'],$componentLayoutsArray);
                    $deleteArrayList = array_diff($componentLayoutsArray, $input['layout']);
                    if (isset($deleteArrayList) && count($deleteArrayList)>0){
                        foreach ($deleteArrayList as $deleteID){
                            ComponentLayout::where('component_id',$id)->where('layout_type_id',$deleteID)->first()->delete();
                            $deleteProperties = ComponentProperties::where('component_id',$id)->where('layout_type_id',$deleteID)->get();
                            if (isset($deleteProperties) && count($deleteProperties)>0){
                                foreach ($deleteProperties as $delP){
                                    $delP->delete();
                                }
                            }
                        }
                    }
                    if (isset($insertLayoutArray) && count($insertLayoutArray)>0){
                        foreach ($insertLayoutArray as $layId){
                            ComponentLayout::create([
                                'component_id' => $id,
                                'layout_type_id' => $layId
                            ]);
                            if (isset($layoutProperties) && count($layoutProperties)>0) {
                                foreach ($layoutProperties as $pro) {
                                    ComponentProperties::create([
                                        'component_id' => $id,
                                        'layout_type_id' => $layId,
                                        'name' => $pro->name,
                                        'input_type' => $pro->input_type,
                                        'value' => $pro->value,
                                        'default_value' => $pro->default_value,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();

            if ($id){
                return redirect()->route('component_properties_edit', [app()->getLocale(),$id]);
            }
//            Session::flash('message',__('quran::messages.Create Message'));
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function editComponentProperties($ln,$id){
        $component = Component::find($id);
        $componentLayout = ComponentLayout::join('appfiy_layout_type','appfiy_layout_type.id','=','appfiy_component_layout.layout_type_id')
                                            ->select(['appfiy_layout_type.name','appfiy_layout_type.slug'])
                                            ->where('appfiy_component_layout.component_id',$id)
                                            ->get()->toArray();
        $componentLayoutProperties = ComponentProperties::where('appfiy_component_style_properties.component_id',$id)
                                    ->select([
                                        'appfiy_component_style_properties.id',
                                        'appfiy_component_style_properties.name',
                                        'appfiy_component_style_properties.value',
                                        'appfiy_component_style_properties.default_value',
                                        'appfiy_component_style_properties.input_type',
                                        'appfiy_layout_type.name as layout_type_name',
                                        'appfiy_layout_type.slug as layout_type_slug',
                                    ])
                                    ->join('appfiy_layout_type','appfiy_layout_type.id','=','appfiy_component_style_properties.layout_type_id')
                                    ->get()->toArray();

        $array = [];
        if (count($componentLayoutProperties)>0){
            foreach ($componentLayoutProperties as $val){
                $array[$val['layout_type_slug']][] = $val;
            }
        }

        return view('appfiy::component/properties_edit',['component'=>$component,'componentLayout'=>$componentLayout,'componentLayoutProperties'=>$componentLayoutProperties,'records'=>$array]);
    }

    public function updateProperties(Request $request,$ln,$id){
        if (count($request->get('component_properties_id'))>0){
            foreach ($request->get('component_properties_id') as $key => $comProId){
                $ComponentProperties = ComponentProperties::find($comProId);
                $ComponentProperties->update([
                   'value' => $request->get('value')[$key]
                ]);
            }
        }
        return redirect()->route('component_list',app()->getLocale());
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
