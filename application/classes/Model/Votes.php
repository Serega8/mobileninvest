<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Votes extends ORM {

    protected $_table_name = 'votes_id';

    public function all_polls() {
        $model = ORM::factory('Votes');
        $all = $model->where('status', '!=', '3')->find_all();
        $result = array();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $res['q'] = $a->question;
            $res['date'] = $a->date;
            $res['status'] = $a->status;
            $result[] = $res;
        }
        return $result;
    }

    public function poll_by_id($id) {
        $res = array();
        $model = ORM::factory('Votes');
        $a = $model->where('id', '=', $id)->find();
        $res['id'] = $a->id;
        $res['q'] = $a->question;
        $res['date'] = $a->date;
        $res['status'] = $a->status;
        return $res;
    }
    
    public function get_last_poll() {
        $res = array();
        $model = ORM::factory('Votes');
        $a = $model->where('status','=','0')->order_by('id','desc')->limit(1)->find();
        $res['id'] = $a->id;
        $res['q'] = $a->question;
        $res['date'] = $a->date;
        $res['status'] = $a->status;
        return $res;
    }
    
    public function update_status($data) {
        $data_ids = array();
        if (empty($data['ids'])) {
            return false;
        }
        $data_ids = explode(',',$data['ids']);
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
            $model = ORM::factory('Votes');
            $model->where('id', '=', $id)->find();
            $model->status = $status;
            if ($model->save()) {
                $of = true;
            }
            else {
                return false;
            }
        }
        return $of;
    }

}

?>