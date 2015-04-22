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

        function test_getLastName()
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
            $result = $test_supervisor->getLastName();

            //Assert
            $this->assertEquals('Smith', $result);
        }

        function test_setLastName()
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
            $test_supervisor->setLastName('Daniels');
            $result = $test_supervisor->getLastName();

            //Assert
            $this->assertEquals('Daniels', $result);
        }

        function test_getPositionTitle()
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
            $result = $test_supervisor->getPositionTitle();

            //Assert
            $this->assertEquals('Director of Development', $result);
        }

        function test_setPositionTitle()
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
            $test_supervisor->setPositionTitle('Assistant Director of Development');
            $result = $test_supervisor->getPositionTitle();

            //Assert
            $this->assertEquals('Assistant Director of Development', $result);
        }

        function test_getEmail()
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
            $result = $test_supervisor->getEmail();

            //Assert
            $this->assertEquals('Micah@nonprofit.org', $result);
        }

        function test_setEmail()
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
            $test_supervisor->setEmail('Micah@nonprofit.org');
            $result = $test_supervisor->getEmail();

            //Assert
            $this->assertEquals('Micah@nonprofit.org', $result);
        }

        function test_getPhone()
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
            $result = $test_supervisor->getPhone();

            //Assert
            $this->assertEquals('800-600-5000', $result);
        }

        function test_setPhone()
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
            $test_supervisor->setPhone('111-111-1111');
            $result = $test_supervisor->getPhone();

            //Assert
            $this->assertEquals('111-111-1111', $result);
        }

        function test_getId()
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
            $result = $test_supervisor->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
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
            $test_supervisor->setId(2);
            $result = $test_supervisor->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
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
            $test_supervisor->save();
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([$test_supervisor], $result);
        }

        function test_getAll()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $phone = '800-600-5000';
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $phone, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $phone2 = '786-600-5234';
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $phone2, $id2);
            $test_supervisor2->save();

            //Act
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([$test_supervisor, $test_supervisor2], $result);
        }

        function test_getAll()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $phone = '800-600-5000';
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $phone, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $phone2 = '786-600-5234';
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $phone2, $id2);
            $test_supervisor2->save();

            //Act
            Supervisor::deleteAll();
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }

?>
