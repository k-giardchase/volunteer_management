<?php

    class Committee
    {
        private $committee_name;
        private $department;
        private $staff_member;
        private $id;

        function __construct($committee_name, $department, $staff_member, $id = null)
        {
            $this->committee_name = $committee_name;
            $this->department = $department;
            $this->staff_member = $staff_member;
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

    }

?>
