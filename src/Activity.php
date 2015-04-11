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
    }

?>
