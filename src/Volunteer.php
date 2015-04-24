<?php

    class Volunteer
    {
        private $first_name;
        private $last_name;
        private $email;
        private $phone;
        private $username;
        private $password;
        private $admin_stat;
        private $id;

        function __construct($first_name, $last_name, $email, $phone, $username, $password, $admin_stat = 0, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->phone = $phone;
            $this->username = $username;
            $this->password = $password;
            $this->admin_stat = $admin_stat;
            $this->id = $id;
        }

        function getFirstName()
        {
            return $this->first_name;
        }

        function setFirstName($new_first_name)
        {
            $this->first_name = (string) $new_first_name;
        }

        function getLastName()
        {
            return $this->last_name;
        }

        function setLastName($new_last_name)
        {
            $this->last_name = (string) $new_last_name;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setEmail($new_email)
        {
            $this->email = (string) $new_email;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getUsername()
        {
            return $this->username;
        }

        function setUsername($new_username)
        {
            $this->username = (string) $new_username;
        }

        function getPassword()
        {
            return $this->password;
        }

        function setPassword($new_password)
        {
            $this->password = (string) $new_password;
        }

        function getAdminStat()
        {
            return $this->admin_stat;
        }

        function setAdminStat($new_admin_stat)
        {
            $this->admin_stat = (int) $new_admin_stat;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO volunteers (first_name, last_name, email, phone, username, password, admin_stat) VALUES  ('{$this->getFirstName()}', '{$this->getLastName()}', '{$this->getEmail()}', '{$this->getPhone()}', '{$this->getUsername()}', '{$this->getPassword()}', {$this->getAdminStat()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_first_name, $new_last_name, $new_email, $new_phone, $new_username, $new_password, $new_admin_stat)
        {
            $GLOBALS['DB']->exec("UPDATE volunteers SET first_name = '{$new_first_name}' WHERE id={$this->getId()};");
            $this->setFirstName($new_first_name);

            $GLOBALS['DB']->exec("UPDATE volunteers SET last_name = '{$new_last_name}' WHERE id={$this->getId()};");
            $this->setLastName($new_last_name);

            $GLOBALS['DB']->exec("UPDATE volunteers SET email = '{$new_email}' WHERE id={$this->getId()};");
            $this->setEmail($new_email);

            $GLOBALS['DB']->exec("UPDATE volunteers SET phone = '{$new_phone}' WHERE id={$this->getId()};");
            $this->setPhone($new_phone);

            $GLOBALS['DB']->exec("UPDATE volunteers SET username = '{$new_username}' WHERE id={$this->getId()};");
            $this->setUsername($new_username);

            $GLOBALS['DB']->exec("UPDATE volunteers SET password = '{$new_password}' WHERE id={$this->getId()};");
            $this->setPassword($new_password);

            $GLOBALS['DB']->exec("UPDATE volunteers SET admin_stat = {$new_admin_stat} WHERE id={$this->getId()};");
            $this->setAdminStat($new_admin_stat);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM volunteers WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM volunteers ORDER BY last_name;");
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
                $new_volunteer = new Volunteer($first_name, $last_name, $email, $phone, $username, $password, $admin_stat, $id);
                array_push($volunteers, $new_volunteer);
            }

            return $volunteers;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM volunteers *;");
        }

        static function find($search_id)
        {
            $found_volunteer = null;
            $volunteers = Volunteer::getAll();

            foreach($volunteers as $volunteer) {
                $volunteer_id = $volunteer->getId();
                if($volunteer_id === $search_id) {
                    $found_volunteer = $volunteer;
                }
            }
            return $found_volunteer;
        }

        static function checkUsernameExists($inputted_username)
        {
            $result = 0;
            $volunteers = Volunteer::getAll();
            foreach($volunteers as $volunteer) {
                $username = $volunteer->getUsername();
                if($username === $inputted_username) {
                    $result = 1;
                }
            }
            return $result;
        }

        static function authenticateLogin($inputted_username, $inputted_password)
        {
            $result = 0;
            $volunteers = Volunteer::getAll();
            foreach($volunteers as $volunteer) {
              $username = $volunteer->getUsername();
              $password = $volunteer->getPassword();
              if($username === $inputted_username && $password === $inputted_password) {
                $result = $volunteer;
              }
            }
            return $result;
        }

        function addEvent($new_event)
        {
            $GLOBALS['DB']->exec("INSERT INTO events_volunteers (event_id, volunteer_id) VALUES ({$new_event->getId()}, {$this->getId()});");
        }

        function getEvents()
        {
            $query = $GLOBALS['DB']->query("SELECT events.* FROM volunteers JOIN events_volunteers ON (volunteers.id = events_volunteers.volunteer_id) JOIN events ON (events_volunteers.event_id = events.id) WHERE volunteers.id = {$this->getId()} ORDER BY event_date;");
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

        function addCommittee($new_committee)
        {
            $GLOBALS['DB']->exec("INSERT INTO committees_volunteers (committee_id, volunteer_id) VALUES ({$new_committee->getId()}, {$this->getId()});");
        }

        function getCommittees()
        {
            $query = $GLOBALS['DB']->query("SELECT committees.* FROM volunteers JOIN committees_volunteers ON (volunteers.id = committees_volunteers.volunteer_id) JOIN committees ON (committees_volunteers.committee_id = committees.id) WHERE volunteers.id = {$this->getId()} ORDER BY committee_name;");
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
