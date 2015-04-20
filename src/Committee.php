<?php

    class Committee
    {
        private $committee_name;
        private $department;
        private $supervisor;
        private $id;

        function __construct($committee_name, $department, $supervisor, $id = null)
        {
            $this->committee_name = $committee_name;
            $this->department = $department;
            $this->supervisor = $supervisor;
            $this->id = $id;
        }

        function getCommitteeName()
        {
            return $this->committee_name;
        }

        function setCommitteeName($new_committee_name)
        {
            $this->committee_name = (string) $new_committee_name;
        }

        function getDepartment()
        {
            return $this->department;
        }

        function setDepartment($new_department)
        {
            $this->department = (string) $new_department;
        }

        function getSupervisor()
        {
            return $this->supervisor;
        }

    }

?>
