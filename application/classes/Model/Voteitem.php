<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Voteitem extends ORM {

    protected $_table_name = 'vote_item';
    protected $_belongs_to = array(
        'votes' => array(
            'model' => 'Votes',
            'foreign_key' => 'id',
        ),
    );

    public function all_items() {
        $model = ORM::factory('Voteitem');
        $all = $model->where('status', '!=', '3')->find_all();
        $result = array();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $res['vote_id'] = $a->vote_id;
            $res['text'] = $a->text;
            $res['val'] = 0;
            $res['status'] = $a->status;
            $result[] = $res;
        }
        return $result;
    }

    public function items_by_id($id) {
        $model = ORM::factory('Voteitem');
        $all = $model->where('vote_id', '=', $id)->where('status', '!=', '3')->find_all();
        $result = array();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $res['vote_id'] = $a->vote_id;
            $res['text'] = $a->text;
            $res['val'] = 0;
            $res['status'] = $a->status;
            $result[] = $res;
        }
        return $result;
    }

    public function update_info($id, $new, $exist, $q, $type) {
        $model_vote = ORM::factory('Votes');
        if ($type == 'edit') {
            $model_vote->where('id', '=', $id)->find();
        }
        $of = false;
        $model_vote->question = $q;
        if ($model_vote->save()) {
            $of = true;
        }
        $pk = $model_vote->pk();
        if (!empty($new)) {
            foreach ($new as $n) {
                $model_new = ORM::factory('Voteitem');
                $model_new->text = $n['text'];
                if ($type == 'edit') {
                    $model_new->vote_id = $id;
                } else {
                    $model_new->vote_id = $pk;
                }
                $model_new->save();
            }
        }
        if (!empty($exist)) {
            foreach ($exist as $e) {
                $model_ex = ORM::factory('Voteitem')->where('id', '=', $e['id'])->find();
                $model_ex->text = $e['text'];
                $model_ex->status = $e['status'];
                $model_ex->save();
            }
        }
        return $of;
    }

}

?>