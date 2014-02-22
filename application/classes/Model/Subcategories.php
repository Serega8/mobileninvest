<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Subcategories extends ORM {

    protected $_table_name = 'sub_categories';
    protected $_belongs_to = array(
        'categories' => array(
            'model' => 'Categories',
            'foreign_key' => 'id',
        ),
    );

    public function categories_count() {
        $categories = ORM::factory('Subcategories');
        $av = $categories->where('status', '=', '0')->count_all();
        $hid = $categories->where('status', '=', '1')->count_all();
        $del = $categories->where('status', '=', '3')->count_all();
        $array['av'] = $av;
        $array['hid'] = $hid;
        $array['del'] = $del;
        return $array;
    }

    public function check_level3($l3) {
        $category = ORM::factory('Subcategories');
        $count = $category->where('sub_translit', '=', $l3)->and_where('status', '!=', '3')->find();
        $rus = null;
        $rus = $count->sub_name;
        if ($rus) {
            return $rus;
        } else {
            die('The requested category doesn\'t exist');
        }
    }

    public function get_rus($l3) {
        $category = ORM::factory('Subcategories');
        $count = $category->where('sub_translit', '=', $l3)->and_where('status', '!=', '3')->find();
        $count = $count->sub_name;
        if ($count) {
            return $count;
        } else {
            $model_products = ORM::factory('Products')->where('name_translit', '=', $l3)->find();
            $name = $model_products->product_name;
            if ($name) {
                return $name;
            } else {
                die('The requested category doesn\'t exist');
            }
        }
    }

    public function get_сategory_info($level2, $level3) {
        $model = ORM::factory('Subcategories');
        $id = $model->categories->where('status', '!=', '3')->and_where('translit_name', '=', $level2)->find();

        $id = $id->id;
        $category = $model->where('sub_translit', '=', $level3)->and_where('parent_id', '=', $id)->find();
        $inf = $category;
        $res['id'] = $inf->id;

        $res['img_title'] = $inf->img_title;
        $res['img_alt'] = $inf->img_alt;
        $res['img_url'] = $inf->img_url;
        $res['k'] = $inf->keywords;
        $res['d'] = $inf->descr;
        $res['s'] = $inf->seo_text;
        $res['t'] = $inf->title;
        $res['category_name'] = $inf->sub_name;
        $res['translit_name'] = $inf->sub_translit;
        $res['date'] = $inf->date;
        $res['status'] = $inf->status;
        return $res;
    }

    public function detect_sp($level2, $level3) {
        if ($level3 == 'new_sub_category' || $level3 == 'new_product') {
            return 0;
        }
        $sub = ORM::factory('Subcategories');
        $cat = ORM::factory('Categories');
        $cat_id = $cat->where('translit_name', '=', $level2)->and_where('status', '!=', '3')->find();
        $cat_id = $cat_id->id;

        $count = $sub->where('parent_id', '=', $cat_id)
                ->and_where('status', '!=', '3')
                ->and_where('sub_translit', '=', $level3)
                ->count_all();
        return $count;
    }

    public function get_id($level2) {
        $model = ORM::factory('Categories');
        $count = $model->where('translit_name', '=', $level2)->and_where('status', '!=', '3')->find();
        return $count->id;
    }

    public function update_info($data) {
        $category = ORM::factory('Subcategories');
        $data = Controller_Admin::filter1x($data);

        if ($data['parent_category']) {
            $pid = $category->categories
                    ->where('translit_name', '=', $data['parent_category'])
                    ->and_where('status', '!=', '3')
                    ->find();

            $pid = $pid->id;
        } else {
            $pid = 0;
            $data['id'] = 0;
        }
        $translit = ($data['url']) ? Controller_Admin::url_set($data['url']) : $this->translit($data['category_name']);

        if ($translit == 'new_sub_category' || (strlen($translit) == 0) || !$data['category_name']) {
            echo "Нельзя назвать так подкатегорию";
            die;
        }
        $count = $category->where('sub_translit', '=', $translit)
                ->and_where('parent_id', '=', $pid)
                ->and_where('id', '!=', $data['id'])
                ->and_where('status', '!=', '3')
                ->count_all();
        if ($count >= 1) {
            echo "Подкатегория в этой категории уже существует";
            die;
        }

        if (($data['id'] !== 0) && ($pid !== 0)) {
            $category->where('id', '=', $data['id'])->find();
        }

        if ($data['type_apply'] == 'new_sub_category') {
            $category->parent_id = $pid;
        }
        $category->sub_name = $data['category_name'];
        $category->img_alt = $data['img_alt'];
        $category->keywords = $data['k'];
        $category->descr = $data['d'];
        $category->seo_text = $data['s'];
        $category->title = $data['t'];
        $category->sub_translit = $translit;
        $category->img_title = $data['img_title'];
        $category->date = date('U');
        if (isset($data['file'])) {
            $category->img_url = $data['file'];
        } if ($category->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function list_sub_categories($level2, $client = false) {
        $sub_categories = array();
        if ($client) {
            $op = '=';
            $status = 0;
        } else {
            $op = '!=';
            $status = 3;
        }
        $model = ORM::factory('Subcategories');

        $id = $model->categories->where('status', $op, $status)->and_where('translit_name', '=', $level2)->find();
        $id = $id->id;
        $info = $model->where('status', $op, $status)->and_where('parent_id', '=', $id)->find_all();
        foreach ($info as $inf) {
            $res['id'] = $inf->id;
            $res['sub_name'] = $inf->sub_name;
            $res['img_url'] = $inf->img_url;
            $res['img_title'] = $inf->img_title;
            $res['img_alt'] = $inf->img_alt;
            $res['sub_translit'] = $inf->sub_translit;
            $res['date'] = $inf->date;
            $res['status'] = $inf->status;
            $sub_categories[] = $res;
        }
        return $sub_categories;
    }

    public function set_status($id = null, $status = null) {
        if (isset($id) && isset($status)) {
            $model = ORM::factory('Subcategories');
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
            $model = ORM::factory('Subcategories');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            $products = ORM::factory('Products')->where('sub_category_id', '=', $model->id)->find_all();
            foreach ($products as $product) {
                $mp = ORM::factory('Products');
                $mp->where('id', '=', $product->id)->find();
                $mp->status = $status;
                $mp->save();
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