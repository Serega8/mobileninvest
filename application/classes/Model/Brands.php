<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Brands extends ORM {

    protected $_table_name = 'brands';

    public function list_brands() {
        $res = array();
        $model = ORM::factory('Brands');
        $brands = $model->where('status', '!=', '3')->find_all();
        foreach ($brands as $brand) {
            $pr['id'] = $brand->id;
            $pr['name'] = $brand->name;
            $pr['translit'] = $brand->translit;
            $pr['img_url'] = $brand->img_url;
            $pr['img_alt'] = $brand->img_alt;
            $pr['img_title'] = $brand->img_title;
            $pr['status'] = $brand->status;
            $pr['descr'] = $brand->descr;
            $res[] = $pr;
        }
        return $res;
    }

    public function seo($action) {
        $res = array();
        $s = ORM::factory('Pages')->where('translit', '=', $action)->find();
        $res['s'] = $s->seo_text;
        $res['id'] = $s->id;
        $res['k'] = $s->keywords;
        $res['d'] = $s->descr;
        $res['t'] = $s->title;

        return $res;
    }

    public function update_seo($data) {
        $categories = ORM::factory('Pages');
        $categories->where('id', '=', $data['id'])->find();
        $categories->seo_text = $data['s'];
        $categories->keywords = $data['k'];
        $categories->descr = $data['d'];
        $categories->title = $data['t'];
        if ($categories->save()) {
            echo "seo данные обновлены";
        } else {
            echo "Ошибка";
        }
    }

    public function update_info($data) {
        if (empty($data['id'])) {
            $data['id'] = 0;
        }
        $translit = $this->translit($data['category_name']);
        $count = ORM::factory('Brands')->where('translit', '=', $translit)
                ->and_where('status', '!=', '3')
                ->and_where('id', '!=', $data['id'])
                ->count_all();
        if ($count >= 1) {
            echo "Производитель с таким названием уже существует";
            die;
        }
        $model = ORM::factory('Brands');
        if ($data['type_apply'] == 'brand_edit') {
            $model->where('id', '=', $data['id'])->find();
        }
        $model->name = $data['category_name'];
        if (isset($data['file'])) {
            $model->img_url = $data['file'];
        }
        $model->translit = $translit;
        $model->img_alt = $data['img_alt'];
        $model->keywords = $data['k'];
        $model->descript = $data['d'];
        $model->seo_text = $data['s'];
        $model->title = $data['t'];
        $model->img_title = $data['img_title'];
        $model->descr = $data['descr'];
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function list_sub_brands($level2) {
        $brands = ORM::factory('Brands');
        $id = $brands->where('translit', '=', $level2)->find();
        $id = $id->id;
        $products = ORM::factory('Products');
        $pb = $products->where('brand_id', '=', $id)
                ->and_where('status', '=', '0')
                ->find_all();
        $ids_sub = array();
        $ids_cat = array();
        $sub_categories = array();
        foreach ($pb as $p) {
            $ids_sub[] = $p->sub_category_id;
        }
        if (!empty($ids_sub)) {
            $model_sub = ORM::factory('Subcategories');
            $info = $model_sub->where('id', 'IN', $ids_sub)->find_all();
            foreach ($info as $inf) {
                $res['id'] = $inf->id;
                $res['sub_name'] = $inf->sub_name;
                $res['img_url'] = $inf->img_url;
                $res['sub_translit'] = $inf->sub_translit;
                $res['date'] = $inf->date;
                $res['status'] = $inf->status;
                $sub_categories[] = $res;
            }
        }
        return $sub_categories;
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
            $model = ORM::factory('Brands');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            if ($model->save()) {
                $of = true;
            } else {
                return false;
            }
        }
        return $of;
    }

    public function get_brand_by_id($id) {
        $pr = array();
        $model = ORM::factory('Brands');
        $brand = $model->where('id', '=', $id)->find();
        $pr['id'] = $brand->id;
        $pr['k'] = $brand->keywords;
        $pr['d'] = $brand->descript;
        $pr['s'] = $brand->seo_text;
        $pr['t'] = $brand->title;
        $pr['name'] = $brand->name;
        $pr['img_url'] = $brand->img_url;
        $pr['img_alt'] = $brand->img_alt;
        $pr['img_title'] = $brand->img_title;
        $pr['img_status'] = $brand->status;
        $pr['descr'] = $brand->descr;
        return $pr;
    }

    public function get_brand_by_name($level2) {
        $pr = array();
        $model = ORM::factory('Brands');
        $brand = $model->where('translit', '=', $this->translit($level2))
                ->and_where('status', '=', '0')
                ->find();
        $pr['id'] = $brand->id;
        $pr['k'] = $brand->keywords;
        $pr['d'] = $brand->descript;
        $pr['s'] = $brand->seo_text;
        $pr['t'] = $brand->title;
        $pr['name'] = $brand->name;
        $pr['img_url'] = $brand->img_url;
        $pr['img_alt'] = $brand->img_alt;
        $pr['img_title'] = $brand->img_title;
        $pr['img_status'] = $brand->status;
        $pr['descr'] = $brand->descr;
        return $pr;
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