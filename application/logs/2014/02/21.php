<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-02-21 21:37:22 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:37:22 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_MySQL->list_columns('sub_categories')
#2 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#3 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#4 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#5 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#6 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1689): Kohana_ORM::factory('Subcategories')
#7 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(629): Kohana_ORM->_related('sub_categories')
#8 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('sub_categories')
#9 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Model/Products.php(124): Kohana_ORM->__get('sub_categories')
#10 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Controller/Client.php(23): Model_Products->get_tree(true)
#11 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller.php(69): Controller_Client->before()
#12 [internal function]: Kohana_Controller->execute()
#13 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Client))
#14 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#15 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#16 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#17 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:39:51 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:39:51 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_MySQL->list_columns('sub_categories')
#2 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#3 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#4 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#5 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#6 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1689): Kohana_ORM::factory('Subcategories')
#7 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(629): Kohana_ORM->_related('sub_categories')
#8 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('sub_categories')
#9 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Model/Products.php(124): Kohana_ORM->__get('sub_categories')
#10 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Controller/Client.php(23): Model_Products->get_tree(true)
#11 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller.php(69): Controller_Client->before()
#12 [internal function]: Kohana_Controller->execute()
#13 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Client))
#14 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#15 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#16 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#17 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:40:47 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:40:47 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_MySQL->list_columns('sub_categories')
#2 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#3 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#4 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#5 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#6 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1689): Kohana_ORM::factory('Subcategories')
#7 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(629): Kohana_ORM->_related('sub_categories')
#8 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('sub_categories')
#9 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Model/Products.php(124): Kohana_ORM->__get('sub_categories')
#10 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Controller/Client.php(23): Model_Products->get_tree(true)
#11 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller.php(69): Controller_Client->before()
#12 [internal function]: Kohana_Controller->execute()
#13 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Client))
#14 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#15 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#16 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#17 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:41:20 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-21 21:41:20 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_MySQL->list_columns('sub_categories')
#2 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#3 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#4 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#5 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#6 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(1689): Kohana_ORM::factory('Subcategories')
#7 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(629): Kohana_ORM->_related('sub_categories')
#8 /home/intellectit/Документы/проекты/mobileninvest.local/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('sub_categories')
#9 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Model/Products.php(124): Kohana_ORM->__get('sub_categories')
#10 /home/intellectit/Документы/проекты/mobileninvest.local/application/classes/Controller/Client.php(23): Model_Products->get_tree(true)
#11 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller.php(69): Controller_Client->before()
#12 [internal function]: Kohana_Controller->execute()
#13 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Client))
#14 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#15 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#16 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#17 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359