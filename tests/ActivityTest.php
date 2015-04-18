<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql: host=localhost;dbname=day_test');

    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/User.php';

    class EventTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Event::deleteAll();
            User::deleteAll();
        }

        function test_getEventName()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);

            //Act
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals('Sleeping', $result);
        }

        function test_setEventName()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);

            //Act
            $test_event->setEventName('Running');
            $result = $test_event->getEventName();

            //Assert
            $this->assertEquals('Running', $result);
        }

        function test_getId()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);

            //Act
            $result = $test_event->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);

            //Act
            $test_event->setId(2);
            $result = $test_event->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event], $result);
        }

        function test_getAll()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $event_name2 = 'Running';
            $id2 = 2;
            $test_event2 = new Event($event_name, $id);
            $test_event2->save();

            //Act
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event, $test_event2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $event_name2 = 'Running';
            $id2 = 2;
            $test_event2 = new Event($event_name, $id);
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
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $event_name2 = 'Running';
            $id2 = 2;
            $test_event2 = new Event($event_name, $id);
            $test_event2->save();

            //Act
            $result = Event::find($test_event2->getId());

            //Assert
            $this->assertEquals($test_event2, $result);
        }

        function test_update()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $new_event_name = 'Running';

            //Act
            $test_event->update($new_event_name);

            //Assert
            $this->assertEquals('Running', $test_event->getEventName());
        }

        function test_delete()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $event_name2 = 'Running';
            $id2 = 2;
            $test_event2 = new Event($event_name, $id);
            $test_event2->save();

            //Act
            $test_event2->delete();
            $result = Event::getAll();

            //Assert
            $this->assertEquals([$test_event], $result);
        }

        function test_addUser()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 0E;
            $id = 1;
            $test_user = new User($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_user->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 1;
            $id = 2;
            $test_user2 = new User($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_user2->save();

            //Act
            $test_event->addUser($test_user);
            $result = $test_event->getUsers();

            //Assert
            $this->assertEquals([$test_user], $result);
        }

        function test_getUsers()
        {
            //Arrange
            $event_name = 'Sleeping';
            $id = 1;
            $test_event = new Event($event_name, $id);
            $test_event->save();

            $first_name = 'Maggie';
            $last_name = 'Doe';
            $email = 'maggie@me.com';
            $username = 'Mags123';
            $password = '1234';
            $admin_stat = 1;
            $id = 1;
            $test_user = new User($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_user->save();

            $first_name = 'Johnny';
            $last_name = 'Doe';
            $email = 'johnny@me.com';
            $username = 'John123';
            $password = '123456';
            $admin_stat = 0;
            $id = 2;
            $test_user2 = new User($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
            $test_user2->save();

            //Act
            $test_event->addUser($test_user);
            $test_event->addUser($test_user2);
            $result = $test_event->getUsers();

            //Assert
            $this->assertEquals([$test_user, $test_user2], $result);
        }
    }

?>
