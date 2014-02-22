<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Msgid extends ORM {

    protected $_table_name = 'msg_id';

    public function update_status($data) {
        $data_ids = array();
        if (empty($data['ids'])) {
            return false;
        }
        $data_ids = explode(',', $data['ids']);
        $status = 0;
        $of = false;
        switch ($data['type']) {
            case 'delete':
                $status = 3;
                break;
            case 'read':
                $status = 1;
                break;
            default:
                return false;
                break;
        }
        foreach ($data_ids as $id) {
            $model = ORM::factory('Msgid');
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

    public function get_msg($id) {
        $model = ORM::factory('Msgid');
        $model->where('id', '=', $id)->find();
        $model->status = 1;
        $model->save();
        $message = array();
        $model_msg = ORM::factory('Messages');
        $msg = $model_msg->where('msg_id', '=', $id)->find_all();
        foreach ($msg as $m) {
            $res['id'] = $m->id;
            $res['tag_id'] = $m->tag_id;
            $res['text'] = $m->text;
            $message[] = $res;
        }
        return $message;
    }

    public function ip_addr($id) {
        $model = ORM::factory('Msgid');
        $model->where('id', '=', $id)->find();
        $res = array();
        $res['ip'] = $model->ip;
        $res['date'] = $model->date;
        return $res;
    }

}