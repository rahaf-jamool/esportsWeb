<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */

namespace App\Services;

use App\Services\ApiService;
use App\Helpers\General\CollectionHelper;
use App\Helpers\General\EndPoints;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    private $token;

    function __construct() {
        $this->token = session()->has('mainToken') ? session('mainToken') : null;
    }

    function getList(){
        // return $this->token;
        // return $this->token;
        // if(!is_null($this->token)){
           $arrayResponse = ApiService::GetDataByEndPoint(EndPoints::GamesApi,$this->token);
        //    $lists = json_decode($arrayResponse);
           $lists = collect($arrayResponse);
            return $lists;
        // }
    }
//     function getList($categoryId, $number = null, $exceptId = null)
//     {
//         if (!is_null($this->token)) {
//             $arrayResponse = ApiService::GetDataByEndPoint(EndPoints::allProductsForCategoryApi . $categoryId, $this->token);
//             $collection = collect($arrayResponse);
//             $list = collect([]);
//             foreach($collection as $product) {
//                 if (is_null($exceptId)) {
//                     $model = new Product();
//                     $this->mapDataModel($product, $model);
//                     $list->push($model);
//                 } else {
//                     if ($product['id'] != $exceptId) {
//                         $model = new Product();
//                         $this->mapDataModel($product, $model);
//                         $list->push($model);
//                     }
//                 }
//             }
//             if (!is_null($number)) {
//                 return CollectionHelper::paginate($list, $number);
//             } else {
//                 return $list;
//             }
//         }
//     }


//     function getLatestProductList($number)
//     {
//         try {
//             if (!is_null($this->token)) {
//                 $arrayResponse = ApiService::GetDataByEndPoint(EndPoints::lastAddedProductsApi . $number, $this->token);
//                 $collection = collect($arrayResponse);
//                 $list = collect([]);
//                 foreach ($collection as $product) {
//                     $model = new Product();
//                     $this->mapDataModel($product, $model);
//                     $list->push($model);
//                 }
//                 return $list;
//             }
//         } catch (\Exception $e) {
//             return $e->getMessage();
//         }
//     }

//     function getOne($id)
//     {
//         try {
//             if (!is_null($this->token) && $id > 0) {
//                 $response = ApiService::GetDataByEndPoint(EndPoints::productApi . $id, $this->token);
// //                dd($response);
//                 if (!isset($response['details']['error'])) {
//                     $model = new Product();
//                     $this->mapDataModel($response['result'], $model);
//                     return $model;
//                 } else {
//                     return $this->getOldOne($id);
//                 }
//             }
//         } catch (\Exception $e) {
//             return $e->getMessage();
//         }
//     }

//     function getCustomProperties($id)
//     {
//         try {
//             if (!is_null($this->token) && $id > 0) {
//                 return ApiService::GetDataByEndPoint(EndPoints::productCustomPropertiesApi . $id, $this->token);
//             }
//         } catch (\Exception $e) {
//             return $e->getMessage();
//         }
//     }

//     function getProductBulkPrices()
//     {
//         try {
//             if (!is_null($this->token)) {
//                 return ApiService::GetDataByEndPoint(EndPoints::productBulkPricesApi, $this->token);
//             }
//         } catch (\Exception $e) {
//             return $e->getMessage();
//         }
//     }

    // function create($dataIn = [], Product &$model)
    // {
    //     $this->mapDataModel($dataIn, $model);
    //     $model->save();
    // }

    // function update($dataIn = [], Product &$model)
    // {
    //     $this->mapDataModel($dataIn, $model);
    //     $model->save();
    // }

    // function delete($id)
    // {
    //     $res = $this->getOne($id);
    //     $res->delete();
    // }

    // public function paginate($criteria = [], $number, $relation = null)
    // {
    //     if (is_null($relation)) {
    //         return $this->resolveCriteria($criteria)->paginate($number);
    //     } else {
    //         return $this->resolveCriteria($criteria)->with($relation)->paginate($number);
    //     }
    // }


    // public function mapDataModel($data, Product &$model)
    // {
    //     $attribute = [
    //         "Id",
    //         "Name",
    //         "Description",
    //         "ProductCategoryName",
    //         "ProductCategoryId",
    //         "UnitName",
    //         "UnitId",
    //         "CurrencyName",
    //         "CurrencySymbol",
    //         "CurrencyRatio",
    //         "CurrencyId",
    //         "Brand",
    //         "Weight",
    //         "SellPrice",
    //         "BuyPrice",
    //         "Order",
    //         "IsAccepted",
    //         "IsVisible",
    //         "IsDeleted",
    //         "Images",
    //         "ImagesToUpload",
    //         "ImagesChanged",
    //         "UnitConverts",
    //         "CurrencyConverts",
    //         "HasOffers",
    //         "FreeShipping",
    //         "OffersSum",
    //         "ProductOffers",
    //         "ProductColors",
    //         "ProductSizes",
    //         "Code",
    //         "IsCustomizable",
    //         "ProductCustomProperties"
    //     ];

    //     foreach ($attribute as $val) {
    //         if (array_key_exists(lcfirst($val), $data)) {
    //             $model->$val = $data[lcfirst($val)];
    //         }
    //     }
    // }


    // protected function resolveCriteria($data = [])
    // {
    //     $query = Product::Query();
    //     if (array_key_exists('columns', $data)) {
    //         $query = $query->select($data['columns']);
    //     } else {
    //         $query = $query->select("*");
    //     }

    //     if (array_key_exists('Id', $data)) {
    //         $query = $query->where('Id', $data['Id']);
    //     }

    //     if (array_key_exists('exceptId', $data)) {
    //         $query = $query->where('Id', '!=', $data['exceptId']);
    //     }

    //     if (array_key_exists('IsDeleted', $data)) {
    //         $query = $query->where('IsDeleted', $data['IsDeleted']);
    //     }

    //     if (array_key_exists('DataAccessKey', $data)) {
    //         $query = $query->where('DataAccessKey', $data['DataAccessKey']);
    //     }

    //     if (array_key_exists('Name', $data)) {
    //         $query = $query->where('Name', $data['Name']);
    //     }

    //     if (array_key_exists('Brand', $data)) {
    //         $query = $query->where('Brand', $data['Brand']);
    //     }

    //     if (array_key_exists('Description', $data)) {
    //         $query = $query->where('Description', $data['Description']);
    //     }

    //     if (array_key_exists('BuyPrice', $data)) {
    //         $query = $query->where('BuyPrice', $data['BuyPrice']);
    //     }

    //     if (array_key_exists('IsAccepted', $data)) {
    //         $query = $query->where('IsAccepted', $data['IsAccepted']);
    //     }

    //     if (array_key_exists('IsVisibel', $data)) {
    //         $query = $query->where('IsVisibel', $data['IsVisibel']);
    //     }

    //     if (array_key_exists('Order', $data)) {
    //         $query = $query->where('Order', $data['Order']);
    //     }

    //     if (array_key_exists('ProductCategoryId', $data)) {
    //         $query = $query->where('ProductCategoryId', $data['ProductCategoryId']);
    //     }

    //     if (array_key_exists('SellPrice', $data)) {
    //         $query = $query->where('SellPrice', $data['SellPrice']);
    //     }

    //     if (array_key_exists('UnitId', $data)) {
    //         $query = $query->where('UnitId', $data['UnitId']);
    //     }

    //     if (array_key_exists('Weight', $data)) {
    //         $query = $query->where('Weight', $data['Weight']);
    //     }

    //     if (array_key_exists('CurrencyId', $data)) {
    //         $query = $query->where('CurrencyId', $data['CurrencyId']);
    //     }

    //     if (array_key_exists('LastModefiedBy', $data)) {
    //         $query = $query->where('LastModefiedBy', $data['LastModefiedBy']);
    //     }

    //     if (array_key_exists('LastModefiedAt', $data)) {
    //         $query = $query->where('LastModefiedAt', $data['LastModefiedAt']);
    //     }

    //     if (array_key_exists('CreatedBy', $data)) {
    //         $query = $query->where('CreatedBy', $data['CreatedBy']);
    //     }

    //     if (array_key_exists('CreatedAt', $data)) {
    //         $query = $query->where('CreatedAt', $data['CreatedAt']);
    //     }

    //     if (array_key_exists('orderBy', $data)) {
    //         $query = $query->orderBy($data['orderBy'][0], $data['orderBy'][1]);
    //     }

    //     if (array_key_exists('limit', $data) && array_key_exists('offset', $data)) {
    //         $query = $query->take($data['limit']);
    //         $query = $query->skip($data['offset']);
    //     }

    //     return $query;
    // }

    // function getOldOne($id, $slug = '')
    // {
    //     if ($id > 0) {
    //         $res = Product::findOrFail($id);
    //         return $res;
    //     } else {
    //         $res = $this->resolveCriteria(['slug' => $slug])->firstOrFail();
    //         return $res;
    //     }
    // }

    // /**
    //  * @param $criteria
    //  */
    // function getOldList($criteria = [])
    // {
    //     $res = $this->resolveCriteria($criteria)->get();
    //     return $res;
    // }

}
