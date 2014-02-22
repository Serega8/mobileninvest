<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Articleimages extends ORM {

    protected $_table_name = 'article_images';

    public function get_images($id) {
        $c = array();
        $model_images = ORM::factory('Articleimages');
        $all_img = $model_images->where('parent_id', '=', $id)->find_all();
        foreach ($all_img as $inf) {
            $res['id'] = $inf->id;
            $res['img_url'] = $inf->img_url;
            $res['img_alt'] = $inf->img_alt;
            $res['img_title'] = $inf->img_title;
            $res['status'] = $inf->status;
            $c[] = $res;
        }
        return $c;
    }

}