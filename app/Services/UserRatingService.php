<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */
namespace App\Services;

use App\Models\UserRating;

/**
 * Class UserService
 * @package App\Services
 */
class UserRatingService
{


    function __construct()
    {
    }

    /**
     * @param $criteria
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    function getList($criteria = [])
    {
        $res = $this->resolveCriteria($criteria)->get();
        return $res;
    }


    protected function resolveCriteria($data = [])
    {
        $query = UserRating::Query();

        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        }

        if (array_key_exists('user_rating_id', $data)) {
            $query = $query->where('id', $data['user_rating_id']);
        }

        if (array_key_exists('user_id', $data)) {
            $query = $query->where('user_id', $data['user_id'] );
        }

        if (array_key_exists('item_id', $data)) {
            $query = $query->where('item_id', $data['item_id'] );
        }

        if (array_key_exists('rating', $data)) {
            $query = $query->where('rating', $data['rating'] );
        }


        if (array_key_exists('created_at', $data)) {
            $query = $query->where('created_at', "LIKE", $data['created_at'] . "%");
        }

        if (array_key_exists('limit', $data) && array_key_exists('offset', $data)) {
            $query = $query->take($data['limit']);
            $query = $query->skip($data['offset']);
        }

        return $query;
    }

    function create($dataIn = [], UserRating &$UserRating)
    {

        $this->mapDataModel($dataIn, $UserRating);

        $UserRating->save();
    }

    public function mapDataModel($data, UserRating &$model)
    {
        $attribute = [
          	'id',
			'user_id',
			'item_id',
			'rating'
        ];

        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                if($val == 'password')
                {
                    $model->$val = bcrypt($data[$val]);
                }else {
                    $model->$val = $data[$val];
                }
            }
        }
    }

    function update($dataIn = [], UserRating &$UserRating)
    {

        $this->mapDataModel($dataIn, $UserRating);
        $UserRating->save();
    }

    function delete($id)
    {

        $res = $this->getOne($id);

        $res->delete();
    }

    function getOne($id)
    {
        $res = UserRating::findOrFail((int)$id);
        return $res;
    }
    public function disp_rating($id)
    {

        $rating_data = Self::getList(['item_id'=>$id]);
        $rating=0;

        for ($i=0;$i<count($rating_data);$i++){
            $rating = $rating + $rating_data[$i]['rating'];
        }

        if($rating>0)
            $rating = intval($rating/count($rating_data));

        $result='';

        for($i=1;$i<=5;$i++){
            if($i<=$rating)
                $result  .='<li><i class="fa fa-star-o"></i></li>';
            else
                $result  .='<li class="no-star"><i class="fa fa-star-o"></i></li>';
        }

        return $result;
    }

}
