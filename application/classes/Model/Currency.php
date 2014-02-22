<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Currency extends ORM {

    protected $_table_name = 'currency';

    public function get_currency() {
        $model = ORM::factory('Currency');
        $all = $model->where('status', '=', '0')->find_all();
        $result = array();
        foreach ($all as $value) {
            $res['id'] = $value->id;
            $res['name'] = $value->name;
            $res['val'] = $value->val;
            $res['status'] = $value->status;
            $result[] = $res;
        }
        return $result;
    }

    public function update_info($exist, $new) {
        if (!empty($new)) {
            foreach ($new as $n) {
                $model_new = ORM::factory('Currency');
                $model_new->val = $n['val'];
                $model_new->name = $n['name'];
                $model_new->status = $n['status'];
                $model_new->save();
            }
        }
        if (!empty($exist)) {
            foreach ($exist as $e) {
                $model_ex = ORM::factory('Currency')->where('id', '=', $e['id'])->find();
                $model_ex->val = $e['val'];
                $model_ex->name = $e['name'];
                $model_ex->status = $e['status'];
                $model_ex->save();
            }
        }
        return true;
    }

}

?>