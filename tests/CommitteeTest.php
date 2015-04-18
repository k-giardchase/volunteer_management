<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=day_test');

    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/Volunteer.php';
    require_once __DIR__.'/../src/Committee.php';

    class ComitteeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
            Volunteer::deleteAll();
            // Committee::deleteAll();
        }

        function test_getCommitteeName()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $staff_member = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $staff_member, $id);

            //Act
            $result = $test_committee->getCommitteeName();

            //Assert
            $this->assertEquals('Art', $result);
        }
    }
?>
