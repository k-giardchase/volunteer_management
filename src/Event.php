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
            $GLOBALS['DB']->exec("DELETE FROM committees_events WHERE event_id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM events_volunteers WHERE event_id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM events ORDER BY event_date;");
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
                if($event_id == $search_id) {
                    $found_event = $event;
                }
            }
            return $found_event;
        }

        function addVolunteer($new_volunteer)
        {
            $GLOBALS['DB']->exec("INSERT INTO events_volunteers (event_id, volunteer_id) VALUES ({$this->getId()}, {$new_volunteer->getId()});");
        }

        function getVolunteers()
        {
            $query = $GLOBALS['DB']->query("SELECT volunteers.* FROM events JOIN events_volunteers ON (events.id = events_volunteers.event_id) JOIN volunteers ON (events_volunteers.volunteer_id = volunteers.id) WHERE events.id = {$this->getId()} ORDER BY last_name;");
            $returned_volunteers = $query->fetchAll(PDO::FETCH_ASSOC);
            $volunteers = [];
            foreach($returned_volunteers as $volunteer) {
                $first_name = $volunteer['first_name'];
                $last_name = $volunteer['last_name'];
                $email = $volunteer['email'];
                $phone = $volunteer['phone'];
                $username = $volunteer['username'];
                $password = $volunteer['password'];
                $admin_stat = $volunteer['admin_stat'];
                $id = $volunteer['id'];
                $new_volunteer= new Volunteer($first_name, $last_name, $email, $phone, $username, $password, $admin_stat, $id);
                array_push($volunteers, $new_volunteer);
            }
            return $volunteers;
        }

        function addCommittee($new_committee)
        {
            $GLOBALS['DB']->exec("INSERT INTO committees_events (committee_id, event_id) VALUES ({$new_committee->getId()}, {$this->getId()});");
        }

        function getCommittees()
        {
            $query = $GLOBALS['DB']->query("SELECT committees.* FROM events JOIN committees_events ON (events.id = committees_events.event_id) JOIN committees ON (committees_events.committee_id = committees.id) WHERE events.id = {$this->getId()} ORDER BY committee_name;");
            $returned_committees = $query->fetchAll(PDO::FETCH_ASSOC);
            $committees = [];
            foreach($returned_committees as $committee) {
                $committee_name = $committee['committee_name'];
                $department = $committee['department'];
                $description = $committee['description'];
                $id = $committee['id'];
                $new_committee = new Committee($committee_name, $department, $description, $id);
                array_push($committees, $new_committee);
            }
            return $committees;
        }
    }

?>
