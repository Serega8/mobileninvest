<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Votesusers extends ORM {

    protected $_table_name = 'votes_users';
    protected $_belongs_to = array(
        'voteitem' => array(
            'model' => 'Votesitem',
            'foreign_key' => 'id',
        ),
    );

    public function all() {
        $model = ORM::factory('Votesusers')->find_all();
        $result = array();
        $lres = array();
        $result_arr = array();
        foreach ($model as $m) {
            $res['var_id'] = $m->for;
            $res['id'] = $m->id;
            $vote_id = ORM::factory('Voteitem')->where('id', '=', $m->for)->find();
            $q = ORM::factory('Votes')->where('id', '=', $vote_id->vote_id)->find();
            $res['q_val'] = $q->question;
            $res['q_id'] = $q->id;
            $result[] = $res;
        }
        foreach ($result as $r) {
            foreach ($result as $r2) {
                if ($r['q_id'] == $r2['q_id'] && $r['id'] == $r2['id']) {
                    $lres[$r['q_id']][] = $r;
                }
            }
        }
        foreach ($lres as $k => $lr) {
            foreach ($lr as $l) {
                $count = 0;
                foreach ($lr as $l2) {
                    if ($l2['var_id'] == $l['var_id']) {
                        $count++;
                    }
                }
                $new[$l['var_id']] = $count;
            }
            $c = count($lr);

            foreach ($new as $k => $n) {
                $new[$k] = $n / $c;
            }
            $result_arr[$k] = $new;
        }
        return $result_arr;
    }

    public function add_item($data) {
        $model = ORM::factory('Votesusers');
        $model->for = $data['for'];
        $model->ip = $data['ip'];
        $model->date = $data['date'];
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

}
?>