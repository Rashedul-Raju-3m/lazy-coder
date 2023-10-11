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
use Modules\Appfiy\Entities\LayoutType;
use Modules\Appfiy\Entities\LayoutTypeProperties;
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
        $data = Component::find($id);
        $layoutTypes = LayoutType::where('is_active',1)->get();
        $scopes = [
            'appbar' => 'appbar',
            'navbar' => 'navbar',
            'drawer' => 'drawer',
            'button' => 'button',
            'home-page' => 'home-page',
        ];
        return view('appfiy::component/edit',['data'=>$data,'layoutTypes'=>$layoutTypes,'scopes'=>$scopes]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,$ln, $id){
//        dd($request->all(),$ln,$id);

//        'name', 'slug', 'label', 'layout_type', 'icon_code', 'event', 'scope', 'class_type','app_icon','web_icon','image

        $this->validate($request, [
            'name' => 'required|unique:appfiy_component,name,'.$id,
            'label' => 'required',
            'icon_code' => 'required',
            'event' => 'required',
//            'scope' => 'required',
        ],[
            'name.required' => __('appfiy::messages.enterComponentName'),
            'name.unique' => __('appfiy::messages.componentNameMustbeUnique'),
            'label.required' => __('appfiy::messages.enterComponentLabel'),
            'icon_code.required' => __('appfiy::messages.enterIconName'),
            'event.required' => __('appfiy::messages.EnterEvent'),
            'scope.required' => __('appfiy::messages.EnterScope'),
        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        $input['scope'] = json_encode($input['scope']);
        $component = Component::find($id);

        if ($request->file('app_icon') != '') {
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
        }


        DB::beginTransaction();
        try {
            $component->update($input);
            $component->save();
            DB::commit();

            if (isset($input['layout'])){
                foreach ($input['layout'] as $layout){
//                    dd($layout);
                    $layoutProperties = LayoutTypeProperties::where('appfiy_layout_type_group_style',$layout)->where('appfiy_layout_type_style_properties.is_active')
                                        ->join('appfiy_layout_type_group_style','appfiy_layout_type_group_style.property_id','=','appfiy_layout_type_style_properties.id')
                                        ->select([
                                            'appfiy_layout_type_style_properties.name',
                                            'appfiy_layout_type_style_properties.input_type',
                                            'appfiy_layout_type_style_properties.value',
                                            'appfiy_layout_type_style_properties.default_value',
                                        ])
                                        ->get();
                    dd($layoutProperties);
                }
            }

            dd($input['layout']);
            dd('ok');


            Session::flash('message',__('quran::messages.Create Message'));
            return redirect()->route('ayat_list', app()->getLocale());

        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
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
