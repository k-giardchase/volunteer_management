<?php

    class Committee
    {
        private $committee_name;
        private $department;
        private $staff_member;

        function __construct($committee_name, $department, $staff_member)
        {
            $this->committee_name = $committee_name;
            $this->department = $department;
            $this->staff_member = $staff_member;
        }

        
    }

?>
