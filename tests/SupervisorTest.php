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
            Supervisor::deleteAll();
        }

        function test_getFirstName()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $test_supervisor->setEmail('Micah@nonprofit.org');
            $result = $test_supervisor->getEmail();

            //Assert
            $this->assertEquals('Micah@nonprofit.org', $result);
        }

        function test_getUsername()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $result = $test_supervisor->getUsername();

            //Assert
            $this->assertEquals('Micah2', $result);
        }

        function test_setUsername()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $test_supervisor->setUsername('Micah5');
            $result = $test_supervisor->getUsername();

            //Assert
            $this->assertEquals('Micah5', $result);
        }

        function test_getPassword()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $result = $test_supervisor->getPassword();

            //Assert
            $this->assertEquals('helloworld', $result);
        }

        function test_setPassword()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $test_supervisor->setPassword('helloworld234');
            $result = $test_supervisor->getPassword();

            //Assert
            $this->assertEquals('helloworld234', $result);
        }

        function test_getPhone()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $test_supervisor->setPhone('111-111-1111');
            $result = $test_supervisor->getPhone();

            //Assert
            $this->assertEquals('111-111-1111', $result);
        }

        function test_getAdminStat()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $result = $test_supervisor->getAdminStat();

            //Assert
            $this->assertEquals(0, $result);
        }

        function test_setAdminStat()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

            //Act
            $test_supervisor->setAdminStat(1);
            $result = $test_supervisor->getAdminStat();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_getId()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);

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
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $username2 = 'morgan123';
            $password2 = 'hithere';
            $phone2 = '786-600-5234';
            $admin_stat2 = 1;
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $username2, $password2, $phone2, $admin_stat2,$id2);
            $test_supervisor2->save();

            //Act
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([$test_supervisor2, $test_supervisor], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $username2 = 'morgan123';
            $password2 = 'hithere';
            $phone2 = '786-600-5234';
            $admin_stat2 = 1;
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $username2, $password2, $phone2, $admin_stat2,$id2);
            $test_supervisor2->save();

            //Act
            Supervisor::deleteAll();
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $username2 = 'morgan123';
            $password2 = 'hithere';
            $phone2 = '786-600-5234';
            $admin_stat2 = 1;
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $username2, $password2, $phone2, $admin_stat2,$id2);
            $test_supervisor2->save();

            //Act
            $result = Supervisor::find($test_supervisor2->getId());

            //Assert
            $this->assertEquals($test_supervisor2, $result);
        }

        function test_update()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $new_first_name = 'Morgan';
            $new_last_name = 'Durant';
            $new_position_title = 'Director of Operations';
            $new_email = 'Morgan@nonprofit.org';
            $new_username = 'morgan123';
            $new_password = 'hithere';
            $new_phone = '786-600-5234';
            $new_admin_stat = 1;

            //Act
            $test_supervisor->update($new_first_name, $new_last_name, $new_position_title, $new_email, $new_username, $new_password, $new_phone, $new_admin_stat);

            //Assert
            $this->assertEquals(['Morgan', 'Durant', 'Director of Operations', 'Morgan@nonprofit.org', 'morgan123', 'hithere', '786-600-5234', 1], [$test_supervisor->getFirstName(), $test_supervisor->getLastName(), $test_supervisor->getPositionTitle(), $test_supervisor->getEmail(), $test_supervisor->getUsername(), $test_supervisor->getPassword(), $test_supervisor->getPhone(), $test_supervisor->getAdminStat()]);
        }

        function test_delete()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $first_name2 = 'Morgan';
            $last_name2 = 'Durant';
            $position_title2 = 'Director of Operations';
            $email2 = 'Morgan@nonprofit.org';
            $username2 = 'morgan123';
            $password2 = 'hithere';
            $phone2 = '786-600-5234';
            $admin_stat2 = 1;
            $id2 = 1;
            $test_supervisor2 = new Supervisor($first_name2, $last_name2, $position_title2, $email2, $username2, $password2, $phone2, $admin_stat2,$id2);
            $test_supervisor2->save();

            //Act
            $test_supervisor->delete();
            $result = Supervisor::getAll();

            //Assert
            $this->assertEquals([$test_supervisor2], $result);
        }

        function test_addCommittee()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);
            $test_committee->save();

            //Act
            $test_supervisor->addCommittee($test_committee);
            $result = $test_supervisor->getCommittees();

            //Assert
            $this->assertEquals([$test_committee], $result);
        }

        function test_getCommittees()
        {
            //Arrange
            $first_name = 'Micah';
            $last_name = 'Smith';
            $position_title = 'Director of Development';
            $email = 'Micah@nonprofit.org';
            $username = 'Micah2';
            $password = 'helloworld';
            $phone = '800-600-5000';
            $admin_stat = 0;
            $id = 1;
            $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
            $test_supervisor->save();

            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);
            $test_committee->save();

            $committee_name2 = 'FLASH';
            $department2 = 'Events';
            $description2 = 'The FLASH committee helps out on an on-call, last-minute basis.';
            $id2 = 2;
            $test_committee2 = new Committee($committee_name2, $department2, $description2, $id2);
            $test_committee2->save();

            //Act
            $test_supervisor->addCommittee($test_committee);
            $test_supervisor->addCommittee($test_committee2);
            $result = $test_supervisor->getCommittees();

            //Assert
            $this->assertEquals([$test_committee, $test_committee2], $result);
        }

        function test_checkUsernameExists()
        {
          //Arrange
          $first_name = 'Micah';
          $last_name = 'Smith';
          $position_title = 'Director of Development';
          $email = 'Micah@nonprofit.org';
          $username = 'Micah2';
          $password = 'helloworld';
          $phone = '800-600-5000';
          $admin_stat = 0;
          $id = 1;
          $test_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
          $test_supervisor->save();

          //Act
          $result = Supervisor::checkUsernameExists('Micah2');

          //Assert
          $this->assertEquals(1, $result);
        }

    }

?>
