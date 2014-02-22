<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Categories extends ORM {

    protected $_table_name = 'categories';

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

    public function check_level2($l2) {
        $category = ORM::factory('Categories');
        $count = $category->where('translit_name', '=', $l2)->and_where('sta tus', '!=', '3')->find();
        $rus = null;
        $rus = $count->category_name;
        if (isset($rus)) {
            return $rus;
        } else {
            die;
        }
    }

    public function categories_count() {
        $categories = ORM::factory('Categories');
        $av = $categories->where('status', '=', '0')->count_all();
        $hid = $categories->where('status', '=', '1')->count_all();
        $del = $categories->where('status', '=', '3')->count_all();
        $array['av'] = $av;
        $array['hid'] = $hid;
        $array['del'] = $del;
        return $array;
    }

    public function update_seo($data) {
        $categories = ORM::factory('Pages');
        $categories->where('id', '=', $data['id'])->find();
        $categories->seo_text = $data['s'];
        $categories->keywords = $data['k'];
        $categories->descr = $data['d'];
        $categories->title = $data['t'];
        if ($categories->save()) {
            echo "Ключевые слова, описание, название для данной страницы обновлены";
        } else {
            echo "Ошибка обновления данных";
        }
    }

    public function update_info($data) {
        $category = ORM::factory('Categories');

        $data = Controller_Admin::filter1x($data);

        $translit = ($data['url']) ? Controller_Admin::url_set($data['url']) : $this->translit($data['category_name']);

        $id = ($data['id']) ? $data['id'] : 0;

        if ($translit == 'new_category' || (strlen($translit) == 0) || !$data['category_name']) {
            echo "Нельзя назвать так категорию";
            die;
        }

        $count = $category->where('translit_name', '=', $translit)
                ->and_where('status', '!=', '3')
                ->and_where('id', '!=', $id)
                ->count_all();
        if ($count >= 1) {
            echo "Категория с таким названием уже существует";
            die;
        } else {
            if ($data['type_apply'] !== 'new_category') {
                $category->where('id', '=', $data['id'])->find();
            }
            $category->category_name = $data['category_name'];
            $category->img_alt = $data['img_alt'];
            $category->translit_name = $translit;
            $category->img_title = $data['img_title'];
            $category->keywords = $data['k'];
            $category->descr = $data['d'];
            $category->seo_text = $data['s'];
            $category->title = $data['t'];
            $category->date = date('U');
            if (isset($data['file'])) {
                $category->img_url = $data['file'];
            }
            if ($category->save())
                return true;
        }
    }

    public function list_categories() {
        $categories = array();
        $model = ORM::factory('Categories');
        $info = $model->where('status', '!=', '3')->find_all();
        foreach ($info as $inf) {
            $res['id'] = $inf->id;
            $res['category_name'] = $inf->category_name;
            $res['translit_name'] = $inf->translit_name;
            $res['img_url'] = $inf->img_url;
            $res['img_alt'] = $inf->img_alt;
            $res['img_title'] = $inf->img_title;
            $res['date'] = $inf->date;
            $res['status'] = $inf->status;
            $categories[] = $res;
        }
        return $categories;
    }

    public function get_сategory_info($level2) {
        $c = array();
        $model = ORM::factory('Categories');
        $category = $model->where('translit_name', '=', $level2)
                ->and_where('status', '!=', '3')
                ->find();
        $inf = $category;
        $res['id'] = $inf->id;

        $res['img_title'] = $inf->img_title;
        $res['img_alt'] = $inf->img_alt;
        $res['img_url'] = $inf->img_url;
        $res['k'] = $inf->keywords;
        $res['d'] = $inf->descr;
        $res['s'] = $inf->seo_text;
        $res['t'] = $inf->title;
        $res['category_name'] = $inf->category_name;
        $res['translit_name'] = $inf->translit_name;
        $res['date'] = $inf->date;
        $res['status'] = $inf->status;
        return $res;
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
            $model = ORM::factory('Categories');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            $products = ORM::factory('Products')->where('category_id', '=', $model->id)->find_all();
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

    public function get_rus($level2) {
        $model = ORM::factory('Categories')->where('translit_name', '=', $level2)->find();
        return $model->category_name;
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