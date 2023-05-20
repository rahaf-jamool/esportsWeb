<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */
namespace App\Services;

use App\Models\SiteStaticPage;
use Illuminate\Support\Facades\Storage;

/**
 * Class ArticleService
 * @package App\Services
 */
class SiteStaticPageService {


    function __construct()
    {
    }

    protected function resolveCriteria($data = [])
    {
        $query = SiteStaticPage::Query();
        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        }else{
            $query = $query->select("site_static_pages.*");
        }

        if (array_key_exists('id', $data)) {
            $query = $query->where('id', $data['id']);
        }


        if (array_key_exists('keyword', $data)) {

            $query = $query->where('site_static_pages.ar_page_data', 'LIKE', "%" . $data['keyword'] . "%");
            $query = $query->orWhere('site_static_pages.en_page_data', 'LIKE'  , "%" . $data['keyword'] ."%");
            $query = $query->orWhere('site_static_pages.ar_comment', 'LIKE'  , "%" . $data['keyword'] ."%");
            $query = $query->orWhere('site_static_pages.en_comment', 'LIKE'  , "%" . $data['keyword'] ."%");
        }


        if( array_key_exists('ar_page_data' , $data))
        {
            $query = $query->where('ar_page_data' , $data['ar_page_data'] );
        };


        if (array_key_exists('en_page_data', $data)) {
            $query = $query->where('site_static_pages.en_page_data', $data['en_page_data']);
        }

        if (array_key_exists('ar_comment', $data)) {
            $query = $query->where('site_static_pages.ar_comment',$data['ar_comment']);
        }

        if (array_key_exists('en_comment', $data)) {
            $query = $query->where('site_static_pages.en_comment',$data['en_comment']);
        }

        if( array_key_exists('created_at' , $data))
        {
            $query = $query->where('site_static_pages.created_at' , 'LIKE' ,'%'.$data['created_at'].'%' );
        }

        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'] , 'DESC');
        }


        if (array_key_exists('limit', $data) && array_key_exists('offset', $data)) {
            $query = $query->take($data['limit']);
            $query = $query->skip($data['offset']);
        }

        return $query;
    }

    function getOne($id , $slug = ''){
        if($id > 0){
            $res = SiteStaticPage::findOrFail($id);
                return $res;
        }else{
            $res  = $this->resolveCriteria(['slug'=> $slug])->firstOrFail();
            return $res;

        }
    }

    /**
     * @param $criteria
     */
    function getList($criteria = []){
        $res = $this->resolveCriteria($criteria)->get();
        return $res;

    }

    function create( $dataIn = [], SiteStaticPage &$sitestaticpage){
		
        $this->mapDataModel($dataIn , $sitestaticpage);

        $SiteStaticPage->save();
    }

    function update($dataIn = [] , SiteStaticPage &$sitestaticpage){
		
        $this->mapDataModel($dataIn , $sitestaticpage);
        $SiteStaticPage->save();
    }

    function delete($id){

        $res = $this->getOne($id);
        $res->delete();
    }

    //toDo Assign  Created By  To Logged User
    public function mapDataModel($data, SiteStaticPage &$model)
    {
        $attribute = [	
			'id',
			'ar_page_data',
			'en_page_data',
			'ar_comment',
			'en_comment',
			'style_page',
			'style_page_title',
			'style_page_details',
			'link_position'
        ];

        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                $model->$val = $data[$val];
            }
        }
    }
}
