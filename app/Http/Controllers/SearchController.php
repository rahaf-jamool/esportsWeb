<?php

namespace App\Http\Controllers;

use App\Facades\ArticleService;
use App\Facades\ArticlesService;
use App\Facades\CustomerService;
use App\Facades\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @param $keyword
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($value == '')
                    unset($data[$key]);
            }
        }
        //$data['limit'] = 12;
        //$data['offset'] = 0;
		$i=0;
		$delay=0;
        $pageInfo['title'] = trans('all.searchtitle');
        if (array_key_exists('search_in', $data)) {
            switch ($data['search_in']) {
                case 'company':
                    {
                        $list = CustomerService::getList($data);
                        return view('search.list-customers', compact('pageInfo', 'data', 'list', 'i', 'delay'));
                        break;
                    }
                case 'articles':
                    {
                        $list = ArticlesService::getList($data);
                        return view('search.list-articles', compact('pageInfo', 'data', 'list', 'i', 'delay'));

                        break;
                    }
                default:
                case 'items':
                    {
						$featuredAds = ArticlesService::getList(['type'=>2]);
                        $list = ItemService::getList($data);
                        return view('search.list-items', compact('pageInfo', 'data', 'list', 'i', 'featuredAds', 'delay'));

                        break;
                    }
            }
        } else {
            $list = ArticlesService::getList($data);
            return view('search.list-articles', compact('pageInfo', 'data', 'list', 'i', 'delay'));
        }
    }

    public function ajax_search(Request $request, $lang, $offset = 0)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();
                if (!array_key_exists('filter' , $data)) {
                    $data['filter'] = 0;
                }
                if (array_key_exists('search_in', $data)) {
                    switch ($data['search_in']) {
                        case 'company':
                            {

                                $dataarray['limit'] = 6;
                                $dataarray['offset'] = (int)$offset;
                                if ($data['filter'] == 1) {
                                    if ($data['orderBy'] != '')
                                        $dataarray['customorder'] = $data['orderBy'];
                                    if ($data['limit'] != '')
                                        $dataarray['limit'] = $data['limit'];

                                    if (array_key_exists('Princedom_ID', $data) && $data['Princedom_ID'] != '')
                                        $dataarray['Princedom_ID'] = $data['Princedom_ID'];

                                }
                                if (isset($data['keyword']) && $data['keyword'] != '')
                                    $dataarray['keyword'] = $data['keyword'];
                                if (isset($data['typework']) && $data['typework'] != '')
                                    $dataarray['typework'] = $data['typework'];

                                $list = CustomerService::getList($dataarray);
                                return response()->json([
                                    'error' => false,
                                    'result' => [
                                        'view' => (string)view('search.list-customer-ajax', compact('list')),
                                        'last_item' => (count($list) == 0 ? true : false)
                                    ],
                                ]);
                                break;
                            }
                        case 'articles':
                            {
                                $dataarray['limit'] = 6;
                                $dataarray['offset'] = (int)$offset;
                                $dataarray['orderBy'] = 'post_date';
                                if ($data['filter'] == 1) {
                                    if ($data['orderBy'] != '') {
                                        $dataarray['customorder'] = $data['orderBy'];
                                        unset($dataarray['orderBy']);
                                    }

                                    if ($data['limit'] != '')
                                        $dataarray['limit'] = $data['limit'];

                                    if (array_key_exists('type_ID', $data) && $data['type_ID'] != '')
                                        $dataarray['type'] = $data['type_ID'];
                                }
                                if (isset($data['keyword']) && $data['keyword'] != '')
                                    $dataarray['keyword'] = $data['keyword'];
                                if (isset($data['type']) && $data['type'] != '')
                                    $dataarray['type'] = $data['type'];
                                $list = ArticlesService::getList($dataarray);
                                $view_page = view('search.list-articles-ajax', compact('pageInfo', 'list'))->render();
                                return response()->json([
                                    'error' => false,
                                    'result' => [
                                        'view' => (string)$view_page,
                                        'last_item' => (count($list) == 0 ? true : false)
                                    ],
                                ]);
                                break;
                            }
                        default:
                        case 'items':
                            {
                                $dataarray['is_visible'] = 1;
                                $dataarray['is_accepted'] = 1;
                                $dataarray['limit'] = 6;
                                $dataarray['offset'] = (int)$offset;

                                if ($data['filter'] == 1) {
                                    if ($data['orderBy'] != '')
                                        $dataarray['customorder'] = $data['orderBy'];
                                    if ($data['limit'] != '')
                                        $dataarray['limit'] = $data['limit'];
                                    if ($data['show'] == '')
                                        $data['show'] = 1;

                                }
                                if (isset($data['keyword']) && $data['keyword'] != '')
                                    $dataarray['keyword'] = $data['keyword'];
                                if (isset($data['parent']) && $data['parent'] != '')
                                    $dataarray['parent'] = $data['parent'];
                                $list = ItemService::getList($dataarray);
                                $view = view('search.list-items-ajax', compact('list', 'offset'))->render();
                                return response()->json([
                                    'error' => false,
                                    'result' => [
                                        'view' => $view,
                                        'last_item' => (count($list) == 0 ? true : false)
                                    ],
                                ]);
                                break;
                            }
                    }
                } else {
		
                    $dataarray['is_visible'] = 1;
                    $dataarray['is_accepted'] = 1;
                    $dataarray['limit'] = 12;
                    $dataarray['offset'] = (int)$offset;

                    if ($data['filter'] == 1) {
                        if ($data['orderBy'] != '')
                            $dataarray['customorder'] = $data['orderBy'];
                        if ($data['limit'] != '')
                            $dataarray['limit'] = $data['limit'];
                        if ($data['show'] == '')
                            $data['show'] = 1;
                    }
                    if (isset($data['keyword']) && $data['keyword'] != '')
                        $dataarray['keyword'] = $data['keyword'];
                    if (isset($data['parent']) && $data['parent'] != '')
                        $dataarray['parent'] = $data['parent'];
                    $list = ItemService::getList($dataarray);
                    $view = view('search.list-items-ajax', compact('list', 'offset'))->render();
                    return response()->json([
                        'error' => false,
                        'result' => [
                            'view' => $view,
                            'last_item' => (count($list) == 0 ? true : false)
                        ],
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'data' => $data,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
}
