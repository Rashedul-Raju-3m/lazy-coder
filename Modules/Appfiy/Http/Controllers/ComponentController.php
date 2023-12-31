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
use Modules\Appfiy\Entities\ComponentStyleGroup;
use Modules\Appfiy\Entities\ComponentStyleGroupProperties;
use Modules\Appfiy\Entities\LayoutType;
use Modules\Appfiy\Entities\LayoutTypeProperties;
use Modules\Appfiy\Entities\Scope;
use Modules\Appfiy\Entities\StyleGroup;
use Modules\Appfiy\Entities\StyleGroupProperties;
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
        $layoutTypes = LayoutType::where('is_active',1)->pluck('name','id');
        $styleGroups = StyleGroup::where('is_active',1)->get();

        $componentStyleIdArray = [];
            if (count($data->componentStyleGroup->toArray())>0){
                foreach ($data->componentStyleGroup->toArray() as $styID){
                    array_push($componentStyleIdArray,$styID['style_group_id']);
                }
            }

        $scopes = Scope::select(['id','name','slug','is_global'])->get()->toArray();

        $scopeArray = [];
        if (count($scopes)>0){
            foreach ($scopes as $val){
                $scopeArray[$val['is_global']==0?'page-scope':'global-scope'][] = $val;
            }
        }

        return view('appfiy::component/edit',['data'=>$data,'layoutTypes'=>$layoutTypes,'scopeArrayData'=>$scopeArray,'styleGroups'=>$styleGroups,'componentStyleIdArray' =>$componentStyleIdArray]);
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
//            'icon_code' => 'required',
//            'event' => 'required',
            'scope' => 'required',
            'layout_type_id' => 'required',
            'style_group' => 'required',
        ],[
            'name.required' => __('appfiy::messages.enterComponentName'),
            'name.unique' => __('appfiy::messages.componentNameMustbeUnique'),
            'label.required' => __('appfiy::messages.enterComponentLabel'),
//            'icon_code.required' => __('appfiy::messages.enterIconName'),
//            'event.required' => __('appfiy::messages.EnterEvent'),
            'scope.required' => __('appfiy::messages.ChooseScope'),
            'layout_type_id.required' => __('appfiy::messages.chooseLayoutType'),
            'style_group.required' => __('appfiy::messages.chooseStyleGroup'),
        ]);

        $input = $request->all();
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

        */
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
        }


        DB::beginTransaction();
        try {
            $component->update($input);
            $component->save();

            if (isset($input['style_group'])){
                    $componentStyleExists = $component->componentStyleGroup->toArray();
                    $componentStyleArray = [];
                    if (count($componentStyleExists) > 0) {
                        foreach ($componentStyleExists as $lay) {
                            array_push($componentStyleArray, $lay['style_group_id']);
                        }
                    }
                    $insertLayoutArray = array_diff($input['style_group'], $componentStyleArray);
                    $deleteArrayList = array_diff($componentStyleArray, $input['style_group']);
                    if (count($deleteArrayList) > 0) {
                        foreach ($deleteArrayList as $deleteID) {
                            ComponentStyleGroup::where('component_id', $id)->where('style_group_id', $deleteID)->first()->delete();
                            $deleteProperties = ComponentStyleGroupProperties::where('component_id', $id)->where('style_group_id', $deleteID)->get();
                            if (isset($deleteProperties) && count($deleteProperties) > 0) {
                                foreach ($deleteProperties as $delP) {
                                    $delP->delete();
                                }
                            }
                        }
                    }
                    if (count($insertLayoutArray) > 0) {
                        foreach ($insertLayoutArray as $layId) {
                            ComponentStyleGroup::create([
                                'component_id' => $id,
                                'style_group_id' => $layId
                            ]);
                            $layoutProperties = StyleGroupProperties::where('appfiy_style_group_properties.style_group_id', $layId)
                                ->where('appfiy_style_properties.is_active', 1)
                                ->join('appfiy_style_properties', 'appfiy_style_properties.id', '=', 'appfiy_style_group_properties.style_property_id')
                                ->select([
                                    'appfiy_style_properties.name',
                                    'appfiy_style_properties.input_type',
                                    'appfiy_style_properties.value',
                                    'appfiy_style_properties.default_value',
                                ])
                                ->get();
                            if (count($layoutProperties) > 0) {
                                foreach ($layoutProperties as $pro) {
                                    ComponentStyleGroupProperties::create([
                                        'component_id' => $id,
                                        'style_group_id' => $layId,
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
//                }
            DB::commit();

            if ($id){
//                return redirect()->route('component_properties_edit', [app()->getLocale(),$id]);
                return redirect()->route('component_list', app()->getLocale());
            }
        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
    }

    public function editComponentProperties($ln,$id){
        $component = Component::find($id);
        $componentLayout = ComponentStyleGroup::join('appfiy_style_group','appfiy_style_group.id','=','appfiy_component_style_group.style_group_id')
                                            ->select(['appfiy_style_group.name','appfiy_style_group.slug'])
                                            ->where('appfiy_component_style_group.component_id',$id)
                                            ->get()->toArray();
        $componentLayoutProperties = ComponentStyleGroupProperties::where('appfiy_component_style_group_properties.component_id',$id)
                                    ->select([
                                        'appfiy_component_style_group_properties.id',
                                        'appfiy_component_style_group_properties.name',
                                        'appfiy_component_style_group_properties.value',
                                        'appfiy_component_style_group_properties.default_value',
                                        'appfiy_component_style_group_properties.input_type',
                                        'appfiy_style_group.name as layout_type_name',
                                        'appfiy_style_group.slug as layout_type_slug',
                                    ])
                                    ->join('appfiy_style_group','appfiy_style_group.id','=','appfiy_component_style_group_properties.style_group_id')
                                    ->get()->toArray();
        $array = [];
        if (count($componentLayoutProperties)>0){
            foreach ($componentLayoutProperties as $val){
                $array[$val['layout_type_slug']][] = $val;
            }
        }

        return view('appfiy::component/properties_edit',['component'=>$component,'componentLayoutProperties'=>$componentLayoutProperties,'records'=>$array,'componentLayout'=>$componentLayout]);
    }

    public function updateProperties(Request $request,$ln,$id){
        if (count($request->get('component_properties_id'))>0){
            foreach ($request->get('component_properties_id') as $key => $comProId){
                $ComponentProperties = ComponentStyleGroupProperties::find($comProId);
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
