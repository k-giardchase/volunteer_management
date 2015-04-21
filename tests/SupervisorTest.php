<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=volunteer_management_test');

    require_once __DIR__.'/../src/Volunteer.php';
    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/Committee.php';
    require_once __DIR__.'/../src/Supervisor.php';

    class SupervisorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Volunteer::deleteAll();
            Event::deleteAll();
            Committee::deleteAll();
        }

        function test_getFirstName()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $phone = '800-600-5000';
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $phone, $id);

            //Act
            $result = $test_supervisor->getFirstName();

            //Assert
            $this->assertEquals('Micah', $result);
        }

        function test_setFirstName()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $phone = '800-600-5000';
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $phone, $id);

            //Act
            $test_supervisor->setFirstName('Michael');
            $result = $test_supervisor->getFirstName();

            //Assert
            $this->assertEquals('Michael', $result);
        }
    }

?>
