<?php

namespace Modules\Appfiy\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
//use Illuminate\Http\JsonResponse;
use Modules\Appfiy\Entities\Theme;
use Symfony\Component\HttpFoundation\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Appfiy\Entities\Domain;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    protected $authorization;
    protected $domain;

    public function __construct(Request $request){
        $data = Domain::checkAuthorization($request->header('licence-key'));
        $this->authorization = ($data && $data['auth_type'])?$data['auth_type']:false;
        $this->domain = ($data && $data['domain'])?$data['domain']:'';
    }

    public function checkAuthorization(Request $request){
        if (!$this->authorization){
            $response = new JsonResponse([
                'status'=>Response::HTTP_UNAUTHORIZED,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'message'=>'Unauthorized',
            ],Response::HTTP_UNAUTHORIZED);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        try{
            if ($this->domain) {
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Found',
                    'data' => $this->domain
                ], Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }else{
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Not Found',
                ], Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }

    public function createComponent(Request $request){
        if (!$this->authorization){
            $response = new JsonResponse([
                'status'=>Response::HTTP_UNAUTHORIZED,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'message'=>'Unauthorized',
            ],Response::HTTP_UNAUTHORIZED);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        try{
            $input = $request->post();
            $image = $request->file('image');
            dd($input,$image);
            /*if ($this->domain) {
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Found',
                    'data' => $this->domain
                ], Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }else{
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Not Found',
                ], Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }*/
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }


    public function getTheme(Request $request){
        if (!$this->authorization){
            $response = new JsonResponse([
                'status'=>Response::HTTP_UNAUTHORIZED,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'message'=>'Unauthorized',
            ],Response::HTTP_UNAUTHORIZED);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        try{
            $data = [];
            $themeID = $request->query('id');
            if ($themeID){

                $data = Theme::select([
                    'appfiy_theme.id',
                    'appfiy_theme.name'
                ])->with(
                        array(
                            'globalConfig' => function ($query) {
                                $query->select([
                                    'appfiy_theme_config.theme_id',
                                    'appfiy_theme_config.mode',
//                                    'appfiy_theme_config.name',
//                                    'appfiy_theme_config.slug',
                                    'appfiy_theme_config.global_config_id',
                                ])->where('appfiy_theme_config.is_active',1);
                            }
                        )
                    )
                    ->where('appfiy_theme.id',$themeID)
                    ->where('appfiy_theme.is_active',1)
                    ->where('appfiy_theme.id',$themeID)
                    ->first();

                $finalData = [];
                $finalData['theme_name'] = $data->name;
                $finalData['theme_status'] = 'active';
                $xxx = [];
                if ($data){

                    foreach ($data['globalConfig'] as $config){
                        if (isset($config['mode']) && !empty($config['mode'])) {
                            $configData = DB::table('appfiy_global_config')->select([
                                'id','mode','name','slug','background_color','layout','icon_theme_size','icon_theme_color','shadow','icon','automatically_imply_leading','center_title','flexible_space','bottom','shape_type','shape_border_radius','toolbar_opacity','actions_icon_theme_color','actions_icon_theme_size','title_spacing'
                            ])->where('mode', $config['mode'])->get();
                            $dataArray = [];
                            if (isset($configData) && !empty($configData)) {
                                $finalCon = [];
                                foreach ($configData as $con) {
                                    $con = (array)$con;
                                    $finalCon['general'] = [
                                        'mode'=>$con['mode'],
                                        'name'=>$con['name'],
                                        'slug'=>$con['slug'],
                                        'is_active'=>'no'
                                    ];
                                    $finalCon['properties'] = [
                                        'background_color'=>$con['background_color'],
                                        'layout'=>$con['layout'],
                                        'icon_theme_size'=>$con['icon_theme_size'],
                                        'icon_theme_color'=>$con['icon_theme_color'],
                                        'shadow'=>$con['shadow'],
                                        'icon'=>$con['icon'],
                                        'automatically_imply_leading'=>$con['automatically_imply_leading'],
                                        'center_title'=>$con['center_title'],
                                        'flexible_space'=>$con['flexible_space'],
                                        'bottom'=>$con['bottom'],
                                        'shape_type'=>$con['shape_type'],
                                        'shape_border_radius'=>$con['shape_border_radius'],
                                        'toolbar_opacity'=>$con['toolbar_opacity'],
                                        'actions_icon_theme_color'=>$con['actions_icon_theme_color'],
                                        'actions_icon_theme_size'=>$con['actions_icon_theme_size'],
                                        'title_spacing'=>$con['title_spacing'],
                                    ];
//                                    $con['is_active'] = 'no';
                                    if ($con['id'] == $config['global_config_id']) {
                                        $finalCon['general']['is_active'] = 'yes';
                                    }
                                    $getComponents = DB::table('appfiy_global_config_component')
                                        ->join('appfiy_component', 'appfiy_component.id', '=', 'appfiy_global_config_component.component_id')
                                        ->select(['appfiy_global_config_component.component_id', 'appfiy_global_config_component.component_position',
                                            'appfiy_component.name',
                                            'appfiy_component.slug',
                                            'appfiy_component.label',
                                            'appfiy_component.layout_type_id',
                                            'appfiy_layout_type.slug as layout_type',
                                            'appfiy_component.icon_code',
                                            'appfiy_component.event',
                                            'appfiy_component.scope',
                                            'appfiy_component.class_type',
                                            'appfiy_component.web_icon',
                                            DB::raw('CONCAT("/upload/component-image/", appfiy_component.image) AS image'),
                                            'appfiy_component.is_multiple',
                                        ])
                                        ->join('appfiy_layout_type','appfiy_layout_type.id','=','appfiy_component.layout_type_id')
                                        ->where('appfiy_global_config_component.global_config_id', $con['id'])
                                        ->get()->toArray();

                                    $componentWithStyletest = [];
                                    $componentArrange = [];
                                    foreach ($getComponents as $component) {
                                        $component = (array)$component;
                                        $layoutType = DB::table('appfiy_layout_type')->find($component['layout_type_id']);
                                        $getComponentsStyle = DB::table('appfiy_component_style_properties')->select([
                                            'name', 'input_type', 'value', 'default_value'
                                        ])->where('component_id', $component['component_id'])->get();
                                        $newStyle = [];
                                        foreach ($getComponentsStyle as $sty){
                                            $sty = (array)$sty;
                                            $newStyle[$sty['name']] = $sty['value'];
                                        }
//                                        dd($newStyle);
                                        $componentArrange['general'] = [
                                            'component_position'=>$component['component_position'],
                                            'name'=>$component['name'],
                                            'slug'=>$component['slug'],
                                            'label'=>$component['label'],
                                            'layout_type'=>$component['layout_type'],
                                            'icon_code'=>$component['icon_code'],
                                            'event'=>$component['event'],
                                            'scope'=>$component['scope'],
                                            'class_type'=>$component['class_type'],
                                            'web_icon'=>$component['web_icon'],
                                            'image'=>$component['image'],
                                            'is_multiple'=>$component['is_multiple'],
                                        ];
//                                        $component['style'][$layoutType->slug] = $newStyle;
                                        $componentArrange['style'][$layoutType->slug] = $newStyle;
//                                        $componentWithStyletest[] = $component;
                                        $componentWithStyletest[] = $componentArrange;
                                    }

                                    $finalCon['components'] = $componentWithStyletest;
                                    $dataArray[] = $finalCon;
                                    $xxx[] = $finalCon;
                                }
                            }
                        }
//                        $config[$config['mode'].'_layouts'] = $dataArray;

//                        dd($dataArray);
//                        $finalData['global_cobfig'] =  $dataArray;
//                        $finalData['global_cobfig'][] =  $dataArray;
                        $finalData['global_config'] = $xxx;

                    }
                }


                /*$data = Theme::select([
                    'appfiy_theme.id',
                    'appfiy_theme.name',
                    'appfiy_theme.image',
                    'appfiy_theme.appbar_id',
                    'appfiy_theme.navbar_id',
                    'appfiy_theme.drawer_id',
                    'appfiy_theme.appbar_navbar_drawer',
                ])
                    ->with(
                        array(
                            'globalConfig' => function ($query) {
                                $query->select([
//                                    'appfiy_theme_config.id',
                                    'appfiy_theme_config.theme_id',
                                    'appfiy_theme_config.mode',
                                    'appfiy_theme_config.name',
                                    'appfiy_theme_config.slug',
                                    'appfiy_theme_config.background_color',
                                    'appfiy_theme_config.layout',
                                    'appfiy_theme_config.icon_theme_size',
                                    'appfiy_theme_config.icon_theme_color',
                                    'appfiy_theme_config.shadow',
                                    'appfiy_theme_config.icon',
                                    'appfiy_theme_config.automatically_imply_leading',
                                    'appfiy_theme_config.center_title',
                                    'appfiy_theme_config.flexible_space',
                                    'appfiy_theme_config.bottom',
                                    'appfiy_theme_config.shape_type',
                                    'appfiy_theme_config.shape_border_radius',
                                    'appfiy_theme_config.toolbar_opacity',
                                    'appfiy_theme_config.actions_icon_theme_color',
                                    'appfiy_theme_config.actions_icon_theme_size',
                                    'appfiy_theme_config.title_spacing'
                                ])->where('appfiy_theme_config.is_active',1);
                            },
                            'page' => function ($query) {
                                $query->select([
//                                    'appfiy_theme_page.id',
                                    'appfiy_theme_page.theme_id',
                                    'appfiy_theme_page.page_id',
                                    'appfiy_page.name',
                                    'appfiy_page.slug'
                                ])->join('appfiy_page','appfiy_page.id','=','appfiy_theme_page.page_id');
                            },
                            'component' => function ($query) {
                                $query->select([
//                                    'appfiy_theme_component.id',
                                    'appfiy_theme_component.theme_id',
                                    'appfiy_theme_component.component_parent_id',
                                    'appfiy_theme_component.component_id',
                                    'appfiy_theme_component.theme_config_id',
                                    'appfiy_theme_component.theme_page_id',
                                    'appfiy_component.name',
                                    'appfiy_component.slug',
                                    'appfiy_component.label',
                                    'appfiy_component.layout_type_id',
                                    'appfiy_component.icon_code',
                                    'appfiy_component.event',
                                    'appfiy_component.scope',
                                    'appfiy_component.class_type',
                                    'appfiy_component.web_icon',
                                    DB::raw('CONCAT("/upload/component-image/", appfiy_component.image) AS image'),
                                    'appfiy_component.is_multiple',
                                ])
                                    ->join('appfiy_component','appfiy_component.id','=','appfiy_theme_component.component_id')
                                    ->where('appfiy_component.is_active',1);
                            },
                            'componentStyle' => function ($query) {
                                $query->select([
//                                    'appfiy_theme_component_style.id',
                                    'appfiy_theme_component_style.theme_id',
//                                    'appfiy_theme_component_style.theme_component_id',
                                    'appfiy_theme_component.component_id',
                                    'appfiy_theme_component_style.name',
                                    'appfiy_theme_component_style.input_type',
                                    'appfiy_theme_component_style.value',
                                    'appfiy_theme_component_style.default_value',
                                ])->join('appfiy_theme_component','appfiy_theme_component.id','=','appfiy_theme_component_style.theme_component_id');
                            }
                        )
                    )
                    ->where('appfiy_theme.is_active',1)
                    ->where('appfiy_theme.id',$themeID)
                    ->first();*/
            }

            if (isset($data) && !empty($data)){
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Found',
                    'data' => $finalData,
//                    'data' => $xxx
                ], Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }
            $response = new JsonResponse([
                'status' => Response::HTTP_OK,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'message' => 'Data Not Found',
            ], Response::HTTP_OK);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }catch(Exception $ex){
            return \response([
                'message'=>$ex->getMessage()
            ]);
        }
    }

}
