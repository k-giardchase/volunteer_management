<?php

    class Event
    {
        private $event_name;
        private $event_date;
        private $location;
        private $id;

        function __construct($event_name, $event_date, $location, $id = null)
        {
            $this->event_name = $event_name;
            $this->event_date = $event_date;
            $this->location = $location;
            $this->id = $id;
        }

        function getEventName()
        {
            return $this->event_name;
        }

        function setEventName($new_event_name)
        {
            $this->event_name = (string) $new_event_name;
        }

        function getEventDate()
        {
            return $this->event_date;
        }

        function setEventDate($new_event_date)
        {
            $this->event_date = (string) $new_event_date;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO events (event_name, event_date, location) VALUES ('{$this->getEventName()}', '{$this->getEventDate()}', '{$this->getLocation()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_event_name, $new_event_date, $new_location)
        {
            $GLOBALS['DB']->exec("UPDATE events SET event_name = '{$new_event_name}' WHERE id = {$this->getId()};");
            $this->setEventName($new_event_name);
            $GLOBALS['DB']->exec("UPDATE events SET event_date = '{$new_event_date}' WHERE id = {$this->getId()};");
            $this->setEventDate($new_event_date);
            $GLOBALS['DB']->exec("UPDATE events SET location = '{$new_location}' WHERE id = {$this->getId()};");
            $this->setLocation($new_location);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM events WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM events;");
            $returned_events = $query->fetchAll(PDO::FETCH_ASSOC);
            $events = [];

            foreach($returned_events as $event) {
                $event_name = $event['event_name'];
                $event_date = $event['event_date'];
                $location = $event['location'];
                $id = $event['id'];
                $new_event = new Event($event_name, $event_date, $location, $id);
                array_push($events, $new_event);
            }
            return $events;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM events *;");
        }

        static function find($search_id)
        {
            $found_event = null;
            $events = Event::getAll();
            foreach($events as $event) {
                $event_id = $event->getId();
                if($event_id === $search_id) {
                    $found_event = $event;
                }
            }
            return $found_event;
        }

        function addUser($new_user)
        {
            $GLOBALS['DB']->exec("INSERT INTO events_users (event_id, user_id) VALUES ({$this->getId()}, {$new_user->getId()});");
        }

        function getUsers()
        {
            $query = $GLOBALS['DB']->query("SELECT users.* FROM events JOIN events_users ON (events.id = events_users.event_id) JOIN users ON (events_users.user_id = users.id) WHERE events.id = {$this->getId()};");
            $returned_users = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = [];
            foreach($returned_users as $user) {
                $first_name = $user['first_name'];
                $last_name = $user['last_name'];
                $email = $user['email'];
                $username = $user['username'];
                $password = $user['password'];
                $admin_stat = $user['admin_stat'];
                $id = $user['id'];
                $new_user = new User($first_name, $last_name, $email, $username, $password, $admin_stat, $id);
                array_push($users, $new_user);
            }
            return $users;
        }
    }

?>
