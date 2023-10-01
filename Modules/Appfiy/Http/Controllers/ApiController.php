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
                    ->first();
            }

            if (isset($data) && !empty($data)){
                $response = new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'url' => $request->getUri(),
                    'method' => $request->getMethod(),
                    'message' => 'Data Found',
                    'data' => $data
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
