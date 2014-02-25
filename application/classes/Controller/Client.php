<?php

defined('SYSPATH') or die('No direct script access.');
//error_reporting(E_ALL ^ E_NOTICE);

class Controller_Client extends Controller_Template {

    public $template = 'client/template';

    public function before() {

        parent::before();
        session_start();

        $_SESSION['y'] = false;
        if (isset($_SESSION['poll_id'])) {
            $poll = ORM::factory('Votes')->get_last_poll();
            if ($_SESSION['poll_id'] == $poll['id'])
                $_SESSION['y'] = true;
        }

        $categories = ORM::factory('Products')->get_tree(true);
        $contacts = ORM::factory('Contacts')->get_contacts();
        $this->template->contacts = $contacts;
        $this->template->menu = $categories['main'];
        $this->template->sub_menu = $categories['sub'];


        $styles = array(
            
            'content/css/flexslider.css',
            'content/css/lightbox.css',
            'content/css/style.css',
            'content/css/font-awesome.min.css',
            'content/css/adaptation.css',
            'content/css/style.less',
        );
        $scripts = array(
            'content/client_js/jquery.min.js',
            'content/client_js/jquery.flexslider.js',
            'content/client_js/custom.js',
            'content/client_js/lightbox-2.6.min.js',
            'content/client_js/jquery.carouFredSel-6.2.1-packed.js',
        );

        $this->template->styles = $styles;
        $this->template->scripts = $scripts;
    }

    public function action_index() {
        $view = View::factory('client/index');
        $view->slides = ORM::factory('Slideshow')->all_slides();
        $view->contacts = ORM::factory('Contacts')->get_contacts();
        $poll = ORM::factory('Votes')->get_last_poll();


        $all_items = ORM::factory('Voteitem')->items_by_id($poll['id']);

        $votes = ORM::factory('Votesusers')->all();
        $all = Controller_Admin::poll_result($votes, $all_items);
        $view->items = $all;

        $view->poll = $poll;

        $this->template->seo = ORM::factory('Brands')->seo('/');
        $this->template->content = $view;
    }
    
    public function action_about() {
        $view = View::factory('client/about');
        $this->template->content = $view;
    }
    
    public function action_partners() {
        $view = View::factory('client/partners');
        $this->template->content = $view;
    }
    
     public function action_layout() {
        $view = View::factory('client/layout');
        $this->template->content = $view;
    }
    
    

    
    
    
    public function action_contact() {
        $view = View::factory('client/contact');
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
        }
        $view->contacts = ORM::factory('Contacts')->get_contacts();
        
        if ($this->request->post())
	{
            $data = "\nСообщение: ".$_POST['message']."\n\n\nОт (Имя): ".$_POST['name']."\nemail: ".$_POST['email'];
		$to  = "fest2010@mail.ru";
    	        $subject = 'imobileninvest.by >> Сообщение с страницы контактов.';
		if(mail($to, $subject, $data))
		{
		    $message = "Сообщение успешно отправлено!";
		    $view->message = $message;
		}
		else
		{
		    $error = "Сообщение не отправлено. Произошла ошибка, обратитесь к администратору сайта.";
		    $view->error = $error;
		}

		$to  = "7331603@gmail.com";
		if(mail($to, $subject, $data))
		{
		    $message = "Сообщение успешно отправлено!";
		    $view->message = $message;
		}
		else
		{
		    $error = "Сообщение не отправлено. Произошла ошибка, обратитесь к администратору сайта.";
		    $view->error = $error;
		}

		$to  = "agintowt1@gmail.com";
		if(mail($to, $subject, $data))
		{
		    $message = "Сообщение успешно отправлено!";
		    $view->message = $message;
		}
		else
		{
		    $error = "Сообщение не отправлено. Произошла ошибка, обратитесь к администратору сайта.";
		    $view->error = $error;
		}
        }
        
        

        $this->template->content = $view;
    }
    
    
    
    public function action_poll() {
        if ($this->request->post()) {
            if (is_numeric($_POST['poll'])) {
                $data['for'] = $_POST['poll'];
                $data['ip'] = $_SERVER['REMOTE_ADDR'];
                $data['date'] = date('U');
                $poll = ORM::factory('Votes')->get_last_poll();
                if (ORM::factory('Votesusers')->add_item($data)) {
                    $_SESSION['poll_id'] = $poll['id'];
                    $this->redirect('/');
                }
            }
        }
        $this->redirect('/');
    }
    
    
    

    public function action_search() {
        if ($this->request->post()) {
            $model_products = ORM::factory('Products');
            $query = trim(htmlspecialchars(strip_tags(strip_tags($_POST['q']))));
            $res = $model_products->search_products($query, true);
            $view = View::factory('search');
            $view->products = $res;
            $this->template->content = $view;
        } else {
            $view = View::factory('search');
            $this->template->content = $view;
        }
    }

    public function action_group_del() {
        $all = ORM::factory('Subdetails')->where('detail_id', '!=', '43')->find_all();
        foreach ($all as $a) {
            $m = ORM::factory('Subdetailsval')->where('sub_detail_id', '=', $a->id)->find_all();
            foreach ($m as $ms) {
                $msave = ORM::factory('Subdetailsval')->where('id', '=', $ms->id)->find();
                $msave->status = 3;
                echo $msave->id . ' ---Удалена характеристика<br>';
                $msave->save();
            }
        }
    }

    public function action_articles() {
        $action = $this->request->action();
        $this->template->action = $action;
        $param = $this->request->param();
        $level2 = isset($param['level2']) ? $param['level2'] : NULL;
        $level3 = isset($param['level3']) ? $param['level3'] : NULL;
        $level4 = isset($param['level4']) ? $param['level4'] : NULL;
        $level5 = isset($param['level5']) ? $param['level5'] : NULL;
        $var = 'list_articles';
        if ($level2 !== NULL) {
            $var = 'article_info';
        }
        switch ($var) {
            case 'list_articles':
                $view = View::factory('client/articles');
                $articles = ORM::factory('Articles')->all_articles();
                $view->articles = $articles;

                $this->template->seo = ORM::factory('Brands')->seo('articles');
                $this->template->content = $view;
                break;
            case 'article_info':
                $view = View::factory('client/article_info');
                $article = ORM::factory('Articles')->article($level2);
                $view->article = $article;
                $view->images = ORM::factory('Articleimages')->get_images($article['id']);
                $this->template->content = $view;
                break;
            default:
                die;
                break;
        }
    }

    public function action_brands() {
        $action = $this->request->action();
        $this->template->action = $action;
        $param = $this->request->param();
        $level2 = isset($param['level2']) ? $param['level2'] : NULL;
        $level3 = isset($param['level3']) ? $param['level3'] : NULL;
        $level4 = isset($param['level4']) ? $param['level4'] : NULL;
        $level5 = isset($param['level5']) ? $param['level5'] : NULL;
        $val = 'list_brands'; //Список категорий
        if ($level2 !== null) {
            $val = 'list_products'; //Список товаров
        } else {
            
        }

        switch ($val) {
            /*
             * Просмотр категорий
             */
            case 'list_brands':
                $view = View::factory('client/brands');
                $view->brands = ORM::factory('Brands')->list_brands();
                $kdst = ORM::factory('Brands')->seo($action);
                $this->template->seo = $kdst;
                $this->template->content = $view;


                break;
            /*
             * Товары выбранного производителя
             */
            case 'list_products':
                $model_products = ORM::factory('Products');
                $all = $model_products->list_products_brands($level2, true);
                $categories = $all['categories'];
                $sub = $all['sub_categories'];
                $this->template->seo = ORM::factory('Brands')->get_brand_by_name($level2);
                $products = $all['products'];
                $view = View::factory('client/products_brand');
                $view->categories = $categories;
                $view->sub_categories = $sub;
                $view->products = $products;
                $this->template->content = $view;
                break;
            default :
                die;
                break;
        }
    }

    public function action_contacts() {
        $action = $this->request->action();
        $view = View::factory('client/contacts');
        $view->c = ORM::factory('Contacts')->get_contacts();
        $kdst = ORM::factory('Contacts')->seo($action);
        $this->template->seo = $kdst;
        $this->template->content = $view;
    }

    public function action_catalog() {
        $action = $this->request->action();
        $this->template->action = $action;
        $param = $this->request->param();
        $level2 = isset($param['level2']) ? htmlspecialchars(trim(strip_tags($param['level2']))) : NULL;
        $level3 = isset($param['level3']) ? htmlspecialchars(trim(strip_tags($param['level3']))) : NULL;
        $level4 = isset($param['level4']) ? htmlspecialchars(trim(strip_tags($param['level4']))) : NULL;
        $level5 = isset($param['level5']) ? htmlspecialchars(trim(strip_tags($param['level5']))) : NULL;
        $val = 'list_categories'; //Список категорий
        if ($level2 !== null) {
            $val = 'list_sub_categories'; //Список подкатегорий
        }
        if ($level3 !== null) {
            $val = 'list_products'; //Список товаров
        }
        if ($level4 !== null) {
            $val = 'product_info'; //Информация о товаре
        }

        switch ($val) {

            /*
             * Весь каталог, т.е все главные категории (1-й уровень);
             */
            case 'list_categories':
                $view = View::factory('client/categories');
                $model = ORM::factory('Categories');
                $view->categories = $model->list_categories();
                $this->template->seo = $model->seo($action);
                $this->template->content = $view;
                break;



            case 'list_sub_categories':
                $model_sub_categories = ORM::factory('Subcategories');
                $all_sub_categories = $model_sub_categories->list_sub_categories($level2, true);
                $all_products = ORM::factory('Products')->list_category_products($level2, true);
                $view = View::factory('client/subcategories');
                $this->template->seo = ORM::factory('Categories')->get_сategory_info($level2);
                $view->level2 = $level2;
                $view->products = $all_products;
                $view->subcategories = $all_sub_categories;
                $this->template->content = $view;
                break;




            case 'list_products':
                $model_products = ORM::factory('Products');
                $model_sub_categories = ORM::factory('Subcategories');
                $count = $model_sub_categories->detect_sp($level2, $level3);
                if ($count >= 1) {

                    $all_products = $model_products->list_products($level2, $level3);

                    $view = View::factory('client/products');

                    $this->template->seo = $model_sub_categories->get_сategory_info($level2, $level3);
                    $view->level2 = $level2;
                    $view->level3 = $level3;
                    $all_sub_categories = $model_sub_categories->list_sub_categories($level2, true);
                    $view->sub_menu = $all_sub_categories;
                    $view->products = $all_products;
                    $this->template->content = $view;
                } else {
                    if ($this->request->post()) {
                        $msg = $this->add_review($_POST, $level3);
                    }
                    $captcha = $this->captcha();
                    $_SESSION['code'] = $captcha['cap'];
                    $model_sub_categories = ORM::factory('Subcategories');
                    $view = View::factory('client/product_info');
                    $product = ORM::factory('Products')->product_main_info($level2, $level3);
                    $this->template->seo = $product;
                    $images = ORM::factory('Productimages')->product_images($product['id']);

                    $details = ORM::factory('Details')->get_details($level2, $product['id']);
                    $details_values = ORM::factory('Subdetailsval')->get_values($product['id']);
                    $view->values = $details_values;
                    $view->details = $details;
                    $view->product = $product;
                    $view->msg = (isset($msg)) ? $msg : null;

                    $view->reviews = ORM::factory('Reviews')->get_reviews_by_product_id($product['id'], true);
                    $view->level2 = $level2;
                    $view->level3 = $level3;
                    $view->images = $images;
                    $this->template->content = $view;
                }
                break;



            case 'product_info':
                if ($this->request->post()) {
                    $msg = $this->add_review($_POST, $level4);
                }
                $captcha = $this->captcha();
                $_SESSION['code'] = $captcha['cap'];
                $model_sub_categories = ORM::factory('Subcategories');
                $view = View::factory('client/product_info');
                $product = ORM::factory('Products')->product_main_info($level2, $level3, $level4);
                $images = ORM::factory('Productimages')->product_images($product['id']);
                $details = ORM::factory('Details')->get_details($level2, $product['id']);
                $details_values = ORM::factory('Subdetailsval')->get_values($product['id']);
                $view->values = $details_values;
                $this->template->seo = $product;
                $view->details = $details;
                $view->msg = (isset($msg)) ? $msg : null;
                $view->product = $product;
                $view->reviews = ORM::factory('Reviews')->get_reviews_by_product_id($product['id'], true);
                $view->level2 = $level2;
                $view->level3 = $level3;
                $view->images = $images;

                $this->template->content = $view;
                break;
        }
    }

    public function action_feedback() {
        if ($this->request->post()) {
            $msg = $this->add_message($_POST);
        }
        $view = View::factory('client/feedback');
        $model = ORM::factory('Feedback');
        $exist = $model->get_all_tags();
        $view->exist = $exist;
        $captcha = $this->captcha();
        $_SESSION['fcode'] = $captcha['cap'];
        $view->msg = isset($msg) ? $msg : null;

        $this->template->seo = ORM::factory('Brands')->seo('feedback');
        $this->template->content = $view;
    }

    public static function to_arr_msg($text) {
        $result = array();
        $array = array();
        $date = Date('U');
        foreach ($text as $obj) {
            if (is_numeric($obj->id)) {
                $res['text'] = stripslashes(htmlspecialchars(trim($obj->text)));
                $res['id'] = $obj->id;
                $result[] = $res;
            } else {
                return false;
            }
        }
        $array['result'] = $result;
        $array['ip'] = $_SERVER['REMOTE_ADDR'];
        $array['date'] = $date;
        return $array;
    }

    public static function add_review($array, $level4) {
        $data = Arr::extract($array, array('name', 'text', 'val', 'email', 'txtpic'));
        $data = Controller_Admin::filter1x($data);

        $data['product_translit'] = $level4;
        $dop = Controller_Client::check($data);
        if (strlen($dop) == 0) {
            if ($_SESSION['code'] == $data['txtpic']) {
                if (ORM::factory('Reviews')->add_review_client($data)) {
                    $msg = 'Ваш отзыв будет опубликован после проверки модератором. Спасибо';
                } else {
                    $msg = 'Неизвестная ошибка';
                }
            } else {
                $msg = 'Код на картинке не совпадает с введенным';
            }
        } else {
            $msg = $dop;
        }
        return $msg;
    }

    public function add_message($array) {
        $of = false;
        $msg = '';
        $data = Controller_Admin::filter1x($array);
        foreach ($data as $k => $d) {
            if (is_numeric($k) || $k == 'txtpic') {
                $of = true;
                if ((strlen($d)) < 4) {
                    $msg = 'Не все поля заполнены';
                    break;
                }
                if ($k == 'txtpic') {
                    if (strlen($d) !== 6) {
                        $msg = 'Неверный код';
                    }
                    break;
                }
            } else {
                $msg = 'Ошибка неверные данные';
                break;
            }
        }
        if ($of) {
            $arr = array();
            $arr['result'] = $data;
     // ---------------email------------------       
//            if (isset($data['to_email'])) {
//                if ($data['to_email'] =='minsk') {
//                    $uri = '/contacts?minsk';
//                }
//                else {
//                    $uri = '/contacts?moscow';
//                }
//            }
     // ---------------email------------------              
            $arr['ip'] = $_SERVER['REMOTE_ADDR'];
            $arr['date'] = date('U');
            if ($_SESSION['fcode'] == $data['txtpic']) {
                if (ORM::factory('Messages')->add_msg($arr)) {
                    $msg = 'Сообщение успешно отправлено';
                } else {
                    $msg = 'Ошибка отправки сообщения';
                }
            } else {
                $msg = 'Неверный код';
            }
        }
        return $msg;
    }

    public static function check($data) {
        $dop = '';
        echo strlen($data['name']);
        if (strlen($data['name']) <= 3) {
            $dop.='Некорректно введено имя<br/>';
        }
        if (is_numeric($data['val']) && ($data['val'] > 5) && ($data['val'] < 1)) {
            $dop.='Некорректная оценка<br/>';
        }
        if (strlen($data['email']) <= 5 || !preg_match('|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is', $data['email'])) {
            $dop.='Некорректный email<br/';
        }
        if (strlen($data['text']) <= 40) {
            $dop.='Сообщение должны быть более содержательным<br/>';
        }
        if (strlen($data['txtpic']) !== 6) {
            $dop.='Неверно введен код с картинки';
        }

        return $dop;
    }

//    public static function gd() {
//        $ref = urlencode($_SERVER['HTTP_REFERER']);
//        if (empty($ref)) {
//            $ref = "прямая ссылка";
//        }
//        $data['from'] = $ref;
//        $data['ip'] = $_SERVER['REMOTE_ADDR'];
//        $data['to'] = $_SERVER['REQUEST_URI'];
//        if ($data['to'] == '/') {
//            $data['to'] = 'Главная';
//        }
//        $data['date'] = Date('U');
//        $data['browser'] = $_SERVER['HTTP_USER_AGENT'];
//
//        $add = ORM::factory('Stats')->insert_user_info($data);
//        $addu = ORM::factory('Statsu')->insert_user_info($data);
//    }

    public static function captcha() {
        $letters = 'ABCDEFGKIJKLMNOPQRSTUVWXYZ';
        $caplen = 6;
        $width = 120;
        $height = 20;
        $font = DOCROOT . '/content/font.ttf';
        $fontsize = 14;
        $im = imagecreatetruecolor($width, $height);
        imagesavealpha($im, true);
        $bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $bg);
        $captcha = '';
        for ($i = 0; $i < $caplen; $i++) {
            $captcha .= $letters[rand(0, strlen($letters) - 1)];
            $x = ($width - 20) / $caplen * $i + 10;
            $x = rand($x, $x + 4);
            $y = $height - ( ($height - $fontsize) / 2 );
            $curcolor = imagecolorallocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
            $angle = rand(-25, 25);
            imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]);
        }
        imagepng($im, 'file.png');
        $data['cap'] = $captcha;
        $data['image'] = $im;
        return $data;
    }

}
