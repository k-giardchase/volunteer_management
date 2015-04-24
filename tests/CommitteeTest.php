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

    class ComitteeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
            Volunteer::deleteAll();
            Committee::deleteAll();
            Supervisor::deleteAll();
        }

        function test_getCommitteeName()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

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
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

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
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

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
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $test_committee->setDepartment('Prevention');
            $result = $test_committee->getDepartment();

            //Assert
            $this->assertEquals('Prevention', $result);
        }

        function test_getDescription()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $result = $test_committee->getDescription();

            //Assert
            $this->assertEquals('The art committee is responsible for making pretty things for events.', $result);
        }

        function test_setDescription()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $test_committee->setDescription('The art committee builds things for folks.');
            $result = $test_committee->getDescription();

            //Assert
            $this->assertEquals('The art committee builds things for folks.', $result);
        }

        function test_getId()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $result = $test_committee->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $test_committee->setId(3);
            $result = $test_committee->getId();

            //Assert
            $this->assertEquals(3, $result);
        }


        function test_save()
        {
            //Arrange
            $committee_name = 'Art';
            $department = 'Event Management';
            $description = 'The art committee is responsible for making pretty things for events.';
            $id = 1;
            $test_committee = new Committee($committee_name, $department, $description, $id);

            //Act
            $test_committee->save();
            $result = Committee::getAll();

            //Assert
            $this->assertEquals([$test_committee], $result);
        }

        function test_getAll()
        {
            //Arrange
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
            $result = Committee::getAll();

            //Assert
            $this->assertEquals([$test_committee, $test_committee2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
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
            Committee::deleteAll();
            $result = Committee::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
          //Arrange
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
          $result = Committee::find($test_committee2->getId());

          //Assert
          $this->assertEquals($test_committee2, $result);
      }

      function test_update()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

          $new_committee_name = 'Theory';
          $new_department = 'Organizing';
          $new_description = 'Study group for theory & practice.';

          //Act
          $test_committee->update($new_committee_name, $new_department, $new_description);

          //Assert
          $this->assertEquals(['Theory', 'Organizing', 'Study group for theory & practice.'], [$test_committee->getCommitteeName(), $test_committee->getDepartment(), $test_committee->getDescription()]);
      }

      function test_delete()
      {
          //Arrange
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
          $test_committee->delete();
          $result = Committee::getAll();

          //Assert
          $this->assertEquals([$test_committee2], $result);
      }

      function test_addEvent()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

          $event_name = 'Silent Auction';
          $event_date = '2015-01-01 12:00:00';
          $location = "202 Some Street";
          $id = 1;
          $test_event = new Event($event_name, $event_date, $location, $id);
          $test_event->save();

          //Act
          $test_committee->addEvent($test_event);
          $result = $test_committee->getEvents();

          //Assert
          $this->assertEquals([$test_event], $result);
      }

      function test_getEvents()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

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
          $test_committee->addEvent($test_event);
          $test_committee->addEvent($test_event2);
          $result = $test_committee->getEvents();

          //Assert
          $this->assertEquals([$test_event, $test_event2], $result);
      }

      function test_addSupervisor()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

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
          $test_committee->addSupervisor($test_supervisor);
          $result = $test_committee->getSupervisors();

          //Assert
          $this->assertEquals([$test_supervisor], $result);
      }

      function test_getSupervisors()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

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
          $test_committee->addSupervisor($test_supervisor);
          $test_committee->addSupervisor($test_supervisor2);
          $result = $test_committee->getSupervisors();

          //Assert
          $this->assertEquals([$test_supervisor2, $test_supervisor], $result);
      }

      function test_addVolunteer()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

          $first_name = 'Maggie';
          $last_name = 'Doe';
          $email = 'maggie@me.com';
          $phone = '999-888-7777';
          $username = 'Mags123';
          $password = '1234';
          $admin_stat = 0;
          $id = 1;
          $test_volunteer = new Volunteer($first_name, $last_name, $email, $phone, $username, $password, $admin_stat, $id);
          $test_volunteer->save();

          //Act
          $test_committee->addVolunteer($test_volunteer);
          $result = $test_committee->getVolunteers();

          //Assert
          $this->assertEquals([$test_volunteer], $result);
      }

      function test_getVolunteers()
      {
          //Arrange
          $committee_name = 'Art';
          $department = 'Event Management';
          $description = 'The art committee is responsible for making pretty things for events.';
          $id = 1;
          $test_committee = new Committee($committee_name, $department, $description, $id);
          $test_committee->save();

          $first_name = 'Maggie';
          $last_name = 'Doe';
          $email = 'maggie@me.com';
          $phone = '999-888-7777';
          $username = 'Mags123';
          $password = '1234';
          $admin_stat = 0;
          $id = 1;
          $test_volunteer = new Volunteer($first_name, $last_name, $email, $phone, $username, $password, $admin_stat, $id);
          $test_volunteer->save();

          $first_name2 = 'Jane';
          $last_name2 = 'Zoe';
          $email2 = 'jane@me.com';
          $phone2 = '111-333-2222';
          $username2 = 'jane123';
          $password2 = '9876';
          $admin_stat2 = 1;
          $id2 = 2;
          $test_volunteer2 = new Volunteer($first_name2, $last_name2, $email2, $phone2, $username2, $password2, $admin_stat2, $id2);
          $test_volunteer2->save();

          //Act
          $test_committee->addVolunteer($test_volunteer);
          $test_committee->addVolunteer($test_volunteer2);
          $result = $test_committee->getVolunteers();

          //Assert
          $this->assertEquals([$test_volunteer, $test_volunteer2], $result);
      }
    }
?>
