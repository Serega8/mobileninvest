<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Articles extends ORM {

    protected $_table_name = 'articles';

    public function all_articles() {
        $model = ORM::factory('Articles');
        $c = array();
        $all = $model->where('status', '!=', '3')->find_all();
        foreach ($all as $inf) {
            $res['id'] = $inf->id;
            $res['name'] = $inf->name;
            $img = ORM::factory('Articleimages')->where('parent_id', '=', $res['id'])->limit(1)->find();
            $res['img_url'] = $img->img_url;
            $res['img_alt'] = $img->img_alt;
            $res['img_title'] = $img->img_title;
            $res['date'] = $inf->date;
            $res['name_translit'] = $inf->name_translit;
            $res['description'] = $inf->description;
            $res['status'] = $inf->status;
            $c[] = $res;
        }
        return $c;
    }

    public function article($level2) {
        $model = ORM::factory('Articles');
        $res = array();
        $inf = $model->where('status', '!=', '3')->and_where('name_translit', '=', $level2)->find();
        $res['id'] = $inf->id;
        $res['k'] = $inf->keywords;
        $res['d'] = $inf->descr;
        $res['s'] = $inf->seo_text;
        $res['t'] = $inf->title;
        $res['name'] = $inf->name;
        $res['date'] = $inf->date;
        $res['name_translit'] = $inf->name_translit;
        $res['description'] = $inf->description;
        $res['status'] = $inf->status;
        return $res;
    }

    public function set_status($id = null, $status = null) {
        if (isset($id) && isset($status)) {
            $model = ORM::factory('Articles');
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
            $model = ORM::factory('Articles');
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

    public function update_info($data, $new = FALSE) {
        $date = Date('U');
        $translit = $this->translit($data['name']);
        $count = ORM::factory('Articles')->where('status', '!=', '3')
                ->and_where('name_translit', '=', $translit)
                ->and_where('id', '!=', $data['id'])
                ->count_all();
        if ($count >= 1) {
            echo "Статься с таким названием уже существует";
            die;
        }
        if (!$new) {
            $model = ORM::factory('Articles');
            $model->where('id', '=', $data['id'])->and_where('status', '!=', '3')->find();
            $model->name = $data['name'];
            $model->date = $date;
            $model->keywords = $data['k'];
            $model->descr = $data['d'];
            $model->seo_text = $data['s'];
            $model->title = $data['t'];
            $model->name_translit = $this->translit($data['name']);
            $model->description = $data['descr'];
            $model->save();
            $model_img = ORM::factory('Articleimages');
            $model_img->where('parent_id', '=', $data['id'])->find();
            $param = $model_img->id;
            if (!$param) {
                $model_img = ORM::factory('Articleimages');
                if (isset($data['filename'])) {
                    $model_img->img_url = $data['filename'];
                }
                $model_img->img_alt = $data['img_alt'];
                $model_img->img_title = $data['img_title'];
                $model_img->parent_id = $data['id'];
                $model_img->save();
                return true;
            } else {
                if (isset($data['filename'])) {
                    $model_img->img_url = $data['filename'];
                }
                $model_img->img_alt = $data['img_alt'];
                $model_img->img_title = $data['img_title'];
                $model_img->save();
                return true;
            }
        } else if ($new) {
            $model = ORM::factory('Articles');
            $model->name = $data['name'];
            $model->date = $date;
            $model->keywords = $data['k'];
            $model->descr = $data['d'];
            $model->seo_text = $data['s'];
            $model->title = $data['t'];
            $model->name_translit = $translit;
            $model->description = $data['descr'];
            $model->save();
            if (isset($data['filename'])) {
                $model_img = ORM::factory('Articleimages');
                $model_img->img_url = $data['filename'];
                $model_img->img_alt = $data['img_alt'];
                $model_img->img_title = $data['img_title'];
                $model_img->parent_id = $model->pk();
                $model_img->save();
            }
            return true;
        }
    }

    public function check_level2($level2) {
        $model = ORM::factory('Articles');
        $res = null;
        $inf = $model->where('status', '!=', '3')->and_where('name_translit', '=', $level2)->find();
        $res = $inf->name;
        if ($res) {
            return $res;
        } else {
            die('The requested category doesn\'t exist');
        }
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