<?php

    class Activity
    {
        private $activity_name;
        private $id;

        function __construct($activity_name, $id = null)
        {
            $this->activity_name = $activity_name;
            $this->id = $id;
        }

        function getActivityName()
        {
            return $this->activity_name;
        }

        function setActivityName($new_activity_name)
        {
            $this->activity_name = (string) $new_activity_name;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO users (activity_name) VALUES ('{$this->getActivityName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }
    }

?>
