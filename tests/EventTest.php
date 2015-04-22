<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=volunteer_management_test');

    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/Volunteer.php';
    require_once __DIR__.'/../src/Committee.php';
    require_once __DIR__.'/../src/Supervisor.php';

    class EventTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
            Volunteer::deleteAll();
            Committee::deleteAll();
            Supervisor::deleteAll();

        }

        function test_getEventName()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals('Silent Auction', $result);
        }

        function test_setEventName()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $test_event->setEventName('Running');
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals('Running', $result);
        }

        function test_getEventDate()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = '202 Some Street';
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $result = $test_event->getEventDate();

            //Assert
            $this->assertEquals('2015-01-01 12:00:00', $result);
        }

        function test_setEventDate()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $test_event->setEventDate('2013-05-01 11:00:00');
            $result = $test_event->getEventDate();

            //Assert
            $this->assertEquals('2013-05-01 11:00:00', $result);
        }

        function test_getLocation()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = '202 Some Street';
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $result = $test_event->getLocation();

            //Assert
            $this->assertEquals('202 Some Street', $result);
        }

        function test_setLocation()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $test_event->setLocation('500 Another Street');
            $result = $test_event->getLocation();

            //Assert
            $this->assertEquals('500 Another Street', $result);
        }

        function test_getId()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $result = $test_event->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);

            //Act
            $test_event->setId(2);
            $result = $test_event->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event], $result);
        }

        function test_getAll()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $event_name2 = 'Raffle';
            $event_date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id2 = 2;
            $test_event2 = new Event($event_name2, $event_date2, $location2, $id2);
            $test_event2->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event, $test_event2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $event_name2 = 'Raffle';
            $event_date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id2 = 2;
            $test_event2 = new Event($event_name2, $event_date2, $location2, $id2);
            $test_event2->save();

            //Act
            Event::deleteAll();
            $result = Event::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $event_name2 = 'Raffle';
            $event_date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id2 = 2;
            $test_event2 = new Event($event_name2, $event_date2, $location2, $id2);
            $test_event2->save();

            //Act
            $result = Event::find($test_event2->getId());

            //Assert
            $this->assertEquals($test_event2, $result);
        }

        function test_update()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $new_event_name = 'Raffle';
            $new_event_date = '2012-04-04 12:00:00';
            $new_location = '500 Another Street';

            //Act
            $test_event->update($new_event_name, $new_event_date, $new_location);

            //Assert
            $this->assertEquals(['Raffle', '2012-04-04 12:00:00', '500 Another Street'], [$test_event->getEventName(), $test_event->getEventDate(), $test_event->getLocation()]);
        }

        function test_delete()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $event_name2 = 'Raffle';
            $event_date2 = '2015-01-01 12:00:00';
            $location2 = "500 Some Street";
            $id2 = 2;
            $test_event2 = new Event($event_name2, $event_date2, $location2, $id2);
            $test_event2->save();

            //Act
            $test_event2->delete();
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event], $result);
        }

        function test_addVolunteer()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

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
            $test_event->addVolunteer($test_volunteer);
            $result = $test_event->getVolunteers();

            //Assert
            $this->assertEquals([$test_volunteer], $result);
        }

        function test_getVolunteers()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
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
            $test_event->addVolunteer($test_volunteer);
            $test_event->addVolunteer($test_volunteer2);
            $result = $test_event->getVolunteers();

            //Assert
            $this->assertEquals([$test_volunteer, $test_volunteer2], $result);
        }

        function test_addCommittee()
        {
            //Arrange
            $event_name = 'Silent Auction';
            $event_date = '2015-01-01 12:00:00';
            $location = "202 Some Street";
            $id = 1;
            $test_event = new Event($event_name, $event_date, $location, $id);
            $test_event->save();

            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);
            $test_committee->save();

            //Act
            $test_event->addCommittee($test_committee);
            $result = $test_event->getCommittees();

            //Assert
            $this->assertEquals([$test_committee], $result);
        }
    }

?>
