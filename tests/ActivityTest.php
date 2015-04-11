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
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);

            //Act
            $result = $test_activity->getActivityName();

            //Assert
            $this->assertEquals('Sleeping', $result);
        }

    }

?>
