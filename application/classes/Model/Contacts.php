<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Contacts extends ORM {

    protected $_table_name = 'contacts';

    public function get_contacts() {
        $model = ORM::factory('Contacts');
        $model->where('id', '=', '1')->find();
        $res = array();
        $res['vel'] = $model->velcom;
        $res['mts'] = $model->mts;
        $res['life'] = $model->life;
        $res['dialog'] = $model->dialog;
        $res['gorod'] = $model->gorod;
        $res['name'] = $model->name;
        $res['img_url'] = $model->img_url;
        $res['other'] = $model->other;
        $res['adr'] = $model->adr;
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
        $model = ORM::factory('Contacts');
        $model->where('id', '=', '1')->find();
        $model->velcom = $data['velcom'];
        $model->mts = $data['mts'];
        $model->life = $data['life'];
        $model->dialog = $data['dialog'];
        $model->gorod = $data['gorod'];
        $model->name = $data['name'];
        $model->img_url = $data['img_url'];
        $model->other = $data['other'];
        $model->adr = $data['adr'];
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

}

?>