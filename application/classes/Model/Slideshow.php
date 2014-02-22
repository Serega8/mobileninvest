<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Slideshow extends ORM {

    protected $_table_name = 'slideshow';
    
    public function all_slides($client = FALSE) {
        $s = array();
        $model = ORM::factory('Slideshow');
        if (!$client) {
            $all = $model->where('status','!=','3')->find_all();
        }
        else {
             $all = $model->where('status','=','0')->find_all();
        }
        foreach ($all as $data) {
            $res['id'] = $data->id;
            $res['img_alt'] = $data->img_alt;
            $res['img_url'] = $data->img_url;
            $res['img_title'] = $data->img_title;
            $res['status'] = $data->status;
            $res['sort'] = $data->sort;
            $s[] = $res;
        }
        return $s;
    }
    public function insert_image($filename) {
        $model = ORM::factory('Slideshow');
        $model->img_url = $filename;
        $model->save();
        return true;
    }
    public function update_info($data) {
         if (!empty($data)) {
             $of = true;
             foreach($data as $d) {
                 $model = ORM::factory('Slideshow');
                 $model->where('id','=',$d['id'])->find();
                 $model->img_title = $d['img_title'];
                 $model->img_alt = $d['img_alt'];
                 $model->status = $d['status'];
                 if ($model->save()) {
                     $of = true;
                 }
                 else {
                     $of = false;
                 }
             }
             return $of;
         }
         else {
             return false;
         }
    }
}