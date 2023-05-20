<?php

namespace App\Http\Controllers;

use App\Facades\BlocksService;
use App\Facades\PagesService;
use App\Helpers\General\EndPoints;
use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Validator;
use App\Services\ApiService;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     */

    public $data =  array();

    public function __construct()
    {}

    public function index($locale, $id)
    {
        if($id == 4) {
            $pageInfo['title'] = trans('site.currentboard');
            $members = ApiService::GetDataByEndPoint(EndPoints::GetBlockGetPagedByCategoryApi . 10 . '?OrderColumn=Order&OrderType=ASC',  session('mainToken'));          //dd($members);
            return view('links.list', compact('pageInfo','members'));
        } elseif ($id == 5) {
//            dd(session('mainToken'));
            $pageInfo['title'] = trans('site.OrganizationalChart');
            $pages = ApiService::GetDataByEndPoint(EndPoints::GetBlockGetPagedByCategoryApi . 9 . '?OrderColumn=Order&OrderType=ASC',  session('mainToken'));
//            dd($pages);
            return view('links.view', compact('pageInfo','pages'));
        }  else {
            $page = PagesService::getOne($id);
          // dd($page['attachments'][0]['path']);
            $pageInfo['title'] = $page['name'];
            return view('links.page-details', compact('pageInfo', 'page'));
        }

    }
    public function index1($locale, $id)
    {
        $page = ApiService::GetDataByEndPoint(EndPoints::GetMenuesApi . '/' . $id, session('mainToken'));
        $page= $page['result'];
        //dd( $page);
        return view('links.view1', compact('page'));
    }

//    public function view($locale, $id)
//    {
//        $response = ApiService::GetDataByEndPoint(EndPoints::GetBlockInfoApi . $id,  session('mainToken'));
//        $page = $response['result'];
//        $pageInfo['title'] = trans('site.OrganizationalChart') . ' - ' . getTranslate($page, 'name');
//        $pageInfo['keywords'] = trans('site.home-keywords');
//        $pageInfo['description'] = trans('site.description');
////            dd($page);
//        return view('links.view-details', compact('pageInfo','page'));
//    }


    public function contact($locale)
    {
        // $result = BlocksService::getOne(1);
       //  dd( $result);
        // $pageInfo['title']  = $result->translation(App::getLocale())->name;
        $pageInfo['title']  = trans('site.contact');
        $pageInfo['keywords'] = trans('site.home-keywords');
        $pageInfo['description'] = trans('site.description');
        return view('pages.contact' , compact('pageInfo'));
    }


    // public function newsletter(Request $request)
    // {
    //     try
	// 	{
	// 		$data = $request->all();

	// 		$email = MailingService::getList(['email'=>$data['email']]);

	// 		if($email->isNotEmpty())
	// 			return 0;

	// 		$newsletter =new Mailing();

	// 		MailingService::create($data,$newsletter);

	// 		return 1;

	// 	}catch (\Exception $e) {
	// 		dd($e->getMessage());
	// 	}
    // }

    public function sendMail(Request $request)
    {
        if ($request->ajax())
        {
            $this->data =  array('name' => $request->input('name'),
                'email'=> $request->input('email') ,
                'title'=> $request->input('title') ,
                'msg' => $request->input('message'));
            $v = Validator::make(
                array('name' => $request->input('name') ,
                    'email'=> $request->input('email') ,
                    'title'=> $request->input('title') ,
                    'message' => $request->input('message'))
                ,array(
                'name' => 'required|max:255',
                'email' => 'required|email',
                'title' => 'required',
                'message' => 'required'));
            if($v->fails()){
                $errors = $v->errors();
                $txt = "";
                if ( ! empty( $errors ) ) {
                    foreach ($errors->all() as $message){
                        $txt .= '<div class="text-danger"><p>' . $message . '</p></div>';
                    }

                }
               return response()->json([
                    'error' => true,
                    'result' => $txt,
                ]);
            }else{
				Mail::to(config('mail.webmaster')['address'])->send(new ContactUs($this->data));

                Mail::to($this->data['email'])->send(new ContactUs($this->data));
                return response()->json([
                    'error' => false,
                    'result' => 1,
                ]);
            }
        }else{
            abort(403 , 'Unauthorized action');
        }
    }
    // public function rfq($symbol)
    // {
    //     $pageInfo['title']  = trans('all.rfq');
    //     $pageInfo['description']  = 'description';

    //     return view('rfq.view' , compact('pageInfo'  ));
    // }

    // public function rfqadd(RfqRequest $request)
    // {
    //     $pageInfo['title'] = trans('all.rfq');


    //     $model = New Rfq();
    //     $dataIn = $request->all();

    //     $dataIn['Agreed']=1;
    //     //var_dump($dataIn);
    //     try {
    //         $rfq = RfqService::create($dataIn, $model);
    //     } catch (\Exception $e) {
    //         dd($e);
    //         return redirect(config('app.symbol') . '/rfq')->withInput()->withErrors(trans("user.create-error"));
    //     }

    //     $data = $dataIn;
    //     $data['notification_title']=trans('all.rfq');
    //     $data['notification_type']=4;
    //     $data['item_name']=$dataIn['Keywords'];
    //     Mail::to(config('mail.webmaster')['address'])->send(new Notification($data));
    //     Mail::to(Auth::user()->username)->send(new Notification($data));

    //     return redirect(config('app.symbol') . '/')->with('success', trans('all.success'));
    // }

}
