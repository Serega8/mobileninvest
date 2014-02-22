<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Subdetails extends ORM {

    protected $_table_name = 'sub_details';
    protected $_belongs_to = array(
        'details' => array(
            'model' => 'Details',
            'foreign_key' => 'id',
        ),
    );

    public function update_details($data) {



        $data = Controller_Admin::filter1x($data);


        $translit = ($data['url'] !== 'undefined' && $data['url'] !== null) ? Controller_Admin::url_set($data['url']) : $this->translit($data['product_name']);

        

        if (!$data['product_name'] || $translit == 'new_sub_category') {
            echo "Нельзя назвать так товар";
            die;
        }



        $that_prod = ORM::factory('Products')->where('id', '=', $data['product_id'])->find();

        $sub_id = $that_prod->sub_category_id;
        $id_cat = $that_prod->category_id;
        $model = ORM::factory('Products');
        $count = $model->where('name_translit', '=', $translit)
                        ->and_where('category_id', '=', $id_cat)
                        ->and_where('status', '!=', '3')
                        ->and_where('sub_category_id', '=', $sub_id)
                        ->and_where('id', '!=', $data['product_id'])->count_all();

        if ($count >= 1) {
            echo "Товар с таким названием в этой категории уже существует";
            die;
        } else {
            $product_model = ORM::factory('Products');
            $product_model->where('id', '=', $data['product_id'])->find();
            $product_model->product_name = $data['product_name'];
            $product_model->keywords = $data['k'];
            $product_model->descr = $data['d'];
            $product_model->seo_text = $data['s'];
            $product_model->title = $data['t'];
            $product_model->currency = $data['product_currency'];
            $product_model->brand_id = $data['product_brand'];
            $product_model->cost = $data['product_cost'];
            $product_model->name_translit = $translit;
            $product_model->save();
        }
    }

//
//    public function insert_details($data) {
//        $id = Model::factory('Pk')->pk('products');
//        $of = TRUE;
//        if (!empty($data['new_details'])) {
//            $of = FALSE;
//            foreach ($data['new_details'] as $new) {
//                $model = ORM::factory('Subdetails');
//                $model->details->name = $new['name'];
//                $model->details->product_id = $id;
//                $model->details->save();
//                $id_det = $model->details->pk('products');
//                foreach ($data['new_sub'] as $new_sub) {
//                    if ($new['id'] == $new_sub['group_id']) {
//                        $model = ORM::factory('Subdetails');
//                        $model->product_id = $id;
//                        $model->status = $new_sub['status'];
//                        $model->value = $new_sub['value'];
//                        $model->key = $new_sub['key'];
//                        $model->detail_id = $id_det;
//                        if ($model->save()) {
//                            $of = TRUE;
//                        } else {
//                            $of = FAlSE;
//                        }
//                    }
//                }
//            }
//        }
//        return $of;
//    }
//
//    public function get_details($id) {
//        $det_info = array();
//        $ids = array();
//        $sub_det_info = array();
//        $model = ORM::factory('Subdetails');
//        $details = $model->details->where('product_id', '=', $id)->and_where('status', '!=', '3')->find_all();
//        foreach ($details as $d) {
//            $res['id'] = $d->id;
//            $ids[] = $d->id;
//            $res['name'] = $d->name;
//            $res['status'] = $d->status;
//            $res['translit'] = $d->name_translit;
//            $det_info[] = $res;
//        }
//        if (empty($ids))
//            return false;
//        $sub_details = $model->where('product_id', '=', $id)->and_where('status', '!=', '3')->and_where('detail_id', 'IN', $ids)->find_all();
//        foreach ($sub_details as $d) {
//            $res['id'] = $d->id;
//            $res['detail_id'] = $d->detail_id;
//            $res['product_id'] = $d->product_id;
//            $res['status'] = $d->status;
//            $res['key'] = $d->key;
//            $res['value'] = $d->value;
//            $sub_det_info[] = $res;
//        }
//
//
//        $result['details'] = $det_info;
//        $result['sub_details'] = $sub_det_info;
//
//
//        return $result;
//    }

    public static function translit($string) {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        $str = strtr($string, $converter);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

}