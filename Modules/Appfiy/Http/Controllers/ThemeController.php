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
use Modules\Appfiy\Entities\ComponentStyleGroupProperties;
use Modules\Appfiy\Entities\GlobalConfig;
use Modules\Appfiy\Entities\LayoutTypeProperties;
use Modules\Appfiy\Entities\Page;
use Modules\Appfiy\Entities\Theme;
use Modules\Appfiy\Entities\ThemeComponent;
use Modules\Appfiy\Entities\ThemeComponentStyle;
use Modules\Appfiy\Entities\ThemeConfig;
use Modules\Appfiy\Entities\ThemePage;

class ThemeController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(){
        $themes = Theme::select(['appfiy_theme.id','appfiy_theme.name as theme_name','appfiy_theme.appbar_id','appfiy_theme.navbar_id','appfiy_theme.drawer_id'])
                            ->with(
                                array(
                                'appbar' => function ($query) {
                                    $query->select([
                                        'appfiy_global_config.id',
                                        'appfiy_global_config.name as appbar_name'
                                    ])->where('appfiy_global_config.is_active',1);
                                },
                                'navbar' => function ($query) {
                                    $query->select([
                                        'appfiy_global_config.id',
                                        'appfiy_global_config.name as navbar_name'
                                    ])->where('appfiy_global_config.is_active',1);
                                },
                                'drawer' => function ($query) {
                                    $query->select([
                                        'appfiy_global_config.id',
                                        'appfiy_global_config.name as drawer_name'
                                    ])->where('appfiy_global_config.is_active',1);
                                },)
                            )
                            ->where('appfiy_theme.is_active',1)
                            ->orderBy('appfiy_theme.id','DESC')
                            ->paginate(10);

        return view('appfiy::theme/index',['themes'=>$themes]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(){
        $appbars = GlobalConfig::getDropdown('appbar');
        $navbars = GlobalConfig::getDropdown('navbar');
        $drawers = GlobalConfig::getDropdown('drawer');
        return view('appfiy::theme/add',['appbars'=>$appbars,'navbars'=>$navbars,'drawers'=>$drawers]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:appfiy_theme,name,',
            'appbar_id' => 'required',
            'navbar_id' => 'required',
            'drawer_id' => 'required',
        ],[
            'name.required' => __('appfiy::messages.enterThemeName'),
            'name.unique' => __('appfiy::messages.themeNameMustbeUnique'),
            'appbar_id.required' => __('appfiy::messages.chooseAppbar'),
            'navbar_id.required' => __('appfiy::messages.chooseNavbar'),
            'drawer_id.required' => __('appfiy::messages.chooseDrawer'),
        ]);

        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        $array = [];
        array_push($array,$input['appbar_id']);
        array_push($array,$input['navbar_id']);
        array_push($array,$input['drawer_id']);
        $input['appbar_navbar_drawer'] = json_encode($array);
        $getAllPages = Page::where('is_active',1)->get()->toArray();

        DB::beginTransaction();
        try {
            $theme = Theme::create($input);
            if (count($array)>0){
                foreach ($array as $val){
                    $globalConfig = GlobalConfig::find($val);
                    ThemeConfig::create([
                        'theme_id' => $theme->id,
                        'global_config_id' => $val,
                        'mode' => $globalConfig->mode,
                        'name' => $globalConfig->name,
                        'slug' => $globalConfig->slug,
                        'background_color' => $globalConfig->background_color,
                        'layout' => $globalConfig->layout,
                        'icon_theme_size' => $globalConfig->icon_theme_size,
                        'icon_theme_color' => $globalConfig->icon_theme_color,
                        'shadow' => $globalConfig->shadow,
                        'icon' => $globalConfig->icon,
                        'automatically_imply_leading' => $globalConfig->automatically_imply_leading,
                        'center_title' => $globalConfig->center_title,
                        'flexible_space' => $globalConfig->flexible_space,
                        'bottom' => $globalConfig->bottom,
                        'shape_type' => $globalConfig->shape_type,
                        'shape_border_radius' => $globalConfig->shape_border_radius,
                        'toolbar_opacity' => $globalConfig->toolbar_opacity,
                        'actions_icon_theme_color' => $globalConfig->actions_icon_theme_color,
                        'actions_icon_theme_size' => $globalConfig->actions_icon_theme_size,
                        'title_spacing' => $globalConfig->title_spacing,
                    ]);
                }
            }
            if (count($getAllPages)>0){
                foreach ($getAllPages as $page){
                    $themePage = ThemePage::create([
                        'theme_id' => $theme->id,
                        'page_id' => $page['id'],
                        'persistent_footer_buttons' => $page['persistent_footer_buttons'],
                        'background_color' => $page['background_color'],
                        'border_color' => $page['border_color'],
                        'border_radius' => $page['border_radius'],
                    ]);
                    $pageWiseComponents = Component::where('scope','LIKE','%'.$page['slug'].'%')->where('is_active',1)->get()->toArray();
                    if (count($pageWiseComponents)>0){
                        foreach ($pageWiseComponents as $component){
                            $themeComponent = ThemeComponent::create([
                                'theme_id' =>$theme->id,
                                'component_id' =>$component['id'],
                                'theme_page_id' =>$themePage->id,
                                'display_name' =>$component['name'],
                                'clone_component' =>3
                            ]);
                            $getComponentStyles = ComponentStyleGroupProperties::where('is_active',1)->where('component_id',$component['id'])->get()->toArray();
                            if (count($getComponentStyles)>0){
                                foreach ($getComponentStyles as $style) {
                                    ThemeComponentStyle::create([
                                        'theme_id' => $theme->id,
                                        'theme_component_id' => $themeComponent->id,
                                        'name' => $style['name'],
                                        'input_type' => $style['input_type'],
                                        'value' => $style['value'],
                                        'style_group_id' => $style['style_group_id'],
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();

            if (isset($theme->id)){
                Session::flash('message',__('appfiy::messages.CreateMessage'));
                return redirect()->route('theme_attribute_edit', [app()->getLocale(),$theme->id]);
            }
//            Session::flash('message',__('appfiy::messages.CreateMessage'));
//            return redirect()->route('theme_list', [app()->getLocale()]);

        } catch (\Exception $e) {
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function attributeEdit($ln,$id){
        $themeDetails = Theme::find($id);
        return view('appfiy::theme/edit',['themeDetails'=>$themeDetails]);
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
