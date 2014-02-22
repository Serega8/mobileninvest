<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Details extends ORM {

    protected $_table_name = 'details';

    public function get_details($level2 = FALSE, $product_id = FALSE) {
        $details = array();
        $sub_details = array();
        $ids_details = array();
        $ids_sub = array();
        $product_c = array();
        $model_details = ORM::factory('Details');
        if ($level2) {
            $model_categories = ORM::factory('Categories');
            $category = $model_categories->where('translit_name', '=', $level2)->and_where('status', '!=', '3')->find();
            $id = $category->id;
            $all_details = $model_details->where('status', '=', '0')->and_where('category_id', '=', $id)->find_all();
            $all_details_all_cat = $model_details->where('status', '=', '0')->and_where('category_id', '=', '0')->find_all();
            foreach ($all_details_all_cat as $ad) {
                $res['name'] = $ad->name;
                $res['category_id'] = $ad->category_id;
                $res['status'] = $ad->status;
                $res['id'] = $ad->id;
                $ids_details[] = $res['id'];
                $details[] = $res;
            }
        } else { //для редактирования
            $all_details = $model_details->where('status', '=', '0')->find_all();
        }
        foreach ($all_details as $ad) {
            $res['name'] = $ad->name;
            $res['category_id'] = $ad->category_id;
            $res['status'] = $ad->status;
            $res['id'] = $ad->id;
            $ids_details[] = $res['id'];
            $details[] = $res;
        }






        if (!empty($details)) {
            $model_sub_details = ORM::factory('Subdetails');
            $that_sub_details = $model_sub_details->where('status', '=', '0')->and_where('detail_id', 'IN', $ids_details)->find_all();
            foreach ($that_sub_details as $tsd) {
                $res2['detail_id'] = $tsd->detail_id;
                $res2['key'] = $tsd->key;
                $res2['status'] = $tsd->status;
                $res2['id'] = $tsd->id;

                $ids_sub[] = $res2['id'];
                $sub_details[] = $res2;
            }

            if (!$product_id && !empty($ids_sub)) {
                $model_sub_val = ORM::factory('Subdetailsval');
                $values = $model_sub_val->where('status', '=', '0')->where('sub_detail_id', 'IN', $ids_sub)->find_all();
                foreach ($values as $val) {
                    $res3['id'] = $val->id;
                    $res3['sub_detail_id'] = $val->id;
                    $res3['val'] = $val->value;
                    $product_c[] = $res3;
                }
            }
        }
        $array['details'] = $details;
        if (!empty($product_c)) {
            $array['$product_c'] = $product_c;
        }
        $array['sub'] = $sub_details;
        return $array;
    }

    public function update_details($details_exist = FALSE, $details_new = FALSE, $group_exist = FALSE, $group_new = FALSE) {
        $of = false;
        if (!$details_exist && !$details_new && !$group_exist && !$group_new) {
            return false;
        } else {
            if ($group_exist) {
                foreach ($group_exist as $exd) {
                    $model_details = ORM::factory('Details');
                    $model_details->where('id', '=', $exd['id_group'])->find();
                    $model_details->status = $exd['status'];
                    if ($exd['status'] == '3') {
                        $names = ORM::factory('Subdetails')->where('detail_id', '=', $model_details->id)->find_all();
                        foreach ($names as $name) {
                            $model_name = ORM::factory('Subdetails')->where('id', '=', $name->id)->find();
                            $model_name->status = '3';
                            $values = ORM::factory('Subdetailsval')->where('id', '=', $model_name->id)->find_all();
                            foreach ($values as $val) {
                                $model_values = ORM::factory('Subdetailsval')->where('id', '=', $val->id)->find();
                                $model_values->status = '3';
                                $model_values->save();
                            }
                            $model_name->save();
                        }
                    }
                    $model_details->name = $exd['name'];
                    $model_details->category_id = $exd['cid'];
                    if ($model_details->save()) {
                        $of = true;
                        $pk = $model_details->pk();
                    }
                    if (!empty($details_new)) {
                        foreach ($details_new as $det_ext) {
                            if ($det_ext['gid'] == $exd['id_group']) {
                                $model_sub = ORM::factory('Subdetails');
                                $model_sub->status = $det_ext['status'];
                                $model_sub->key = $det_ext['name'];
                                $model_sub->detail_id = $pk;
                                $model_sub->save();
                            }
                        }
                    }
                }
            }
            if (!empty($details_exist)) {
                foreach ($details_exist as $det_ext) {
                    $model_sub = ORM::factory('Subdetails');
                    $model_sub->where('id', '=', $det_ext['id'])->find();
                    $model_sub->status = $det_ext['status'];
                    if ($det_ext['status'] == '3') {
                        $all_val = ORM::factory('Subdetailsval')->where('sub_detail_id', '=', $det_ext['id'])->find_all();
                        foreach ($all_val as $av) {
                            $sdv = ORM::factory('Subdetailsval')->where('id', '=', $av->id)->find();
                            $sdv->status = '3';
                            $sdv->save();
                        }
                    }
                    $model_sub->key = $det_ext['name'];
                    $model_sub->save();
                }
            }



            if ($group_new) {
                foreach ($group_new as $exd) {
                    $model_details = ORM::factory('Details');
                    $model_details->status = $exd['status'];
                    $model_details->name = $exd['name'];
                    $model_details->category_id = $exd['cid'];
                    if ($model_details->save()) {
                        $pk = $model_details->pk();
                        $of = true;
                    }
                    if (!empty($details_new)) {
                        foreach ($details_new as $det_ext) {
                            if ($det_ext['gid'] == $exd['id_group']) {
                                $model_sub = ORM::factory('Subdetails');
                                $model_sub->status = $det_ext['status'];
                                $model_sub->key = $det_ext['name'];
                                $model_sub->detail_id = $pk;
                                if ($model_sub->save()) {
                                    $of = true;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $of;
    }

}