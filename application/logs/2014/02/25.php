<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-02-25 17:58:39 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: comtacts ~ APPPATH/views/client/contact.php [ 2 ] in /home/intellectit/Документы/проекты/mobileninvest.local/application/views/client/contact.php:2
2014-02-25 17:58:39 --- DEBUG: #0 /home/intellectit/Документы/проекты/mobileninvest.local/application/views/client/contact.php(2): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/intellect...', 2, Array)
#1 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/View.php(61): include('/home/intellect...')
#2 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/intellect...', Array)
#3 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /home/intellectit/Документы/проекты/mobileninvest.local/application/views/client/template.php(79): Kohana_View->__toString()
#5 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/View.php(61): include('/home/intellect...')
#6 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/intellect...', Array)
#7 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Client))
#11 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /home/intellectit/Документы/проекты/mobileninvest.local/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /home/intellectit/Документы/проекты/mobileninvest.local/index.php(118): Kohana_Request->execute()
#14 {main} in /home/intellectit/Документы/проекты/mobileninvest.local/application/views/client/contact.php:2