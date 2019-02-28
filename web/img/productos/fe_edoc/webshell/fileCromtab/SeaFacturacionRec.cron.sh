#!/bin/sh
php /webshell/envRecFact.php
php /webshell/envRecGuia.php
php /webshell/envRecRet.php
php /webshell/envRecNc.php
cd /webshell
php /webshell/enviarmailFact.php
php /webshell/enviarmailGuia.php
php /webshell/enviarmailRetencion.php
php /webshell/enviarmailNc.php
