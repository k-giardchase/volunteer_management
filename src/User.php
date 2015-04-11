<?php

    class User
    {
        private $first_name;
        private $last_name;
        private $email;
        private $username;
        private $password;
        private $activity_level;
        private $id;

        function __construct($first_name, $last_name, $email, $username, $password, $activity_level, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->activity_level = $activity_level;
            $this->id = $id;
        }
    }

?>
