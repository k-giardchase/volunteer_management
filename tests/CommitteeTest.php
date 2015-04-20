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
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $result = $test_committee->getCommitteeName();

            //Assert
            $this->assertEquals('Art', $result);
        }

        function test_setCommitteeName()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $test_committee->setCommitteeName('Theory & Practice');
            $result = $test_committee->getCommitteeName();

            //Assert
            $this->assertEquals('Theory & Practice', $result);
        }

        function test_getDepartment()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $result = $test_committee->getDepartment();

            //Assert
            $this->assertEquals('Event Management', $result);
        }

        function test_setDepartment()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $test_committee->setDepartment('Prevention');
            $result = $test_committee->getDepartment();

            //Assert
            $this->assertEquals('Prevention', $result);
        }

        function test_getSupervisor()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $result = $test_committee->getSupervisor();

            //Assert
            $this->assertEquals('Maggie Smith', $result);
        }

        function test_setSupervisor()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $test_committee->setSupervisor('Jane Smith');
            $result = $test_committee->getSupervisor();

            //Assert
            $this->assertEquals('Jane Smith', $result);
        }

        function test_save()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $supervisor = 'Maggie Smith';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $supervisor, $id);

            //Act
            $test_committee->save();
            Committee::getAll();

            //Assert
            $this->assertEquals([$test_committee], $result);
        }
    }
?>
