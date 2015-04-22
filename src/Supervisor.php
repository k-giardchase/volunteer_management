<?php

    class Supervisor
    {
        private $first_name;
        private $last_name;
        private $position_title;
        private $email;
        private $phone;
        private $id;

        function __construct($first_name, $last_name, $position_title, $email, $phone, $id = null)
        {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->position_title = $position_title;
            $this->email = $email;
            $this->phone = $phone;
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

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO supervisors (first_name, last_name, position_title, email, phone) VALUES ('{$this->getFirstName()}', '{$this->getLastName()}', '{$this->getPositionTitle()}', '{$this->getEmail()}', '{$this->getEmail()}', '{$this->getPhone()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }
    }

?>
