<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Subdetailsval extends ORM {

    protected $_table_name = 'sub_details_val';
    protected $_has_many = array(
        'subdetails' => array(
            'model' => 'Subdetails',
            'through' => 'id',
        ),
    );

    public function get_values($id) {
        $model = ORM::factory('Subdetailsval');
        $result = array();
        $all = $model->where('product_id', '=', $id)->and_where('status','!=','3')->find_all();
        foreach ($all as $a) {
            $res['product_id'] = $a->product_id;
            $res['sub_detail_id'] = $a->sub_detail_id;
            $res['id'] = $a->id;
            $res['val'] = $a->value;
            $res['status'] = $a->status;
            $result[] = $res;
        }
        return $result;
    }

    public function insert_data($val, $id) {
        if (!empty($val)) {
            foreach ($val as $v) {
                $model_val = ORM::factory('Subdetailsval');
                if ($v['val_id'] !== null) {
                    $model_val->where('id', '=', $v['val_id'])->find();
                }
                $model_val->value = $v['val'];
                $model_val->product_id = $id;
                $model_val->sub_detail_id = $v['sid'];
                $model_val->save();
            }
        } else {
            return false;
        }
    }

}

?>