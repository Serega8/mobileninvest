<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {

    public $template = 'admin/template';

    public function before() {

        parent::before();
        $action = $this->request->action();
        $this_action = array();
        $actions = array();
        $icons = array();
        $param = $this->request->param();
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $level4 = isset($param['admin_level4']) ? $param['admin_level4'] : NULL;
        $level5 = isset($param['admin_level5']) ? $param['admin_level5'] : NULL;

        $model_categories = ORM::factory('Categories');
        $model_products = ORM::factory('Products');
        $model_sub_categories = ORM::factory('Subcategories');


        if ($level2) {
            switch ($action) {
                case 'catalog':
                    $dop = '';
                    $level2_rus = ORM::factory('Categories')->get_rus($level2);
                    if ($level2 == 'new_category') {
                        $dop = 'Добавление категории';
                    }
                    $level2_rus = $level2_rus . $dop;
                    $this->template->level2_rus = $level2_rus;
                    $this->template->level2 = $level2;

                    if ($level3) {
                        $dop = '';
                        switch ($level3) {
                            case 'new_product':
                                $dop = ' (добавление нового товара)';
                                break;
                            case 'settings':
                                $dop = ' (редактирование категории)';
                                break;
                            case 'new_sub_category':
                                $dop = ' (добавление новой подкатегории)';
                                break;

                            default:
                                $level3_rus = ORM::factory('Subcategories')->get_rus($level3);
                                $this->template->level3_rus = $level3_rus . $dop;
                                break;
                        }
                        $this->template->level2_rus = $level2_rus . $dop;
                        $this->template->level3 = $level3;
                    }
                    if ($level4) {
                        $dop = '';
                        switch ($level4) {
                            case 'new_product':
                                $dop = ' (добавление нового товара)';
                                break;
                            case 'sub_category_edit':
                                $dop = ' (редактирование подкатегории)';
                                break;
                            default:
                                $level4_rus = ORM::factory('Products')->get_rus($level4);
                                $this->template->level4 = $level4;
                                $this->template->level4_rus = $level4_rus;
                                break;
                        }
                        $this->template->level3_rus = $level3_rus . $dop;
                    }
                    if ($level5) {
                        $dop = '';
                        switch ($level5) {
                            case 'add_review':
                                $dop = ' (добавление отзыва)';
                                break;
                        }
                        $this->template->level4_rus = $level4_rus . $dop;
                    }
                    break;
                case 'brands':
                    break;
                case 'articles':
                    break;

                default:
                    break;
            }
        }


        if ($level3) {
            
        }


        $actions = array('index',
            'catalog',
            'reviews',
            'brands',
            'slideshow',
            'characteristics', 'poll',
            'feedback', 'messages',
            'contacts', 'articles',
            'logout', 'login', 'search',
            'currency', 'stats', 'to_small');
        $icons = array('icon-desktop',
            'icon-list',
            'icon-bell-alt',
            'icon-eye-open',
            'icon-play-circle',
            'icon-cog',
            'icon-align-right',
            'icon-asterisk',
            'icon-comment',
            'icon-envelope',
            'icon-briefcase',
            'icon-reorder',
            'icon1',
            'icon2',
            'icon-search',
            'currency', 'stats', 'to_small');
        $actions_rus = array('Главная',
            'Каталог', 'Отзывы',
            'Производители',
            'Слайдшоу',
            'Редактор характеристик',
            'Голосование',
            'Редактор обратной связи',
            'Сообщения',
            'Контакты',
            'Статьи',
            'Вход',
            'Выход',
            'Поиск',
            'Валюта', 'Статистика посещений сайта', 'to_small');
        if (!in_array($action, $actions)) {
            if (!$this->request->post() && empty($_FILES)) {
                echo 'Bad request';
                die;
            }
        } else {
            $position = array_search($action, $actions);
            $action_rus = $actions_rus[$position];
            $icon = $icons[$position];
            $this_action['link'] = $action;
            $this_action['rus'] = $action_rus;
            $this_action['icon'] = $icon;
        }
        $this->template->action = $this_action;
        $count_msg = ORM::factory('Msgid')->where('status', '=', '0')->count_all();
        $rev_count = ORM::factory('Reviews')->where('status', '=', '1')->count_all();
        $this->template->msg_count = $count_msg;
        $this->template->rev_count = $rev_count;
        $styles = array(
            'admin_content/css/font/font-awesome.css',
            'admin_content/css/style_dark.css',
            'admin_content/css/component-modal.css'
        );
        $scripts = array(
            'admin_content/js/jquery.min.js',
            'admin_content/js/excanvas.js', //stats
            'admin_content/js/jquery.flot.min.js', //stats
            'admin_content/js/jquery.flot.pie.min.js', //stats
            'admin_content/js/jquery.flot.stack.js', //stats
            'admin_content/js/jquery.flot.resize.min.js', //stats
            'admin_content/js/nicEdit.js', //articles
            'admin_content/js/accounting.js',
            'admin_content/js/modernizr.custom.js',
            'admin_content/js/classie.js',
            'admin_content/js/article-edit.js',
            'admin_content/js/reviews.js',
            'admin_content/js/slideshow-edit.js',
            'admin_content/js/modalEffects.js',
            'admin_content/js/product_edit.js',
            'admin_content/js/messages.js',
            'admin_content/js/poll.js',
            'admin_content/js/currency.js',
            'admin_content/js/seo.js',
            'admin_content/js/details.js',
            'admin_content/js/brands.js',
            'admin_content/js/feedback_edit.js',
            'admin_content/js/formdata.js'
        );
        $this->template->styles = $styles;
        $this->template->scripts = $scripts;

        $auth = Auth::instance();
        $login = $auth->logged_in();
        $this->template->auth = $login;
    }

    public function action_stats() {
        $action = $this->request->action();
        $view = View::factory('admin/stats');
        $res = ORM::factory('Stats')->get_stats();
        $view->stats = $res['result'];
        $view->pages_count = ceil($res['all'] / 10);
        $pagination = $res['pagination'];

        $view->br = ORM::factory('Stats')->stats();



        $pagination->action = $action;
        $view->pagination = $pagination;

        $this->template->content = $view;
    }

    public function action_login() {

        $auth = Auth::instance();
        if ($this->request->post()) {
            if (isset($_POST['submit'])) {
                $data = Validation::factory($_POST)
                        ->rules('login', array(
                            array('not_empty'),
                            array('email'),
                            array('max_length', array(':value', 32))))
                        ->rules('password', array(
                    array('not_empty'),
                    array('min_length', array(':value', 8)),
                    array('max_length', array(':value', 16))));
                if ($data->check()) {
                    $data = Arr::extract($_POST, array('login', 'password'));
                    if ($auth->login($data['login'], $data['password'])) {
                        $this->redirect('/admin/index');
                    } else {
                        $this->template->error = 'Не верный логин или пароль';
                    }
                } else {
                    $this->template->error = 'Не верный логин или пароль';
                }
            }
        }
        if ($auth->logged_in()) {
            $this->redirect('/admin/index');
        }
    }

    public function action_index() {

        $view = View::factory('admin/index');
        $view->categories_am = ORM::factory('Categories')->categories_count();
        $seo_box = View::factory('admin/seo/seo_box');
        $modal = View::factory('admin/modal');
        $kdst = ORM::factory('Brands')->seo('/');
        $seo_box->d_type = '/';
        $seo_box->seo = $kdst;
        $view->modal = $modal;
        $view->seo_box = $seo_box;
        $view->subcategories_am = ORM::factory('Subcategories')->categories_count();
        $view->products_am = ORM::factory('Products')->categories_count();
        $this->template->content = $view;
    }

    public function action_currency() {
        $modal = View::factory('admin/modal');
        $view = View::factory('admin/currency');
        $view->modal = $modal;
        $view->curs = ORM::factory('Currency')->get_currency();
        $this->template->content = $view;
    }

    public function action_slideshow() {
        $modal = View::factory('admin/modal');
        $view = View::factory('admin/slideshow');
        $view->modal = $modal;
        $view->images = ORM::factory('Slideshow')->all_slides();
        $this->template->content = $view;
    }

    public function action_characteristics() {
        $view = View::factory('admin/characteristics');
        $modal = View::factory('admin/modal');
        $model_categories = ORM::factory('Categories');
        $all_categories = $model_categories->list_categories();
        $view->categories = $all_categories;
        $view->modal = $modal;
        $view->details = ORM::factory('Details')->get_details();
        $this->template->content = $view;
    }

    public function action_poll() {
        $action = $this->request->action();
        $param = $this->request->param();
        $modal = View::factory('admin/modal');
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $level4 = isset($param['admin_level4']) ? $param['admin_level4'] : NULL;
        $level5 = isset($param['admin_level5']) ? $param['admin_level5'] : NULL;


        $val = 'list_poll';
        if ($level2 !== null) {
            if (is_numeric($level2)) {
                $val = 'edit_poll';
            }
            if ($level2 == 'add') {
                $val = 'add';
            }
        }
        $model = ORM::factory('Reviews');
        switch ($val) {
            case 'list_poll':
                $view = View::factory('admin/poll');
                $view->all = ORM::factory('Votes')->all_polls();
                $all_items = ORM::factory('Voteitem')->all_items();

                $votes = ORM::factory('Votesusers')->all();
                $all = $this->poll_result($votes, $all_items);
                $view->all_items = $all;
                $this->template->content = $view;
                break;
            case 'edit_poll':
                $view = View::factory('admin/edit_poll');
                $view->modal = $modal;
                $view->poll = ORM::factory('Votes')->poll_by_id($level2);
                $view->items = ORM::factory('Voteitem')->items_by_id($level2);
                $this->template->content = $view;
                break;
            case 'add':
                $view = View::factory('admin/add_poll');
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            default:
                echo "error";
                die;
                break;
        }
    }

    public static function poll_result($votes, $items) {
        
        $new_items = array(); 
        foreach ($items as $item) {
            foreach ($votes as $vote) {
                foreach ($vote as $k => $v) {
                    if ($k == $item['id']) {
                        $item['val'] = $v*100;
                        break;
                    }
                    else {
                        $item['val'] =0;
                    }
                }
            }
            $new_items[] = $item;
        }
        return $new_items;
    }

    public function action_reviews() {
        $action = $this->request->action();
        $param = $this->request->param();
        $modal = View::factory('admin/modal');
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $level4 = isset($param['admin_level4']) ? $param['admin_level4'] : NULL;
        $level5 = isset($param['admin_level5']) ? $param['admin_level5'] : NULL;
        $val = 'list_review';
        if ($level2 !== null) {
            if (is_numeric($level2)) {
                $val = 'edit_review';
            }
        }
        $model = ORM::factory('Reviews');
        switch ($val) {
            case 'list_review':
                $view = View::factory('admin/reviews');
                $view->products = $model->products_with_reviews();
                $view->reviews = $model->get_all_reviews();
                $this->template->content = $view;
                break;
            case 'edit_review':
                $view = View::factory('admin/rev_edit');
                $view->modal = $modal;
                $view->review = $model->get_review_by_id($level2);
                $this->template->content = $view;
                break;
            default:
                echo "error";
                die;
                break;
        }
    }

    public function action_feedback() {
        $view = View::factory('admin/feedback');
        $modal = View::factory('admin/modal');
        $view->modal = $modal;
        $seo_box = View::factory('admin/seo/seo_box');
        $modal = View::factory('admin/modal');
        $kdst = ORM::factory('Brands')->seo('feedback');
        $seo_box->d_type = 'feedback';
        $seo_box->seo = $kdst;
        $view->seo_box = $seo_box;
        $model = ORM::factory('Feedback');
        $exist = $model->get_all_tags(false);
        $view->exist = $exist;
        $this->template->content = $view;
    }

    public function action_brands() {
        $action = $this->request->action();
        $param = $this->request->param();
        $modal = View::factory('admin/modal');
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $val = 'list_brands';
        if ($level2 !== null) {
            if (is_numeric($level2)) {
                $val = 'brand_edit';
            } else if ($level2 == 'new_brand') {
                $val = 'new_brand'; //Добавление производителя
            } else {
                die;
            }
        }
        switch ($val) {
            case 'list_brands':
                $view = View::factory('admin/brands');
                $view->brands = ORM::factory('Brands')->list_brands();
                $seo_box = View::factory('admin/seo/seo_box');
                $kdst = ORM::factory('Brands')->seo($action);
                $seo_box->seo = $kdst;
                $view->seo_box = $seo_box;
                $view->modal = $modal;
                $seo_box->d_type = 'brands';
                $this->template->content = $view;
                break;
            case 'brand_edit':
                $view = View::factory('admin/brand_edit');
                $view->modal = $modal;
                $view->brand = ORM::factory('Brands')->get_brand_by_id($level2);
                $this->template->content = $view;
                break;
            case 'new_brand':
                $view = View::factory('admin/new_brand');
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            default:
                die;
        }
    }

    public function action_messages() {
        $action = $this->request->action();
        $param = $this->request->param();
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        if ($level2) {
            if (is_numeric($level2)) {
                $view = View::factory('admin/msg');
                $view->names = ORM::factory('Feedback')->get_all_tags(true);
                $view->message = ORM::factory('Msgid')->get_msg($level2);
                $view->ipaddr = ORM::factory('Msgid')->ip_addr($level2);
                $this->template->content = $view;
            }
        } else {
            $view = View::factory('admin/messages');
            $view->names = ORM::factory('Feedback')->get_all_tags(true);
            $view->messages = ORM::factory('Messages')->get_all_messages();
            $this->template->content = $view;
        }
    }

    public function action_contacts() {
        $view = View::factory('admin/contacts');
        $action = $this->request->action();
        $modal = View::factory('admin/modal');
        $seo_box = View::factory('admin/seo/seo_box');
        $kdst = ORM::factory('Brands')->seo($action);
        $seo_box->seo = $kdst;
        $view->seo_box = $seo_box;
        $view->modal = $modal;
        $seo_box->d_type = 'contacts';
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('mts', 'velcom', 'dialog', 'gorod', 'life', 'other', 'name', 'adr', 'img_url'));
            if (ORM::factory('Contacts')->update_info($data)) {
                $view->info = 'Данные успешно обновлены';
            } else {
                $view->info = 'Ошибка обновления данныех';
            }
        }

        $view->c = ORM::factory('Contacts')->get_contacts();
        $this->template->content = $view;
    }

    public function action_catalog() {
        $action = $this->request->action();
        $param = $this->request->param();
        $modal = View::factory('admin/modal');
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $level4 = isset($param['admin_level4']) ? $param['admin_level4'] : NULL;
        $level5 = isset($param['admin_level5']) ? $param['admin_level5'] : NULL;
        $val = 'list_categories'; //Список категорий
        if ($level2 !== null) {
            $val = 'list_sub_categories'; //Список подкатегорий
            if ($level2 == 'new_category') {
                $val = 'new_category'; //Добавление категории
            }
        }
        if ($level3 !== null) {
            $val = 'list_products'; //Список товаров
            if ($level3 == 'settings') {
                $val = 'category_edit'; //Редактирование категорий
            }
            if ($level3 == 'new_sub_category') {
                $val = 'new_sub_category'; //Добавление подкатегории
            }
            if ($level3 == 'new_product') {
                $val = 'new_product';
            }
        }
        if ($level4 !== null) {
            $val = 'product_info'; //Информация о товаре
            if ($level4 == 'sub_category_edit') {
                $val = 'sub_category_edit'; //Добавление подкатегории
            }
            if ($level4 == 'new_product') {
                $val = 'new_product'; //Добавление подкатегории
            }
            if ($level4 == 'add_review') {
                $val = 'add_review';
                $sub = false;
            }
        }
        if ($level5 !== null) {
            if ($level5 == 'add_review') {
                $val = 'add_review';
            }
            $sub = true;
        }
        switch ($val) {
            /*
             * Просмотр категорий
             */
            case 'list_categories':
                $model_categories = ORM::factory('Categories');
                $all_categories = $model_categories->list_categories();
                $view = View::factory('admin/categories');
                $all = ORM::factory('Products')->get_tree();
                $seo_box = View::factory('admin/seo/seo_box');
                $seo_box->seo = ORM::factory('Categories')->seo($action);
                $view->modal = $modal;
                $seo_box->d_type = 'categories';
                $view->seo_box = $seo_box;
                $view->menu = $all['main'];
                $view->sub_menu = $all['sub'];
                $view->product = $all['product'];
                $view->categories = $all_categories;
                $this->template->content = $view;
                break;
            /* ------------------------------------------------------------------
             * Редактирование категории
             */
            case 'category_edit':
                $model_categories = ORM::factory('Categories');
                $category = $model_categories->get_сategory_info($level2);
                $view = View::factory('admin/category_info');
                $view->category_info = $category;
                $view->level2 = $level2;
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            /* ------------------------------------------------------------------
             * Добавление категории
             */
            case 'new_category':
                $view = View::factory('admin/new_category');
                $view->datatype = 'new_category';
                $view->modal = $modal;
                $this->template->content = $view;
                break;

            /* ------------------------------------------------------------------
             * Просмотр подкатегорий
             */
            case 'list_sub_categories':
                $model_sub_categories = ORM::factory('Subcategories');
                $all_sub_categories = $model_sub_categories->list_sub_categories($level2);
                $all_products = ORM::factory('Products')->list_category_products($level2);
                $view = View::factory('admin/sub_categories');
                $view->level2 = $level2;
                $view->products_category = $all_products;
                $view->sub_categories = $all_sub_categories;
                $this->template->content = $view;
                break;
            /* ------------------------------------------------------------------
             * Редактрирование подкатегорий
             */
            case 'sub_category_edit':
                $model_categories = ORM::factory('Subcategories');
                $category = $model_categories->get_сategory_info($level2, $level3);
                $view = View::factory('admin/sub_category_info');

                $view->category_info = $category;
                $view->category_id = $model_categories->get_id($level2);
                $view->level2 = $level2;
                $view->level3 = $level3;
                $view->modal = $modal;
                $this->template->content = $view;


                break;
            case 'new_sub_category':
                $model_categories = ORM::factory('Subcategories');
                $view = View::factory('admin/new_sub_category');
                $view->level2 = $level2;
                $view->category_id = $model_categories->get_id($level2);
                $view->modal = $modal;
                $this->template->content = $view;
                break;



            /* ------------------------------------------------------------------
             * Просмотр товаров
             */
            case 'list_products':
                $model_products = ORM::factory('Products');
                $model_sub_categories = ORM::factory('Subcategories');

                $count = $model_sub_categories->detect_sp($level2, $level3);
                if ($count >= 1) {
                    $all_products = $model_products->list_products($level2, $level3);
                    $view = View::factory('admin/products');
                    $view->level2 = $level2;
                    $view->level3 = $level3;
                    $view->products = $all_products;
                    $this->template->content = $view;
                } else {
//                    if () {
                    $view = View::factory('admin/product_info');
                    $product = ORM::factory('Products')->product_main_info($level2, $level3);
                    $id_product = $product['id'];
                    $details = ORM::factory('Details')->get_details($level2, $id_product);
                    $details_values = ORM::factory('Subdetailsval')->get_values($id_product);
                    $view->values = $details_values;
                    $images = ORM::factory('Productimages')->product_images($id_product);
                    $view->product = $product;

                    $currency = ORM::factory('Currency')->get_currency();
                    $view->currency = $currency;
                    $view->converted = $this->convert_currency($product['currency'], $currency, $product['cost']);
                    $view->level2 = $level2;
                    $view->level3 = $level3;
                    $view->brands = ORM::factory('Brands')->list_brands();
                    $view->details = $details;
                    $view->images = $images;
                    $view->modal = $modal;
                    $this->template->content = $view;
//                    }
//                    else {
//                        echo 'Не существует такой страницы'; die;
//                    }
                }
                break;
            /* ------------------------------------------------------------------
             * Просмотр и редактирование информации о товаре
             */
            case 'product_info':
                $view = View::factory('admin/product_info');
                $product = ORM::factory('Products')->product_main_info($level2, $level3, $level4);
                $id_product = $product['id'];
                $details = ORM::factory('Details')->get_details($level2, $id_product);
                $details_values = ORM::factory('Subdetailsval')->get_values($id_product);
                $view->values = $details_values;
                $currency = ORM::factory('Currency')->get_currency();
                $view->currency = $currency;
                $view->converted = $this->convert_currency($product['currency'], $currency, $product['cost']);
                $images = ORM::factory('Productimages')->product_images($id_product);
                $view->product = $product;
                $view->brands = ORM::factory('Brands')->list_brands();
                $view->details = $details;
                $view->level2 = $level2;
                $view->level3 = $level3;
                $view->images = $images;
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            /*
             * Добавление нового товара
             */
            case 'new_product':
                $view = View::factory('admin/new_product');
                $this->template->content = $view;
                $view->level2 = $level2;
                $view->currency = ORM::factory('Currency')->get_currency();
                $details = ORM::factory('Details')->get_details($level2);
                $view->values = array();
                $view->details = $details;
                $view->brands = ORM::factory('Brands')->list_brands();
                $view->modal = $modal;
                $view->level3 = $level3;
                break;
            case 'add_review':
                $view = View::factory('/admin/add_review');
                if (!$sub) {
                    $view->product_id = ORM::Factory('Products')->get_id_by_translit($level3);
                } else {
                    $view->product_id = ORM::Factory('Products')->get_id_by_translit($level4);
                }
                $view->modal = $modal;
                $this->template->content = $view;
                break;
        }
    }

    public function action_search() {
        if ($this->request->post()) {
            $model_products = ORM::factory('Products');
            $query = trim(htmlspecialchars(strip_tags(strip_tags($_POST['q']))));
            $res = $model_products->search_products($query);
            $view = View::factory('admin/search/search_data');
            $view->products = $res;
            $this->template->content = $view;
        } else {
            die('Bad request');
        }
    }

    public function action_articles() {
        $modal = View::factory('admin/modal');
        $action = $this->request->action();
        $param = $this->request->param();
        $level2 = isset($param['admin_level2']) ? $param['admin_level2'] : NULL;
        $level3 = isset($param['admin_level3']) ? $param['admin_level3'] : NULL;
        $level4 = isset($param['admin_level4']) ? $param['admin_level4'] : NULL;
        $level5 = isset($param['admin_level5']) ? $param['admin_level5'] : NULL;
        $var = 'list_articles';
        if ($level2 !== NULL) {
            $var = 'article_info';
            if ($level2 == 'new_article') {
                $var = 'new_article';
            }
        }



        switch ($var) {
            case 'list_articles':
                $view = View::factory('admin/articles');
                $articles = ORM::factory('Articles')->all_articles();
                $view->articles = $articles;
                $view->modal = $modal;
                $seo_box = View::factory('admin/seo/seo_box');
                $modal = View::factory('admin/modal');
                $kdst = ORM::factory('Brands')->seo('articles');
                $seo_box->d_type = 'articles';
                $seo_box->seo = $kdst;
                $view->seo_box = $seo_box;
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            case 'article_info':
                $view = View::factory('admin/article_info');
                $article = ORM::factory('Articles')->article($level2);
                $view->article = $article;
                $view->images = ORM::factory('Articleimages')->get_images($article['id']);
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            case'new_article':
                $view = View::factory('admin/new_article');
                $view->modal = $modal;
                $this->template->content = $view;
                break;
            default:
                break;
        }
    }

    public function action_logout() {
        $auth = Auth::instance();
        $auth->logout();
        $this->redirect('/admin/');
    }

    /*
     * Рабочие функции
     */

    public function action_article_edit() {
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('id', 'name', 'descr', 'img_alt', 'category_name', 'img_title', 'type', 'k', 's', 'd', 't'));
            if (isset($_FILES['file'])) {
                $resize['w'] = 800;
                $resize['h'] = 800;
                $filename = $this->_save_image($_FILES['file'], '/content/images/article_images/', $resize);
                if ($filename) {
                    $data['filename'] = $filename;
                }
            }
            switch ($data['type']) {
                case 'red':
                    $c = false;
                    break;
                case 'new':
                    $c = true;
                    break;
                default:
                    die;
                    break;
            }
            if (ORM::factory('Articles')->update_info($data, $c)) {
                echo "Информация обновлена";
                die;
            } else {
                echo "Ошибка";
                die;
            }
            die;
        }
    }

    public function action_category_settings() { //Редактирование категорий и подкатегорий
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('category_name',
                        'k', 's', 'd', 't', 'parent_category',
                        'img_title', 'img_alt', 'type_apply',
                        'translit', 'id', 'descr', 'url'));

            if (!empty($_FILES)) {
                $resize['w'] = 200;
                $resize['h'] = 100;
                $filename = $this->_save_image($_FILES['file'], '/content/images/category_images/', $resize);
            }
            if (isset($filename)) {
                $data['file'] = $filename;
            }
            switch ($data['type_apply']) {
                case 'category_edit':
                    $mdl = 'Categories';
                    break;
                case 'new_category':
                    $mdl = 'Categories';
                    break;
                case 'sub_category_edit':
                    $mdl = 'Subcategories';
                    break;
                case 'new_sub_category':
                    $mdl = 'Subcategories';
                    break;
                case 'brand_edit':
                    $data['translit'] = $this->translit($data['category_name']);
                    $mdl = 'Brands';
//                    var_dump($data);die;
                    break;
                case 'brand_new':
                    $mdl = 'Brands';
//                    var_dump($data);die;
                    break;
                default :
                    die;
                    break;
            }

            if (ORM::factory($mdl)->update_info($data)) {
                echo "Информация успешно добавлена/обновлена";

                die;
            } else {
                echo "Ошибка обновления информации. Возможно, категория уже существует";
                die;
            }
        }
    }

    public static function filter1x($data) {
        $filter = array();
        foreach ($data as $k => $d) {
            $str = htmlspecialchars(strip_tags(trim($d)));
            $length = strlen($str);
            if ($length !== 0) {
                $filter[$k] = $str;
            } else {
                $filter[$k] = null;
            }
        }
        return $filter;
    }

    public static function to_arr_det($obj) {
        $result = array();
        foreach ($obj as $o) {
            $res['id'] = $o->id;
            $res['name'] = $o->name;
            $res['status'] = $o->status;
            $result[] = $res;
        }
        return $result;
    }

    public static function to_arr_img($obj) {
        $result = array();
        foreach ($obj as $o) {
            $res['id'] = $o->id;
            $res['img_alt'] = $o->img_alt;
            $res['img_title'] = $o->img_title;
            $res['status'] = $o->status;
            $result[] = $res;
        }
        return $result;
    }

    public static function to_arr_val($obj) {
        $result = array();
        foreach ($obj as $o) {
            $res['val'] = $o->val;
            $res['sid'] = $o->sid;
            $res['val_id'] = $o->val_id;
            $result[] = $res;
        }
        return $result;
    }

    public static function to_arr_details_group($obj) {
        $result = array();
        $obj = json_decode($obj);
        if (isset($obj)) {
            foreach ($obj as $o) {
                $res['id_group'] = $o->id_group;
                $res['cid'] = $o->cid;
                $res['name'] = strip_tags($o->name);
                $res['status'] = $o->status;
                $result[] = $res;
            }
        }
        return $result;
    }

    public static function to_arr_details_sub($obj) {
        $result = array();
        $obj = json_decode($obj);
        if (isset($obj)) {
            foreach ($obj as $o) {
                $res['gid'] = $o->gid;
                $res['id'] = $o->id;
                $res['name'] = strip_tags($o->name);
                $res['status'] = $o->status;
                $result[] = $res;
            }
        }
        return $result;
    }

    public function action_details_edit() {
        if ($this->request->post()) {
            $details_exist = $this->to_arr_details_sub($_POST['details_exist']);
            $group_exist = $this->to_arr_details_group($_POST['group_exist']);
            $group_new = $this->to_arr_details_group($_POST['group_new']);
            $details_new = $this->to_arr_details_sub($_POST['details_new']);
            if (ORM::factory('Details')->update_details($details_exist, $details_new, $group_exist, $group_new)) {
                echo "Изменения внесены";
            } else {
                echo 'Ошибка';
            }
        }
        die;
    }

    public function action_slideshow_edit() {
        if ($this->request->post()) {
            $images_data = json_decode($_POST['images_data']);
            $images_data = $this->to_arr_img($images_data);
            if (ORM::factory('Slideshow')->update_info($images_data)) {
                echo "Данные обновлены";
            }
        }
        if (!empty($_FILES)) {
            $resize['w'] = 1015;
            $resize['h'] = 390;
            $filename = $this->_save_image($_FILES['file'], '/content/images/slideshow/', $resize);
            if ($filename) {
                if (ORM::factory('Slideshow')->insert_image($filename)) {
                    die;
                }
            }
        }
        die;
    }

    public function action_show_product_data() {
        if (isset($_POST['main'])) {
            $data['product_id'] = $_POST['product_id'];
            $data['product_currency'] = $_POST['product_currency'];
            $data['product_cost'] = $_POST['product_cost'];
            $data['product_brand'] = $_POST['product_brand'];
            $data['product_name'] = $_POST['product_name'];
            $data['url'] = $_POST['url'];
            $data['k'] = $_POST['k'];
            $data['s'] = $_POST['s'];
            $data['t'] = $_POST['t'];
            $data['d'] = $_POST['d'];
            $images_data = json_decode($_POST['images_data']);
            $images_data = $this->to_arr_img($images_data);
            $values = $this->to_arr_val(json_decode($_POST['values']));
            $img_db = ORM::factory('Productimages')->update_info($images_data);
            $val = ORM::factory('Subdetailsval')->insert_data($values, $data['product_id']);
            $det = ORM::factory('Subdetails')->update_details($data);

            echo "Данные обновлены";
        }
        if (!empty($_FILES)) {
            $resize['w'] = 200;
            $resize['h'] = 200;
            $product_id = $_POST['product_id'];
            $filenames = $this->_save_2_img($_FILES['file'], $resize, $product_id, '/content/images/product_images/');

            if (!empty($filenames)) {
                if (ORM::factory('Productimages')->insert_image($filenames, $product_id)) {
                    die;
                }
            }
        }

        die;
    }

    public static function to_arr_tags($tags) {
        $result = array();
        foreach ($tags as $tag) {
            $res['id'] = $tag->id;
            $res['status'] = $tag->status;
            $res['name'] = $tag->name;
            $res['type'] = $tag->sel_type;
            $res['placeholder'] = $tag->placeholder;
            $res['type_tag'] = $tag->type_tag;
            $result[] = $res;
        }
        return $result;
    }

    public function action_feedback_edit() {
        if ($this->request->post()) {
            $exist_tags = $_POST['exist_tags'];
            $new_tags = $_POST['new_tags'];
            $exist_tags = json_decode($exist_tags);
            $exist_tags = $this->to_arr_tags($exist_tags);
            $new_tags = json_decode($new_tags);
            $new_tags = $this->to_arr_tags($new_tags);
            if (ORM::factory('Feedback')->update_info($new_tags, $exist_tags)) {
                echo "Данные обновлены";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    public function action_rev_edit() {
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('id', 'name', 'text', 'val'));
            if (ORM::factory('Reviews')->update_review($data)) {
                echo "Отзыв обновлен";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    public function action_rev_add() {
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('product_id', 'name', 'text', 'val', 'email'));
            if (ORM::factory('Reviews')->add_review($data)) {
                echo "Отзыв Добавлен";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    public function action_add_new_product() {
        if ($this->request->post()) {
            $product = Arr::extract($_POST, array('product_cost', 'url', 'k', 's', 't', 'd', 'product_name', 'product_currency', 'product_brand', 'level2', 'level3'));
            if (!empty($product)) {
                $values = $this->to_arr_val(json_decode($_POST['values']));
                if (ORM::factory('Products')->add_product($product, $values)) {
                    echo "Товар добавлен";
                } else {
                    echo "Ошибка обновления информации. Возможно, товар уже существует";
                }
            }
            if (!empty($_FILES)) {
                $resize['w'] = 200;
                $resize['h'] = 200;
                $filenames = $this->_save_2_img($_FILES['file'], $resize, Model::factory('Pk')->pk('products'), '/content/images/product_images/');
                if ($filenames) {
                    if (ORM::factory('Productimages')->insert_image($filenames)) {
                        
                    }
                }
            }

            die;
        }
        if (!empty($_FILES)) {
            $resize['w'] = 200;
            $resize['h'] = 200;
            $filenames = $this->_save_2_img($_FILES['file'], $resize, Model::factory('Pk')->pk('products'), '/content/images/product_images/');
            if ($filenames) {
                if (ORM::factory('Productimages')->insert_image($filenames)) {
                    
                }
            }
        }
        die;
    }

    public static function url_set($str) {
        $str = strtolower(htmlspecialchars(strip_tags(trim($str))));
        $lng = strlen($str);
        for ($i = 0; $i < $lng; $i++) {
            if ($str[$i] === ' ') {
                $str[$i] = '-';
            }
        }
        return $str;
    }

    public function to_arr_poll($obj) {
        $result = array();
        foreach ($obj as $o) {
            $res['id'] = $o->id;
            $res['status'] = $o->status;
            $res['text'] = $o->val;
            $result[] = $res;
        }
        return $result;
    }

    public function action_update_poll() {
        if ($this->request->post()) {
            $new = array();
            $exist = array();
            $q = strip_tags($_POST['q']);
            $id = $_POST['poll_id'];
            $type = $_POST['type'];
            $data['exists'] = json_decode($_POST['arr_exists']);
            $data['new'] = json_decode($_POST['arr_new']);
            $exist = $this->to_arr_poll($data['exists']);
            $new = $this->to_arr_poll($data['new']);
            if (ORM::factory('Voteitem')->update_info($id, $new, $exist, $q, $type)) {
                echo "Обновлено";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    public function to_arr_curr($obj) {
        $result = array();
        foreach ($obj as $o) {
            $res['id'] = $o->id;
            $res['status'] = $o->status;
            if (is_numeric($o->val)) {
                $res['val'] = floatval($o->val);
            } else {
                $res['val'] = 0;
            }
            $res['name'] = $o->name;
            $result[] = $res;
        }
        return $result;
    }

    public function action_update_currency() {
        if ($this->request->post()) {
            $new = array();
            $exist = array();
            $data['exists'] = json_decode($_POST['arr_exists']);
            $data['new'] = json_decode($_POST['arr_new']);
            $exist = $this->to_arr_curr($data['exists']);
            $new = $this->to_arr_curr($data['new']);


            if (ORM::factory('Currency')->update_info($exist, $new)) {
                echo "Обновлено";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    public function action_set_category_status() { //Смена статусов категорий, подкатегорий, товаров
        if ($this->request->post()) {
            $mdl = '';
            $data = Arr::extract($_POST, array('id', 'status', 'type'));
            switch ($data['type']) {
                case 'sub':
                    $mdl = 'Subcategories';
                    break;
                case 'main':
                    $mdl = 'Categories';
                    break;
                case 'article':
                    $mdl = 'Articles';
                    break;
                case 'product':
                    $mdl = 'Products';
                    break;
                default;
                    die;
                    break;
            }
            if (ORM::factory($mdl)->set_status($data['id'], $data['status'])) {
                echo "Статус обновлен";
                die;
            } else {
                echo "Ошибка обновления статуса";
                die;
            }
        }
    }

    public function action_set_msg_status() {
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('ids', 'type', 'typeOfPage'));
            $mdl = 'unnamed';
            switch ($data['typeOfPage']) {
                case 'msg':
                    $mdl = 'Msgid';
                    break;
                case 'brands':
                    $mdl = 'Brands';
                    break;
                case 'categories':
                    $mdl = 'Categories';
                    break;
                case 'sub_categories':
                    $mdl = 'Subcategories';
                    break;
                case 'products':
                    $mdl = 'Products';
                    break;
                case 'articles':
                    $mdl = 'Articles';
                    break;
                case 'reviews':
                    $mdl = 'Reviews';
                    break;
                case 'poll':
                    $mdl = 'Votes';
                    break;
                default:
                    echo "Ошибка.";
                    die;
                    break;
            }


            if (ORM::factory($mdl)->update_status($data)) {
                echo "Данные обновлены";
            } else {
                echo "Ошибка";
            }
        }
        die;
    }

    protected function _save_image($image, $dir, $resize) { //Загрузка картинок
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }


        $directory = DOCROOT . $dir;
        if ($file = Upload::save($image, NULL, $directory)) {

            $type = '.' . substr(strrchr($image['name'], '.'), 1);

            $now = Date('U');
            $filename = $this->translit($image['name']) . '-' . $type;
            $w = $resize['w'];
            $h = $resize['h'];
            Image::factory($file)
                    ->resize($w, $h, Image::AUTO)
                    ->save($directory . $filename);

            return $dir . $filename;
        }

        return FALSE;
    }

    protected function _save_2_img($image, $resize, $pid, $dir) { //Загрузка картинок
        if (
                !Upload::valid($image) OR
                !Upload::not_empty($image) OR
                !Upload::type($image, array('jpg', 'jpeg', 'png', 'gif'))) {
            return FALSE;
        }
        if ($this->create_dir($pid)) {
            $big_path = DOCROOT . $dir . $pid . '/';
            $small_path = DOCROOT . $dir . $pid . '/s/';
            if ($file = Upload::save($image, NULL, $big_path)) {
                $now = Date('U');

                $type = '.' . substr(strrchr($image['name'], '.'), 1);
                $filename = $this->translit($image['name']) . '-' . $now . $type;
                $w = $resize['w'];
                $h = $resize['h'];
                Image::factory($file)
                        ->save($big_path . $filename);
                Image::factory($file)
                        ->resize($w, $h, Image::AUTO)
                        ->save($small_path . $filename);
                unlink($file);
                $array['big'] = $dir . $pid . '/' . $filename;
                $array['small'] = $dir . $pid . '/s/' . $filename;
                return $array;
            }
        }
        return FALSE;
    }

    protected function create_dir($id) {

        $isdir = (is_dir(DOCROOT . "/content/images/product_images/" . $id . "/") && is_dir(DOCROOT . "/content/images/product_images/" . $id . "/s/"));
        if ($isdir) {
            return true;
        } else {
            if (mkdir(DOCROOT . "/content/images/product_images/" . $id)) {
                mkdir(DOCROOT . "/content/images/product_images/" . $id . "/s");
                return true;
            } else {
                return false;
            }
        }
    }

    public function action_to_small() {
        ini_set("max_execution_time", "160");
        $all = ORM::factory('Productimages')->where('status', '=', '0')->find_all();
        foreach ($all as $k => $a) {
            $id = $a->id;
            $pid = $a->product_id;
            $img_url = $a->img_url;

            if (glob(DOCROOT . $img_url)) {
                $type = substr(strrchr(DOCROOT . $img_url, '.'), 1);
                echo $type;
                if ($type !== 'jpg') {
                    rename(DOCROOT . $img_url, DOCROOT . $img_url . '.jpg');
                    $img_url = $img_url . '.jpg';
                    echo $id . ' --- Rename<br>';
                } else {
                    echo $id . " --- No<br>";
                }
                if ($this->create_dir($pid)) {


                    $small_path = DOCROOT . "/content/images/product_images/" . $pid . '/s/';
                    $time = date('U');
//                $img_url[0] = '';
                    $image = @imagecreatefromjpeg(DOCROOT . $img_url);

                    $new_width = 180;
                    $new_height = 127;
                    list($width, $height) = getimagesize(DOCROOT . $img_url);
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($image_p, $small_path . $id . $time . '-small.jpg', 80);

                    echo $small_path . $id . $time . '-small.jpg<br>';

//                imagejpeg($docroot_dir, $small_path . $id . $time . '-small.jpg');
//                Image::factory($docroot_dir)
//                        ->resize(100, 100, Image::AUTO)
//                        ->save($small_path . $id.$time.'-small.jpg');
                    $m = ORM::factory('Productimages')->where('id', '=', $id)->find();
                    $m->img_url = $img_url;

                    $m->img_url_small = "/content/images/product_images/" . $pid . '/s/' . $id . $time . '-small.jpg';
                    $m->save();
                } else {
                    break;
                }
            }
        }
        die;
    }

//    protected static function recursive_mkdir($path, $mode = 0777) {
//        if (is_dir($path)) {
//            return true;
//        }
//        $dirs = explode(DIRECTORY_SEPARATOR, $path);
//        $count = count($dirs);
//        $path = '.';
//        for ($i = 0; $i < $count; ++$i) {
//            $path .= DIRECTORY_SEPARATOR . $dirs[$i];
//            if (!is_dir($path) && !mkdir($path, $mode)) {
//                return false;
//            }
//        }
//        return true;
//    }

    public function action_seo_update() { //переделать;
        if ($this->request->post()) {
            $data = Arr::extract($_POST, array('d_type', 'id', 'k', 'd', 's', 't'));
            $mdl = null;
            if (!empty($data)) {
                switch ($data['d_type']) {
                    case 'categories':
                        $mdl = 'Categories';
                        break;
                    case 'sub_categories':
                        $mdl = 'Subcategories';
                        break;
                    case 'products':
                        $mdl = 'Products';
                        break;
                    case 'brands':
                        $mdl = 'Brands';
                        break;
                    case 'contacts':
                        $mdl = 'Contacts';
                        break;
                    case '/':
                        $mdl = 'Categories';
                        break;
                    case 'articles':
                        $mdl = 'Articles';
                        break;
                    case 'feedback':
                        $mdl = 'Feedback';
                        break;
                    default :
                        echo "error";
                        die;
                        break;
                }
                if ($mdl) {
                    ORM::factory($mdl)->update_seo($data);
                }
            }
        }
        die;
    }

    public static function convert_currency($pcid, $currs, $value) {
        $key = null;
        $result = array();
        foreach ($currs as $k => $curr) {
            if ($curr['id'] == $pcid)
                $key = $k;
        }
        if ($key !== null) {
            foreach ($currs as $curr) {
                $res['id'] = $curr['id'];
                $res['val'] = $value / $currs[$key]['val'] * $curr['val'];
                $res['name'] = $curr['name'];
                $result[] = $res;
            }
        }
        return $result;
    }

    public static function translit($string) {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        $str = strtr($string, $converter);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

}
