<?php

error_reporting(E_ALL ^ E_DEPRECATED);

defined('SYSPATH') or die('No direct script access.');

class Model_Stats extends ORM {

    protected $_table_name = 'stats';

    public function insert_user_info($data) {
        $model = ORM::factory('Stats');
        $model->to = $data['to'];
        $model->browser = $data['browser'];
        $model->from = $data['from'];
        $model->date = $data['date'];
        $model->ip = $data['ip'];
        $model->save();
    }

    public function stats() {
        $model = ORM::factory('Stats');
        $all = $model->find_all();
        $safari = 0;
        $opera = 0;
        $chrome = 0;
        $firefox = 0;
        $mobile = 0;
        $ie = 0;
        $bot = 0;
        $browser = array();
        foreach ($all as $a) {
            $browser[] = $a->browser;
            $visited[] = $a->to;
        }
        $other = 0;



        if (!empty($browser)) {
            foreach ($visited as $vis) {
                
            }
            foreach ($browser as $r) {
                if (!empty($r)) {
                    if (strripos($r, 'Safari')) {
                        $safari++;
                    }
                    if (strripos($r, 'opera')) {
                        $opera++;
                    }
                    if (strripos($r, 'firefox')) {
                        $firefox++;
                    }
                    if (strripos($r, 'chrome')) {
                        $chrome++;
                    }
                    if (strripos($r, 'explorer')) {
                        $ie++;
                    }
                    if (strripos($r, 'mobile')) {
                        $mobile++;
                    }
                    if (strripos($r, 'robot')) {
                        $bot++;
                    }
                }
            }
        }
        $array['Opera'] = $opera;
        $array['Chrome'] = $chrome;
        $array['Firefox'] = $firefox;
        $array['Internet Exploerer'] = $ie;
        $array['Mobile'] = $mobile;
        $array['Bot'] = $bot;
//        $array['Other'] = $other;
        $array['Safari'] = $safari;
        return $array;
    }

    public function get_stats() {
        $model = ORM::factory('Stats');
        $all_count = $model->count_all();
        $pagination = Pagination::factory(array('total_items' => $all_count,
                    'items_per_page' => 10))
                ->route_params(array('controller' => Request::current()->controller(),
            'action' => Request::current()->action()));


        $all = $model
                ->limit($pagination->items_per_page)
                ->offset($pagination->offset)
                ->order_by('id', 'DESC')
                ->find_all();



        $result = array();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $res['to'] = $a->to;
            $res['from'] = $a->from;
            $res['date'] = $a->date;
            $res['browser'] = $a->browser;
            $res['ip'] = $a->ip;
            $result[] = $res;
        }
        $array['pagination'] = $pagination;
        $array['result'] = $result;
        $array['all'] = $all_count;
        return $array;
    }

}

?>