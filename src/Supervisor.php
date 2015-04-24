<?php

    class Supervisor
    {
        private $first_name;
        private $last_name;
        private $position_title;
        private $email;
        private $username;
        private $password;
        private $phone;
        private $admin_stat;
        private $id;

        function __construct($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat = 1, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->position_title = $position_title;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->phone = $phone;
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

        function getPositionTitle()
        {
            return $this->position_title;
        }

        function setPositionTitle($new_position_title)
        {
            $this->position_title = (string) $new_position_title;
        }

        function getEmail()
        {
            return $this->email;
        }

        function setEmail($new_email)
        {
            $this->email = (string) $new_email;
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

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO supervisors (first_name, last_name, position_title, email, username, password, phone, admin_stat) VALUES ('{$this->getFirstName()}', '{$this->getLastName()}', '{$this->getPositionTitle()}', '{$this->getEmail()}', '{$this->getUsername()}', '{$this->getPassword()}', '{$this->getPhone()}', {$this->getAdminStat()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_first_name, $new_last_name, $new_position_title, $new_email, $new_username, $new_password, $new_phone, $new_admin_stat)
        {
            $GLOBALS['DB']->exec("UPDATE supervisors SET first_name = '{$new_first_name}' WHERE id = {$this->getId()};");
            $this->setFirstName($new_first_name);

            $GLOBALS['DB']->exec("UPDATE supervisors SET last_name = '{$new_last_name}' WHERE id = {$this->getId()};");
            $this->setLastName($new_last_name);

            $GLOBALS['DB']->exec("UPDATE supervisors SET position_title = '{$new_position_title}' WHERE id = {$this->getId()};");
            $this->setPositionTitle($new_position_title);

            $GLOBALS['DB']->exec("UPDATE supervisors SET email = '{$new_email}' WHERE id = {$this->getId()};");
            $this->setEmail($new_email);

            $GLOBALS['DB']->exec("UPDATE supervisors SET username = '{$new_username}' WHERE id = {$this->getId()};");
            $this->setUsername($new_username);

            $GLOBALS['DB']->exec("UPDATE supervisors SET password = '{$new_password}' WHERE id = {$this->getId()};");
            $this->setPassword($new_password);

            $GLOBALS['DB']->exec("UPDATE supervisors SET phone = '{$new_phone}' WHERE id = {$this->getId()};");
            $this->setPhone($new_phone);

            $GLOBALS['DB']->exec("UPDATE supervisors SET admin_stat = '{$new_admin_stat}' WHERE id = {$this->getId()};");
            $this->setAdminStat($new_admin_stat);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM supervisors WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM supervisors ORDER BY last_name;");
            $returned_supervisors = $query->fetchAll(PDO::FETCH_ASSOC);
            $supervisors = [];
            foreach($returned_supervisors as $supervisor) {
                $first_name = $supervisor['first_name'];
                $last_name = $supervisor['last_name'];
                $position_title = $supervisor['position_title'];
                $email = $supervisor['email'];
                $username = $supervisor['username'];
                $password = $supervisor['password'];
                $phone = $supervisor['phone'];
                $admin_stat = $supervisor['admin_stat'];
                $id = $supervisor['id'];
                $new_supervisor = new Supervisor($first_name, $last_name, $position_title, $email, $username, $password, $phone, $admin_stat, $id);
                array_push($supervisors, $new_supervisor);
            }
            return $supervisors;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM supervisors *;");
        }

        static function find($search_id)
        {
            $found_supervisor = null;
            $all_supervisors = Supervisor::getAll();
            foreach($all_supervisors as $supervisor) {
                $supervisor_id = $supervisor->getId();
                if($supervisor_id === $search_id) {
                    $found_supervisor = $supervisor;
                }
            }
            return $found_supervisor;
        }

        function addCommittee($new_committee)
        {
            $GLOBALS['DB']->exec("INSERT INTO committees_supervisors (committee_id, supervisor_id) VALUES ({$new_committee->getId()}, {$this->getId()});");
        }
        function getCommittees()
        {
            $query = $GLOBALS['DB']->query("SELECT committees.* FROM supervisors JOIN committees_supervisors ON (supervisors.id = committees_supervisors.supervisor_id) JOIN committees ON (committees_supervisors.committee_id = committees.id) WHERE supervisors.id = {$this->getId()} ORDER BY committee_name;");
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

        static function checkUsernameExists($inputted_username)
        {
          $result = 0;
          $supervisors = Supervisor::getAll();
          foreach($supervisors as $supervisor) {
            $username = $supervisor->getUsername();
            if($username === $inputted_username) {
              $result = 1;
            }
          }
          return $result;
        }
    }

?>
