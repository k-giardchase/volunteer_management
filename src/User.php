<?php

    class User
    {
        private $first_name;
        private $last_name;
        private $email;
        private $username;
        private $password;
        private $admin_stat;
        private $id;

        function __construct($first_name, $last_name, $email, $username, $password, $admin_stat, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO users (first_name, last_name, email, username, password, admin_stat) VALUES ('{$this->getFirstName()}', '{$this->getLastName()}', '{$this->getEmail()}', '{$this->getUsername()}', '{$this->getPassword()}', {$this->getAdminStat()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_first_name, $new_last_name, $new_email, $new_username, $new_password, $new_admin_stat)
        {
            $GLOBALS['DB']->exec("UPDATE users SET first_name = '{$new_first_name}' WHERE id={$this->getId()};");
            $this->setFirstName($new_first_name);

            $GLOBALS['DB']->exec("UPDATE users SET last_name = '{$new_last_name}' WHERE id={$this->getId()};");
            $this->setLastName($new_last_name);

            $GLOBALS['DB']->exec("UPDATE users SET email = '{$new_email}' WHERE id={$this->getId()};");
            $this->setEmail($new_email);

            $GLOBALS['DB']->exec("UPDATE users SET username = '{$new_username}' WHERE id={$this->getId()};");
            $this->setUsername($new_username);

            $GLOBALS['DB']->exec("UPDATE users SET password = '{$new_password}' WHERE id={$this->getId()};");
            $this->setPassword($new_password);

            $GLOBALS['DB']->exec("UPDATE users SET admin_stat = {$new_admin_stat} WHERE id={$this->getId()};");
            $this->setAdminStat($new_admin_stat);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM users WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM users;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM users *;");
        }

        static function find($search_id)
        {
            $found_user = null;
            $users = User::getAll();

            foreach($users as $user) {
                $user_id = $user->getId();
                if($user_id === $search_id) {
                    $found_user = $user;
                }
            }
            return $found_user;
        }

        function addActivity($new_activity)
        {
            $GLOBALS['DB']->exec("INSERT INTO activities_users (activity_id, user_id) VALUES ({$new_activity->getId()}, {$this->getId()});");
        }
        function getActivities()
        {
            $query = $GLOBALS['DB']->query("SELECT activities.* FROM users JOIN activities_users ON (users.id = activities_users.user_id) JOIN activities ON (activities_users.activity_id = activities.id) WHERE users.id = {$this->getId()};");
            $returned_activities = $query->fetchAll(PDO::FETCH_ASSOC);

            $activities = [];
            foreach($returned_activities as $activity) {
                $activity_name = $activity['activity_name'];
                $id = $activity['id'];
                $new_activity = new Activity($activity_name, $id);
                array_push($activities, $new_activity);
            }
            return $activities;
        }
    }

?>
