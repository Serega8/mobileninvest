<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Products extends ORM {

    protected $_table_name = 'products';
    protected $_belongs_to = array(
        'sub_categories' => array(
            'model' => 'Subcategories',
            'foreign_key' => 'id',
        ),
    );
    protected $_has_many = array(
        'brands' => array(
            'model' => 'Brands',
            'foreign_key' => 'id',
        ),
        'details' => array(
            'model' => 'Details',
            'foreign_key' => 'id',
        ),
    );

    public function categories_count() {
        $categories = ORM::factory('Products');
        $av = $categories->where('status', '=', '0')->count_all();
        $hid = $categories->where('status', '=', '1')->count_all();
        $del = $categories->where('status', '=', '3')->count_all();
        $array['av'] = $av;
        $array['hid'] = $hid;
        $array['del'] = $del;
        return $array;
    }

    public function get_rus($level4) {
        $model = ORM::factory('Products')->where('name_translit', '=', $level4)->find();
        return $model->product_name;
    }

    public function search_products($query, $client = false) { // to client
        $translit = $this->translit($query);
        if (!$translit) {
            return array();
        }
        if (strlen($translit) < 3) {
            return array();
        }
        $query = '%' . $translit . '%';
        $model = ORM::factory('Products');
        $products = array();
        if (is_string($query)) {
            if (!$client) {
                $info = $model
                        ->where('status', '!=', '3')
                        ->and_where('name_translit', 'LIKE', $query)
                        ->or_where('id', 'LIKE', $query)
                        ->find_all();
            } else {
                $info = $model
                        ->where('status', '=', '0')
                        ->and_where('name_translit', 'LIKE', $query)
                        ->find_all();
            }
        }
        $model_det = ORM::factory('Subdetails');

        $model_det1 = ORM::factory('Subdetails');

        $zavod_id = $model_det->where('key', '=', 'Страна')->and_where('status', '=', 0)->find();
        $zavod_id = $zavod_id->id;
        $col_id = $model_det1->where('key', '=', 'Коллекция')->and_where('status', '=', 0)->find();
        $col_id = $col_id->id;




        foreach ($info as $inf) {
            $model_val = ORM::factory('Subdetailsval');
            $model_val1 = ORM::factory('Subdetailsval');
            $res['id'] = $inf->id;
            if ($inf->sub_category_id) {
                $sub_cat_translit = ORM::factory('Subcategories')->where('id', '=', $inf->sub_category_id)->find();
                $sct = $sub_cat_translit->sub_translit;
                $res['level3'] = $sct;
            } else {
                $res['level3'] = '';
            }
            $cat_translit = ORM::factory('Categories')->where('id', '=', $inf->category_id)->find();
            $ct = $cat_translit->translit_name;
            $res['level2'] = $ct;
            $rc = $model_val->where('product_id', '=', $res['id'])
                            ->and_where('sub_detail_id', '=', $col_id)->find();
            $res['col'] = $rc->value;

            $img = ORM::factory('Productimages')->where('product_id', '=', $res['id'])->and_where('status', '=', '0')->limit(1)->find();
            $res['img_url'] = $img->img_url;
            $res['img_url_small'] = $img->img_url_small;

            $rc = $model_val1->where('product_id', '=', $res['id'])->and_where('sub_detail_id', '=', $zavod_id)->find();
            $res['country'] = $rc->value;
            $res['product_name'] = $inf->product_name;
            $res['translit_name'] = $inf->name_translit;
            $res['date'] = $inf->date;
            $res['status'] = $inf->status;
            $products[] = $res;
        }
        return $products;
    }

    public function get_tree($client = false) {
        $res = array();
        if ($client) {
            $op = '=';
            $status = 0;
        } else {
            $op = '!=';
            $status = 3;
        }
        $model = ORM::factory('Products');
        $categories = array();
        $sub_categories = array();
        $products = array();
        $category_data = $model->sub_categories->categories->where('status', $op, $status)->find_all();
        foreach ($category_data as $data) {
            $res['name'] = $data->category_name;
            $res['date'] = $data->date;
            $res['translit_name'] = $data->translit_name;
            $res['img_url'] = $data->img_url;
            $res['status'] = $data->status;
            $res['id'] = $data->id;
            $categories[] = $res;
        }
        $res = array();
        $sub_categories_data = $model->sub_categories->where('status', $op, $status)->find_all();
        foreach ($sub_categories_data as $data) {
            $res['id'] = $data->id;
            $res['pid'] = $data->parent_id;
            $res['img_url'] = $data->img_url;
            $res['sub_name'] = $data->sub_name;
            $res['sub_translit'] = $data->sub_translit;
            $res['status'] = $data->status;
            $res['date'] = $data->date;
            $sub_categories[] = $res;
        }
        $res = array();

        $products_data = $model->where('status', $op, $status)->find_all();
        foreach ($products_data as $data) {
            $res['id'] = $data->id;
            $res['category_id'] = $data->category_id;
            $res['sub_category_id'] = $data->sub_category_id;
            $res['product_name'] = $data->product_name;
            $res['product_translit'] = $data->name_translit;
            $products[] = $res;
        }

        $array['main'] = $categories;
        $array['sub'] = $sub_categories;
        $array['product'] = $products;
        return $array;
    }

    public function get_id_by_translit($level4) {
        $model = ORM::factory('Products');
        $i = $model->where('name_translit', '=', $level4)->find();
        $id = $i->id;
        return $id;
    }

    public function add_product($data, $val) {
        $date = Date('U');

        $data = Controller_Admin::filter1x($data);

        $translit = ($data['url']) ? Controller_Admin::url_set($data['url']) : $this->translit($data['product_name']);

        $cat_model = ORM::factory('Categories');

        $id_cat = $cat_model->where('translit_name', '=', $data['level2'])
                ->and_where('status', '!=', '3')
                ->find();
        $id_cat = $id_cat->id;



        if ((strlen($translit) == 0) || !$data['product_name']) {
            echo "Нельзя назвать так товар";
            die;
        }


        if ($data['level3']) {
            $sub_model = ORM::factory('Subcategories');
            $sub_id = $sub_model->where('sub_translit', '=', $data['level3'])
                    ->and_where('parent_id', '=', $id_cat)
                    ->and_where('status', '!=', '3')
                    ->find();
            $sub_id = $sub_id->id;
        } else {
            $sub_id = null;
        }

        $model = ORM::factory('Products');
        $count = $model->where('name_translit', '=', $translit)
                ->and_where('sub_category_id', '=', $sub_id)
                ->and_where('status', '!=', '3')
                ->and_where('category_id', '=', $id_cat)
                ->count_all();

        if ($count >= 1) {
            echo 'Товар с таким названием в этой категории уже существует';
            die;
        } else {
            $model = ORM::factory('Products');
            $model->date = $date;
            $model->product_name = $data['product_name'];
            $model->name_translit = $this->translit($data['product_name']);
            $model->cost = $data['product_cost'];
            $model->keywords = $data['k'];
            $model->descr = $data['d'];
            $model->seo_text = $data['s'];
            $model->title = $data['t'];
            $model->brand_id = $data['product_brand'];
            $model->category_id = $id_cat;
            $model->sub_category_id = $sub_id;
            $model->currency = $data['product_currency'];
            $model->save();
            $id = $model->pk();
            if (!empty($val)) {
                foreach ($val as $v) {
                    $model_val = ORM::factory('Subdetailsval');
                    if ($v['val_id'] !== null) {
                        $model_val->where('id', '=', $v['val_id'])->find();
                    }
                    $model_val->value = htmlspecialchars(strip_tags(trim($v['val'])));
                    $model_val->product_id = $id;
                    $model_val->sub_detail_id = $v['sid'];
                    $model_val->save();
                }
            }
            return true;
        }
    }

    public function list_category_products($level2, $client = false) {
        if (!$client) {
            $status = 3;
            $op = '!=';
        } else {
            $status = 0;
            $op = '=';
        }
        $products = array();
        $model = ORM::factory('Products');
        $id = $model->sub_categories->categories->where('status', $op, $status)->and_where('translit_name', '=', $level2)->find();
        $id = $id->id;
        $info = $model->where('status', $op, $status)->and_where('sub_category_id', '=', NULL)->and_where('category_id', '=', $id)->find_all();
        foreach ($info as $inf) {
            $res['id'] = $inf->id;
            $res['product_name'] = $inf->product_name;
            $res['translit_name'] = $inf->name_translit;
            $res['date'] = $inf->date;
            $img = ORM::factory('Productimages')->where('product_id', '=', $res['id'])->and_where('status', $op, $status)->limit(1)->find();
            $res['img_url'] = $img->img_url;
            $res['img_url_small'] = $img->img_url_small;
            $res['status'] = $inf->status;
            $products[] = $res;
        }
        return $products;
    }

//    public function list_products($level2, $level3) {
//        $products = array();
//        $model = ORM::factory('Products');
//        $id_cat = $model->sub_categories->categories->where('status', '!=', '3')->and_where('translit_name', '=', $level2)->find();
//        $id_cat = $id_cat->id;
//
//        $id = $model->sub_categories->where('status', '!=', 3)
//                ->and_where('sub_translit', '=', $level3)
//                ->and_where('parent_id', '=', $id_cat)
//                ->find();
//        $id = $id->id;
//        $info = $model->where('status', '!=', '3')
//                ->and_where('category_id', '=', $id_cat)
//                ->and_where('sub_category_id', '=', $id)
//                ->find_all();
//        foreach ($info as $inf) {
//            $res['id'] = $inf->id;
//            $res['product_name'] = $inf->product_name;
//            $res['translit_name'] = $inf->name_translit;
//            $res['date'] = $inf->date;
//            $res['status'] = $inf->status;
//            $products[] = $res;
//        }
//        return $products;
//    }



    public function list_products_brands($level2, $client = false) {
        if (!$client) {
            $status = 3;
            $op = '!=';
        } else {
            $status = 0;
            $op = '=';
        }
        $brands = ORM::factory('Brands');
        $bid = $brands->where('translit', '=', $level2)->and_where('status', $op, $status)->find();
        $bid = $bid->id;
        $sub_ids = array();
        $cat_ids = array();
        $products = array();
        $model = ORM::factory('Products');
        $full_cat = array();
        $full_sub = array();

        $info = $model->where('status', $op, $status)
                ->and_where('brand_id', '=', $bid)
                ->find_all();
        foreach ($info as $inf) {
            $sub_ids[] = $inf->sub_category_id;
            $cat_ids[] = $inf->category_id;
        }
//
        $sub_ids = array_unique($sub_ids);
        $cat_ids = array_unique($cat_ids);
        if (!empty($sub_ids)) {
            $subs = ORM::factory('Subcategories')->where('status', $op, $status)->and_where('id', 'IN', $sub_ids)->find_all();
            foreach ($subs as $category) {
                $res['id'] = $category->id;
                $res['name'] = $category->sub_name;
                $res['pid'] = $category->parent_id;
                $res['stranslit'] = $category->sub_translit;
                $full_sub[] = $res;
            }
        }
        if (!empty($cat_ids)) {
            $cats = ORM::factory('Categories')->where('id', 'IN', $cat_ids)->and_where('status', $op, $status)->find_all();
            foreach ($cats as $category) {
                $res['id'] = $category->id;
                $res['translit'] = $category->translit_name;
                $res['name'] = $category->category_name;
                $full_cat[] = $res;
            }
        }

        $model_det = ORM::factory('Subdetails');

        $model_det1 = ORM::factory('Subdetails');

        $zavod_id = $model_det->where('key', '=', 'Страна')->and_where('status', $op, $status)->find();
        $zavod_id = $zavod_id->id;
        $col_id = $model_det1->where('key', '=', 'Коллекция')->and_where('status', $op, $status)->find();
        $col_id = $col_id->id;


        foreach ($info as $inf) {
            $model_val = ORM::factory('Subdetailsval');
            $model_val1 = ORM::factory('Subdetailsval');
            $res['id'] = $inf->id;
            $rc = $model_val->where('product_id', '=', $res['id'])
                            ->and_where('sub_detail_id', '=', $col_id)->find();
            $res['col'] = $rc->value;



            $rc = $model_val1->where('product_id', '=', $res['id'])->and_where('sub_detail_id', '=', $zavod_id)->find();
            $res['country'] = $rc->value;


            $res['sub_category_id'] = $inf->sub_category_id;
            $res['category_id'] = $inf->category_id;
            $res['product_name'] = $inf->product_name;
            $res['translit_name'] = $inf->name_translit;
            $img = ORM::factory('Productimages')->where('product_id', '=', $res['id'])->and_where('status', $op, $status)->limit(1)->find();
            $res['img_url'] = $img->img_url;
            $res['img_url_small'] = $img->img_url_small;
            $res['date'] = $inf->date;
            $res['status'] = $inf->status;
            $products[] = $res;
        }
        $array = array();
        $array['categories'] = $full_cat;
        $array['sub_categories'] = $full_sub;
        $array['products'] = $products;
        return $array;
    }

    public function list_products($level2, $level3, $client = false) {
        $products = array();
        $model = ORM::factory('Products');

        if (!$client) {
            $status = 3;
            $op = '!=';
        } else {
            $status = 0;
            $op = '=';
        }
        $id_cat = $model->sub_categories->categories
                        ->where('status', $op, $status)
                        ->and_where('translit_name', '=', $level2)->find();
        $id_cat = $id_cat->id;
        $id = $model->sub_categories->where('status', $op, $status)
                ->and_where('sub_translit', '=', $level3)
                ->and_where('parent_id', '=', $id_cat)
                ->find();
        $id = $id->id;
        $info = $model->where('status', $op, $status)
                ->and_where('category_id', '=', $id_cat)
                ->and_where('sub_category_id', '=', $id)
                ->find_all();
//        $model_det = ORM::factory('Subdetails');
//
//        $model_det1 = ORM::factory('Subdetails');
//
//        $zavod_id = $model_det->where('key', '=', 'Страна')->and_where('status', $op, $status)->find();
//        $zavod_id = $zavod_id->id;
//        $col_id = $model_det1->where('key', '=', 'Коллекция')->and_where('status', $op, $status)->find();
//        $col_id = $col_id->id;



        foreach ($info as $inf) {
            $model_val = ORM::factory('Subdetailsval');
            $model_val1 = ORM::factory('Subdetailsval');
            $res['id'] = $inf->id;
//            $rc = $model_val->where('product_id', '=', $res['id'])->and_where('sub_detail_id', '=', $col_id)->find();
//            $res['col'] = $rc->value;
//
//            $rc = $model_val1->where('product_id', '=', $res['id'])->and_where('sub_detail_id', '=', $zavod_id)->find();
//            $res['country'] = $rc->value;

            $res['product_name'] = $inf->product_name;
            $res['translit_name'] = $inf->name_translit;
            $img = ORM::factory('Productimages')->where('product_id', '=', $res['id'])->and_where('status', $op, $status)->limit(1)->find();
            $res['img_url'] = $img->img_url;
            $res['img_url_small'] = $img->img_url_small;
            $res['date'] = $inf->date;
            $res['status'] = $inf->status;
            $products[] = $res;
        }
        return $products;
    }

    public function product_main_info($level2, $level3, $level4 = NULL) {
        $model = ORM::factory('Products');
        $cat_model = ORM::factory('Categories');
        $id_cat = $cat_model->where('translit_name', '=', $level2)
                ->and_where('status', '!=', '3')
                ->find();
        $id_cat = $id_cat->id;
        if ($level4 == null) {
            $sub_id = null;
            $level4 = $level3;
        } else {
            $sub_model = ORM::factory('Subcategories');
            $sub_id = $sub_model->where('sub_translit', '=', $level3)
                    ->and_where('parent_id', '=', $id_cat)
                    ->and_where('status', '!=', '3')
                    ->find();
            $sub_id = $sub_id->id;
        }
        $model = $model->where('name_translit', '=', $level4)
                ->and_where('category_id', '=', $id_cat)
                ->and_where('sub_category_id', '=', $sub_id)
                ->and_where('status', '!=', '3')
                ->find();
        $info['product_name'] = $model->product_name;
        $info['id'] = $model->id;
        $info['cost'] = $model->cost;

        $info['k'] = $model->keywords;
        $info['d'] = $model->descr;
        $info['s'] = $model->seo_text;
        $info['t'] = $model->title;


        $info['brand_id'] = $model->brand_id;
        $info['currency'] = $model->currency;
        $info['date'] = $model->date;
        $info['name_translit'] = $model->name_translit;
        return $info;
    }

    public function set_status($id = null, $status = null) {
        if (isset($id) && isset($status)) {
            $model = ORM::factory('Products');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    public function update_status($data) {
        $data_ids = array();
        if (empty($data['ids'])) {
            return false;
        }
        $data_ids = explode(',', $data['ids']);
        $status = 0;
        $of = false;
        switch ($data['type']) {
            case 'delete':
                $status = 3;
                break;
            case 'hide':
                $status = 1;
                break;
            case 'show':
                $status = 0;
                break;
            default:
                return false;
                break;
        }
        foreach ($data_ids as $id) {
            $model = ORM::factory('Products');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            if ($status == 3) {
                $values = ORM::factory('Subdetailsval')->where('product_id', '=', $model->id)->find_all();
                foreach ($values as $val) {
                    $model_values = ORM::factory('Subdetailsval')->where('id', '=', $val->id)->find();
                    $model_values->status = $status;
                    $model_values->save();
                }
            }
            if ($model->save()) {
                $of = true;
            } else {
                return false;
            }
        }
        return $of;
    }

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