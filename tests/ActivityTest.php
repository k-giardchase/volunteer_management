<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=day_test');

    require_once __DIR__.'/../src/Activity.php';

    class ActivityTest extends PHPUnit_Framework_TestCase
    {
        function test_getActivityName()
        {
            
        }

    }

?>
