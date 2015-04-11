<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=day_test');

    require_once __DIR__.'/../src/Activity.php';

    class ActivityTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Activity::deleteAll();
        }

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

        function test_setActivityName()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);

            //Act
            $test_activity->setActivityName('Running');
            $result = $test_activity->getActivityName();

            //Assert
            $this->assertEquals('Running', $result);
        }

        function test_getId()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);

            //Act
            $result = $test_activity->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);

            //Act
            $test_activity->setId(2);
            $result = $test_activity->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            //Act
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity], $result);
        }

        function test_getAll()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            $activity_name2 = 'Running';
            $id2 = 2;
            $test_activity2 = new Activity($activity_name, $id);
            $test_activity2->save();

            //Act
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([$test_activity, $test_activity2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            $activity_name2 = 'Running';
            $id2 = 2;
            $test_activity2 = new Activity($activity_name, $id);
            $test_activity2->save();

            //Act
            Activity::deleteAll();
            $result = Activity::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            $activity_name2 = 'Running';
            $id2 = 2;
            $test_activity2 = new Activity($activity_name, $id);
            $test_activity2->save();

            //Act
            $result = Activity::find($test_activity2->getId());

            //Assert
            $this->assertEquals($test_activity2, $result);
        }

        function test_update()
        {
            //Arrange
            $activity_name = 'Sleeping';
            $id = 1;
            $test_activity = new Activity($activity_name, $id);
            $test_activity->save();

            $new_activity_name = 'Running';

            //Act
            $test_activity->update($new_activity_name);

            //Assert
            $this->assertEquals('Running', $test_activity->getActivityName());
        }
    }

?>
