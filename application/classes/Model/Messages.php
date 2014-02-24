<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Messages extends ORM {

    protected $_table_name = 'messages';

    public function add_msg($text) {
        $of = false;
        $model_id = ORM::factory('Msgid');
        $model_id->ip = $text['ip'];
        $model_id->date = $text['date'];
        if ($model_id->save()) {
            $of = true;
        } else {
            return false;
        }
        $id = $model_id->pk();
        if ($of) {
            $of = false;
            foreach ($text['result'] as $k=>$ex) {
                $model = ORM::factory('Messages');
                $model->text = $ex;
                $model->msg_id = $id;
                $model->tag_id = $k;
                if ($model->save()) {
                    $of = true;
                } else {
                    return false;
                }
            }
        }
        return $of;
    }
    
//    public function add_msg($text)
//    {
//        if (isset($text['result']['to_email'])) {
//            $header = "Content-type: text/html; charset=utf-8\r\n";
//		$config = Kohana::$config->load('email');
//    		Email::connect($config);
//            if ($text['result']['to_email'] == 'moscow') {
//                
//                $city = 'Moscow';
//                $msg = "\nИмя отправителя: ".$text['result']['1']."\nТелефон: ".$text['result']['2']."\nТекст сообщения: ".$text['result']['3']."\n";
//                $msg.='Город: '.$city;
//
//		$to = 'moscow@mobileninvest.by';
//    		$subject = 'Сообщение обратной связи mobileninvest.by';
//    		$from = 'moscow@mobileninvest.by';
//    		Email::send($to, $from, $subject, $msg, $html = false);
//
//		
//
//                //mail("support@intellectit.by",  'Обратная связь сайта lmgr.by', $msg,$header);
//                
//            } else if ($text['result']['to_email'] == 'minsk') {
//                    $city = 'Minsk';
//                    $msg = "\nИмя отправителя: ".$text['result']['1']."\nТелефон: ".$text['result']['2']."\nТекст сообщения: ".$text['result']['3']."\n";
//                    $msg.='Город: '.$city;
//                    $to = 'minsk@mobileninvest.by';
//    		$subject = 'Сообщение обратной связи mobileninvest.by';
//    		$from = 'moscow@mobileninvest.by';
//    		Email::send($to, $from, $subject, $msg, $html = false);
//                     
//                } else {
//                    die('error code 404');
//                }
//        }
//        else {
//            die('error code 404');   
//        }
//        $of = false;
//        $model_id = ORM::factory('Msgid');
//        $model_id->ip = $text['ip'];
//        $model_id->date = $text['date'];
//        if ($model_id->save()) {
//            $of = true;
//        } else {
//            return false;
//        }
//        $id = $model_id->pk();
//        if ($of) {
//            $of = false;
//            foreach ($text['result'] as $k => $ex) {
//                $model = ORM::factory('Messages');
//                $model->text = $ex;
//                $model->msg_id = $id;
//                $model->tag_id = $k;
//                if ($model->save()) {
//                    $of = true;
//                } else {
//                    return false;
//                }
//            }
//        }
//        return $of;
//    }
    

    public function get_all_messages() {
        $avialable = array();
        $ids = array();
        $res = array();
        $msgs = array();
        $result = array();
        $full = array();
        /*
         * Забираем данные из таблицы Msg_id;
         */

        $model_id = ORM::factory('Msgid');
        
        $all = $model_id->where('status', '!=', '3')->order_by('id','DESC')->find_all();
        foreach ($all as $a) {
            $res['id'] = $a->id;
            $ids[] = $res['id'];
            $res['date'] = $a->date;
            $res['ip'] = $a->ip;
            $res['status'] = $a->status;
            $avialable[] = $res;
        }
        if (empty($ids)) {
            return false;
        }
        $res = array();
        /*
         * По этим данные выбираем сообщения из таблицы Messages;
         */
        $model_msg = ORM::factory('Messages');
        $all_msg = $model_msg->where('msg_id', 'IN', $ids)->find_all();
        foreach ($all_msg as $am) {
            $res['tag_id'] = $am->tag_id;
            $res['text'] = $am->text;
            $res['msg_id'] = $am->msg_id;
            $msgs[] = $res;
        }
        foreach ($avialable as $av) {
            foreach ($msgs as $msg) {
                if ($av['id'] == $msg['msg_id']) {
                    $av['messages'][] = $msg;
                }
            }
            $full[] = $av;
        }
        return $full;
    }

}
?>