<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-02-22 13:51:42 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-22 13:51:42 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
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
2014-02-22 13:52:03 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'database_ib.sub_categories' doesn't exist [ SHOW FULL COLUMNS FROM `sub_categories` ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php:359
2014-02-22 13:52:03 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/modules/database/classes/Kohana/Database/MySQL.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
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
2014-02-22 14:49:49 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected end of file ~ APPPATH/views/client/template.php [ 298 ] in file:line
2014-02-22 14:49:49 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 18:14:07 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: controller ~ SYSPATH/classes/Kohana/Request.php [ 956 ] in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 18:14:07 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(956): Kohana_Core::error_handler(8, 'Undefined index...', '/home/intellect...', 956, Array)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#2 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 18:15:45 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: controller ~ SYSPATH/classes/Kohana/Request.php [ 956 ] in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 18:15:45 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(956): Kohana_Core::error_handler(8, 'Undefined index...', '/home/intellect...', 956, Array)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#2 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 18:16:38 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: controller ~ SYSPATH/classes/Kohana/Request.php [ 956 ] in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 18:16:38 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(956): Kohana_Core::error_handler(8, 'Undefined index...', '/home/intellect...', 956, Array)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#2 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php:956
2014-02-22 19:06:26 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:06:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:18 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:20 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:20 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:21 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:21 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:22 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:22 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:29 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:34 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:34 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:35 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:35 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-22 19:13:40 --- EMERGENCY: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/Controller/Client.php [ 130 ] in file:line
2014-02-22 19:13:40 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line