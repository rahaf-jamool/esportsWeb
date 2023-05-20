<?php

namespace App\Http\Controllers;

use App\Facades\BlocksService;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use App\Services\OnlineService;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Image;
class ArticlesController extends Controller
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
     * @param $locale
     * @param int $article_type_id
     * @return \Illuminate\Http\Response
     */
    // public function index($locale, $article_type_id, $slug = '')
    public function index()
    {
        $pageInfo['title'] = trans('site.news');
        $query = EndPoints::GetBlockGetPagedByCategoryApi . 7 . '?PageNumber=0&PageSize=10';
        $news = ApiService::GetDataByEndPoint($query, session('mainToken'));
        return view('articles.news.list', compact('pageInfo','news'));
    }

    public function view($local,$id){
        $pageInfo['title'] = trans('site.news');
        $new = BlocksService::getOne($id);
        return view('articles.news.view', compact('pageInfo','new'));
    }

    public function get_galleries(){
        $pageInfo['title'] = trans('site.gallery');
        $query = EndPoints::GetBlockGetPagedByCategoryApi . 5 . '?PageNumber=0&PageSize=10';
        $galleries = ApiService::GetDataByEndPoint($query, session('mainToken'));
        return view('articles.gallery.list-gallery', compact('pageInfo','galleries'));
    }

    public function view_gallery($local, $id){
        $pageInfo['title'] = trans('site.gallery');
        $gallery = BlocksService::getOne($id);
        //  dd($gallery);
        return $gallery;
    }

    public function get_videos(){
        $pageInfo['title'] = trans('site.videos');
        $query = EndPoints::GetBlockGetPagedByCategoryApi . 6 . '?PageNumber=0&PageSize=10';
        $videos = ApiService::GetDataByEndPoint($query, session('mainToken'));
        return view('articles.videos.list-video', compact('pageInfo','videos'));
    }


    public function sendArticleRequest(ArticleRequest $request)
    {

        $token = session()->has('token') ? session('token') : null;
        if ($request->ajax() && !is_null($token)) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();
              //  dd($data);
                $data['clientId']= $user['clientId'];
                $data['clientName']= $user['name'];
                $data['accepted']= false;
                $data['isActive']= false;
                $data['requestDate']= Carbon::now()->toDateTimeString();
                $mainImage = $this->uploadFiles($request, 'mainImage');
                $files = $this->uploadFiles($request, 'attachments');
                $data['mainImage'] = $mainImage;
                $data['attachments'] = $files;
              //  dd($data);
                $response = ApiService::PostDataByEndPoint(EndPoints::CreateClientArticlesApi, $data, $token);
        //                dd($response);

                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        return 'Server Error, Method Not Allowed';
    }
    public function EditArticleRequest(Request $request)
    {
        $token = session()->has('token') ? session('token') : null;
        if ($request->ajax() && !is_null($token)) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();
            //dd($data['attachments']);
                $data['clientId']= $user['clientId'];
                $data['clientName']= $user['name'];
                $data['requestDate']= Carbon::now()->toDateTimeString();
               // $mainImage = $this->uploadFiles($request, 'mainImage');
               // $files = $this->uploadFiles($request, 'attachments');
              //  $data['mainImage'] = $mainImage;
              //  $data['attachments'] = $files;
           //   dd($data);

                if (!$data['mainImage'] == 'null') {
                    $mainImage = $this->uploadFiles($request, 'mainImage');
                    $data['mainImage'] = $mainImage;
                }

                 if (!$data['attachments'] == 'undefined') {
                    $files = $this->uploadFiles($request, 'attachments');
                    $data['attachments'] = $files;
                 } else {
                    $data['attachments'] = [];
                 }

                $response = ApiService::PostDataByEndPoint(EndPoints::UpdateClientArticleApi, $data, $token);
        //                dd($response);

                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        return 'Server Error, Method Not Allowed';
    }




    private function uploadFiles($request, $type)
    {
        if ($request->hasFile($type)) {
            $uploadFile = $request->file($type);
            if (is_array($uploadFile)) {
                foreach($uploadFile as $upload) {
                    $imgBase64String = base64_encode(file_get_contents($upload));
                    $fileSize = $upload->getSize();
                    $fileNameWithExt = $upload->getClientOriginalName();                    // ex : (example.png)
                    $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);  // ex : (example)
                    $fileExtension = $upload->getClientOriginalExtension();                 // ex : (png)
                    $mimeType = $upload->getClientMimeType();                               // ex : (image/jpeg)
                    $imgFile = [];
                    $imgFile['data'] = $imgBase64String;
                    $imgFile['fileType'] = $mimeType;
                    $imgFile['size'] = $fileSize;
                    $imgFile['name'] = $fileNameWithExt;
                    $file['entityName'] = 'Articles';
                    $file['name'] = $fileNameWithExt;
                    $file['type'] = $mimeType;
                    $file['size'] = $fileSize;
                    $file['isImage'] = explode('/', $mimeType)[0] == 'image' ? true : false;
                    $file['fileData'] = $imgFile;
                    $files[] = $file;
                }
                return $files;
            } else {
                $imgBase64String = base64_encode(file_get_contents($request->file($type)));
                $fileSize = $uploadFile->getSize();
                $fileNameWithExt = $uploadFile->getClientOriginalName();                    // ex : (example.png)
                $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);  // ex : (example)
                $fileExtension = $uploadFile->getClientOriginalExtension();                 // ex : (png)
                $mimeType = $uploadFile->getClientMimeType();                               // ex : (image/jpeg)
                $imgFile = [];
                $imgFile['data'] = $imgBase64String;
                $imgFile['fileType'] = $mimeType;
                $imgFile['size'] = $fileSize;
                $imgFile['name'] = $fileNameWithExt;
                $file['image'] = $imgFile;
                return $imgFile;
            }
        }
    }


    public function ckeditorUpload(Request $request)
    {
      if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
       $fileName = $fileName.'_'.time().'.'.$extension;

       $request->file('upload')->move(public_path('ckeditor_images'), $fileName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('ckeditor_images/'.$fileName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
      }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName,PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName. '_' . '.' .$extension;


            $request->file('upload')->move(public_path('images'),$fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName);
            $msg = 'Image uploaded successfuly';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            // //get filename with extension
            // $filenamewithextension = $request->file('upload')->getClientOriginalName();

            // //get filename without extension
            // $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            // //get file extension
            // $extension = $request->file('upload')->getClientOriginalExtension();

            // //filename to store
            // $filenametostore = $filename.'_'.time().'.'.$extension;

            // //Upload File
            // $request->file('upload')->storeAs('public/uploads', $filenametostore);
            // $request->file('upload')->storeAs('public/uploads/thumbnail', $filenametostore);

            // //Resize image here
            // $thumbnailpath = public_path('storage/uploads/thumbnail/'.$filenametostore);
            // $img = Image::make($thumbnailpath)->resize(500, 150, function($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $img->save($thumbnailpath);

            // echo json_encode([
            //     'default' => asset('storage/uploads/'.$filenametostore),
            //     '500' => asset('storage/uploads/thumbnail/'.$filenametostore)
            // ]);
        }
    }


    public function showArticleRequest($local,  $id)
    {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $response = ApiService::GetDataByEndPoint(EndPoints::GetArticlesApi . '/' . $id, session('mainToken'));
                $response = $response['result'];
            //    dd($response);
              return response()->json(['success' =>   $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }

    }


    public function deleteArticleRequest(Request $request)
    {
        //        dd( $request->all());
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
                // dd( $data);
                $id =  $data['id'];
              // $response = ApiService::PostDataByEndPoint(EndPoints::DeleteClientArticleApi. '/' . $id,  $token);
               $response = ApiService::PostDataByEndPoint(EndPoints::DeleteClientArticleApi. '/' . $id, $data, $token);
              //dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }
}
