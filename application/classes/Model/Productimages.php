<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Productimages extends ORM {
    protected $_table_name = 'product_images';
    protected $_belongs_to = array(
        'sub_categories' => array(
            'model' => 'Products',
            'foreign_key' => 'id',
        ),
    );
    
    
    
    
    public function insert_image($filename,$id = NULL) {
        if ($id == NULL) {
            $id = Model::factory('Pk')->pk('products');
        }
        $model = ORM::factory('Productimages');
        $model->img_url = $filename['big'];
        $model->img_url_small = $filename['small'];
        $model->product_id = $id;
        $model->save();
    }
    
    public function update_info($data) {
         if (!empty($data)) {
             foreach($data as $d) {
                 $model = ORM::factory('Productimages');
                 $model->where('id','=',$d['id'])->find();
                 $model->img_title = $d['img_title'];
                 $model->img_alt = $d['img_alt'];
                 $model->status = $d['status'];
                 $model->save();
             }
         }
    }
    
    public function product_images($id) {
        $model = ORM::factory('Productimages');
        $result= array();
        $images = $model->where('product_id','=',$id)->and_where('status', '!=','3')->find_all();
        foreach ($images as $i) {
            $res['id'] = $i->id;
            $res['img_url']=$i->img_url;
            $res['img_url_small']=$i->img_url_small;
            $res['img_alt']=$i->img_alt;
            $res['product_id']=$i->product_id;
            $res['img_title']=$i->img_title;
            $res['status']=$i->status;
            $result[]=$res;
        }
        return $result;
    }
}