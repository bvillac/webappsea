<?php

namespace app\components;

use Yii;

class CConnection extends \yii\db\Connection
{
    public $dbname;
    public $dbserver;
    public $class;
}
