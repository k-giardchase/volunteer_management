<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=day_test');

    require_once __DIR__.'/../src/Volunteer.php';
    require_once __DIR__.'/../src/Event.php';

    class VolunteerTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Volunteer::deleteAll();
            Event::deleteAll();
        }

        function test_getFirstName()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getFirstName();

            //Assert
            $this->assertEquals('Maggie', $result);
        }

        function test_setFirstName()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setFirstName('Margaret');
            $result = $test_volunteer->getFirstName();

            //Assert
            $this->assertEquals('Margaret', $result);
        }

        function test_getLastName()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getLastName();

            //Assert
            $this->assertEquals('Doe', $result);
        }

        function test_setLastName()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setLastName('Does');
            $result = $test_volunteer->getLastName();

            //Assert
            $this->assertEquals('Does', $result);
        }

        function test_getEmail()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getEmail();

            //Assert
            $this->assertEquals('maggie@me.com', $result);
        }

        function test_setEmail()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setEmail('mag@me.com');
            $result = $test_volunteer->getEmail();

            //Assert
            $this->assertEquals('mag@me.com', $result);
        }

        function test_getUsername()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getUsername();

            //Assert
            $this->assertEquals('Mags123', $result);
        }

        function test_setUsername()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setUsername('Maggie123');
            $result = $test_volunteer->getUsername();

            //Assert
            $this->assertEquals('Maggie123', $result);
        }

        function test_getPassword()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getPassword();

            //Assert
            $this->assertEquals('1234', $result);
        }

        function test_setPassword()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setPassword('123');
            $result = $test_volunteer->getPassword();

            //Assert
            $this->assertEquals('123', $result);
        }

        function test_getAdminStat()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getAdminStat();

            //Assert
            $this->assertEquals(0, $result);
        }

        function test_setAdminStat()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setAdminStat(0);
            $result = $test_volunteer->getAdminStat();

            //Assert
            $this->assertEquals(0, $result);
        }

        function test_getId()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $result = $test_volunteer->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);

            //Act
            $test_volunteer->setId(4);
            $result = $test_volunteer->getId();

            //Assert
            $this->assertEquals(4, $result);
        }

        function test_save()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            //Act
            $result = Volunteer::getAll();

            //Assert
            $this->assertEquals([$test_volunteer], $result);
        }

        function test_getAll()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 0;
            $id = 2;
            $test_volunteer2 = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer2->save();

            //Act
            $result = Volunteer::getAll();

            //Assert
            $this->assertEquals([$test_volunteer, $test_volunteer2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 0;
            $id = 2;
            $test_volunteer2 = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer2->save();

            //Act
            Volunteer::deleteAll();
            $result = Volunteer::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 0;
            $id = 2;
            $test_volunteer2 = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer2->save();

            //Act
            $result = Volunteer::find($test_volunteer->getId());

            //Assert
            $this->assertEquals($test_volunteer, $result);
        }

        function test_update()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $new_first_name = 'Margaret';
            $new_last_name = 'Down';
            $new_email = 'mag@me.com';
            $new_username = 'Margaret123';
            $new_password = '4321';
            $new_admin_stat = 0;

            //Act
            $test_volunteer->update($new_first_name, $new_last_name, $new_email, $new_username, $new_password, $new_admin_stat);


            //Assert
            $this->assertEquals(['Margaret', 'Down', 'mag@me.com', 'Margaret123', '4321', 0], [$test_volunteer->getFirstName(), $test_volunteer->getLastName(), $test_volunteer->getEmail(), $test_volunteer->getUsername(), $test_volunteer->getPassword(), $test_volunteer->getAdminStat()]);
        }

        function test_delete()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 1;
            $id = 2;
            $test_volunteer2 = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer2->save();

            //Act
            $test_volunteer->delete();
            $result = Volunteer::getAll();

            //Assert
            $this->assertEquals([$test_volunteer2], $result);
        }

        function test_addEvent()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id1 = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id1);
            $test_volunteer->save();

            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id2 = 1;
            $test_event = new Event($event_name, $event_date, $location, $id2);
            $test_event->save();

            $event_name2 = 'Raffle';
            $event_date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id3 = 2;
            $test_event2 = new Event($event_name2, $event_date2, $location2, $id3);
            $test_event2->save();

            //Act
            $test_volunteer->addEvent($test_event);
            $result = $test_volunteer->getEvents();

            //Assert
            $this->assertEquals([$test_event], $result);
        }

        function test_getEvents()
        {
            //Arrange
            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0;
            $id = 1;
            $test_volunteer = new Volunteer($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_volunteer->save();

            $event_name = 'Silent Auction';
            $date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $date, $location, $id);
            $test_event->save();

            $event_name2 = 'Raffle';
            $date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id2 = 2;
            $test_event2 = new Event($event_name2, $date2, $location2, $id2);
            $test_event2->save();

            //Act
            $test_volunteer->addEvent($test_event);
            $test_volunteer->addEvent($test_event2);
            $result = $test_volunteer->getEvents();

            //Assert
            $this->assertEquals([$test_event, $test_event2], $result);
        }

    }

?>
