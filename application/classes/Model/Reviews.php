<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Reviews extends ORM {

    protected $_table_name = 'reviews';
    protected $_belongs_to = array(
        'products' => array(
            'model' => 'Products',
            'foreign_key' => 'id',
        ),
    );

    public function get_review_by_id($id) {
        if (!is_numeric($id)) {
            return false;
        } else {
            $res = array();
            $a = ORM::factory('Reviews');
            $a->where('id', '=', $id)->find();
            $res['id'] = $a->id;
            $res['val'] = $a->val;
            $res['product_id'] = $a->product_id;
            $res['name'] = $a->name;
            $res['ip'] = $a->ip;
            $res['email'] = $a->email;
            $res['date'] = $a->date;
            $res['text'] = $a->text;
            $res['status'] = $a->status;
            return $res;
        }
    }

    public function update_review($data) {
        if (!is_numeric($data['id'])) {
            return false;
        } else {
            $model = ORM::factory('Reviews');
            $model->where('id', '=', $data['id'])->find();
            $model->text = $data['text'];
            $model->name = $data['name'];
            $model->val = $data['val'];
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function add_review($data) {
        if (!is_numeric($data['product_id'])) {
            return false;
        } else {
            $model = ORM::factory('Reviews');
            $model->text = $data['text'];
            $model->email = $data['email'];
            $model->product_id = $data['product_id'];
            $model->name = $data['name'];
            $model->val = $data['val'];
            $model->date = date('U');
            $model->ip = $_SERVER['REMOTE_ADDR'];
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function add_review_client($data) {
        $m = ORM::factory('Products')->where('name_translit', '=', $data['product_translit'])
                ->and_where('status', '=', '0')
                ->find();
        $id = $m->id;
        $model = ORM::factory('Reviews');
        $model->text = $data['text'];
        $model->email = $data['email'];
        $model->product_id = $id;
        $model->name = $data['name'];
        $model->val = $data['val'];
        $model->date = date('U');
        $model->ip = $_SERVER['REMOTE_ADDR'];
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_reviews_by_product_id($id, $client = false) {
        if ($client) {
            $op = '=';
            $status = 0;
        } else {
            $op = '!=';
            $status = 3;
        }
        if (!is_numeric($id)) {
            return false;
        } else {
            $result = array();
            $model = ORM::factory('Reviews');
            $all = $model->where('product_id', '=', $id)
                    ->and_where('status', $op, $status)
                    ->find_all();
            foreach ($all as $a) {
                $res['id'] = $a->id;
                $res['product_id'] = $a->product_id;
                $res['name'] = $a->name;
                $res['ip'] = $a->ip;
                $res['email'] = $a->email;
                $res['val'] = $a->val;
                $res['date'] = $a->date;
                $res['text'] = $a->text;
                $res['status'] = $a->status;
                $result[] = $res;
            }
            return $result;
        }
    }

    public function get_all_reviews() {
        $result = array();
        $model = ORM::factory('Reviews');
        $all = $model->where('status', '!=', '3')->order_by('date', 'desc')->find_all();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $res['product_id'] = $a->product_id;
            $res['name'] = $a->name;
            $res['ip'] = $a->ip;
            $res['email'] = $a->email;
            $res['date'] = $a->date;
            $res['text'] = $a->text;
            $res['status'] = $a->status;
            $result[] = $res;
        }
        return $result;
    }

    public function update_status($data) {
        $data_ids = array();
        if (!isset($data['ids'])) {
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
            $model = ORM::factory('Reviews');
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

    public function products_with_reviews() {
        $result = array();
        $ids = array();
        $model = ORM::factory('Reviews');
        $all = $model->where('status', '!=', '3')->find_all();
        foreach ($all as $a) {
            $ids[] = $a->product_id;
        }
        if (!empty($ids)) {
            $model_prodcuts = ORM::factory('Products');
            $all_products = $model_prodcuts->where('id', 'IN', $ids)->and_where('status', '!=', '3')->find_all();

            foreach ($all_products as $inf) {
                $res['id'] = $inf->id;
                $sub_id = $inf->sub_category_id;
                if (!$sub_id == NULL) {
                    $model_sub = ORM::factory('Subcategories');
                    $that = $model_sub->where('id', '=', $sub_id)->find();
                    $res['level3'] = $that->sub_translit;
                } else {
                    $res['level3'] = null;
                }

                $cat_id = $inf->category_id;
                $model_sub = ORM::factory('Categories');
                $that = $model_sub->where('id', '=', $cat_id)->find();
                if ($that->status !== '3') {
                    $res['level2'] = $that->translit_name;
                    $res['product_name'] = $inf->product_name;
                    $res['translit_name'] = $inf->name_translit;
                    $res['date'] = $inf->date;
                    $res['cost'] = $inf->cost;
                    $res['currency'] = $inf->currency;
                    $res['status'] = $inf->status;
                    $result[] = $res;
                }
            }
        }
        return $result;
    }

}

?>