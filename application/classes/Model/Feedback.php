<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Feedback extends ORM {

    protected $_table_name = 'feedback';

    public function get_all_tags($c = FALSE) {
        $array = array();
        $model = ORM::factory('Feedback');
        if ($c) {
            $result = $model->where('status', '!=', '3')->find_all();
        } else {
            $result = $model->where('status', '=', '0')->find_all();
        }
        foreach ($result as $r) {
            $res['type'] = $r->type;
            $res['id'] = $r->id;
            $res['tag'] = $r->tag;
            $res['placeholder'] = $r->placeholder;
            $res['status'] = $r->status;
            $res['sort'] = $r->sort;
            $res['name'] = $r->name;
            $res['ident'] = $r->ident;
            $array[] = $res;
        }
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
    public function update_info($new_tags, $exist_tags) {
        if (!empty($exist_tags)) {
            foreach ($exist_tags as $ex) {
                $model = ORM::factory('Feedback');
                $model->where('id', '=', $ex['id'])->find();
                $model->name = $ex['name'];
                $model->type = $ex['type'];
                $model->status = $ex['status'];
                $model->tag = $ex['type_tag'];
                $model->placeholder = $ex['placeholder'];
                $model->save();
            }
        }
        if (!empty($new_tags)) {
            foreach ($new_tags as $ex) {
                $model = ORM::factory('Feedback');
                $model->name = $ex['name'];
                $model->status = $ex['status'];
                $model->type = $ex['type'];
                $model->tag = $ex['type_tag'];
                $model->placeholder = $ex['placeholder'];
                $model->save();
            }
        }
        return true;
    }

}