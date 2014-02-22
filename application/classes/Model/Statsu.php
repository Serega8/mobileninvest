<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Statsu extends ORM {

    protected $_table_name = 'stats_uniq';

    public function insert_user_info($data) {
        $model = ORM::factory('Statsu');
        $count = $model->where('ip', '=', $data['ip'])->count_all();
        if ($count == 0) {
            $model->to = $data['to'];
            $model->from = $data['from'];
            $model->browser = $data['browser'];
            $model->date = $data['date'];
            $model->ip = $data['ip'];
            $model->save();
        }
    }

}

?>