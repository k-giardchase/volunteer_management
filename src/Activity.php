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
            $statement = $GLOBALS['DB']->query("INSERT INTO activities (activity_name) VALUES ('{$this->getActivityName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_activity_name)
        {
            $GLOBALS['DB']->exec("UPDATE activities SET activity_name = '{$new_activity_name}' WHERE id = {$this->getId()};");
            $this->setActivityName($new_activity_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM activities WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM activities;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM activities *;");
        }

        static function find($search_id)
        {
            $found_activity = null;
            $activities = Activity::getAll();
            foreach($activities as $activity) {
                $activity_id = $activity->getId();
                if($activity_id === $search_id) {
                    $found_activity = $activity;
                }
            }
            return $found_activity;
        }
    }

?>
