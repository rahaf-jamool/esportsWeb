<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */
namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

/**
 * Class MediaService
 * @package App\Services
 */
class MediaService
{


    function __construct()
    {
    }

    protected function resolveCriteria($data = [])
    {
        $query = Media::Query();
        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        } else {
            $query = $query->select("*");
        }

        if (array_key_exists('media_id', $data)) {
            $query = $query->where('id', $data['media_id']);
        }


        if (array_key_exists('media_pid', $data)) {
            $query = $query->where('media_pid', $data['media_pid']);
        }

        if (array_key_exists('is_visible', $data)) {
            $query = $query->where('is_visible', $data['is_visible']);
        }else{
            $query = $query->where('is_visible',1);
        }

        if (array_key_exists('built_in_id', $data)) {
            $query = $query->where('built_in_id', $data['built_in_id']);
        }


        if (array_key_exists('lang', $data)) {
            $query = $query->where('lang', $data['lang']);
        }


        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'], 'ASC');
        } else {
            $query = $query->orderBy('record_order', 'ASC');
        }


        if (array_key_exists('limit', $data) && array_key_exists('offset', $data)) {
            $query = $query->take($data['limit']);
            $query = $query->skip($data['offset']);
        }

        return $query;
    }

    function getOne($id, $slug = '')
    {
        if ($id > 0) {
            $res = Media::findOrFail($id);
            return $res;
        } else {
            $res = $this->resolveCriteria(['slug' => $slug])->firstOrFail();
            return $res;

        }
    }

    /**
     * @param $criteria
     */
    function getList($criteria = [])
    {
        $res = $this->resolveCriteria($criteria)->get();
        return $res;

    }

    function create($dataIn = [], Media &$media)
    {
        // $dataIn['slug'] = make_slug($dataIn['title'] , '-') ;
        if (array_key_exists('icon', $dataIn)) {
            $dataIn['icon'] = $dataIn['icon']->store('icon');
        }

        $this->mapDataModel($dataIn, $media);

        $media->save();
    }

    function update($dataIn = [], Media &$media)
    {

        if (array_key_exists('icon', $dataIn)) {
            $dataIn['icon'] = $dataIn['icon']->store('icon');
        }

        $this->mapDataModel($dataIn, $media);
        $media->save();
    }

    function delete($id)
    {
        $res = $this->getOne($id);
        if (Storage::exists($res->icon)) {
            Storage::delete($res->icon);
        }
        $res->delete();
    }

    public function mapDataModel($data, Media &$model)
    {
        $attribute = [
             'name'
            ,'media_pid'
            ,'record_order'
            ,'is_visible'
            ,'built_in_id'
            ,'lang'
            ,'icon'
            ,'added_user'
            ,'added_date'
            ,'updated_user'
            ,'updated_date'
            ,'number_news'
            ,'numder_news_in_md_row'
            ,'numder_news_in_sm_row'
            ,'media_background_image'
            ,'media_background_color'
            ,'title_bachground_image'
            ,'title_background_color'
            ,'inner_media_style'
            ,'inner_media_image_style'
            ,'inner_media_title_style'
            ,'inner_page_style'
            ,'inner_page_image_style'
            ,'inner_page_title_style'
        ];

        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                $model->$val = $data[$val];
            }
        }
    }
}
