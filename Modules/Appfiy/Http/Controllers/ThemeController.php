<?php

namespace Modules\Appfiy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Appfiy\Entities\ComponentLayout;
use Modules\Appfiy\Entities\ComponentProperties;
use Modules\Appfiy\Entities\GlobalConfig;
use Modules\Appfiy\Entities\LayoutTypeProperties;
use Modules\Appfiy\Entities\Theme;

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
        DB::beginTransaction();
        try {
            $theme = new Theme();
            $theme->create($input);
            DB::commit();

            Session::flash('message',__('appfiy::messages.CreateMessage'));
            return redirect()->route('theme_list', [app()->getLocale()]);

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
