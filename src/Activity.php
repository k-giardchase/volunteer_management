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
    }

?>
