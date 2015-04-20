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

        function setSupervisor($new_supervisor)
        {
            $this->supervisor = (string) $new_supervisor;
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
          $statement = $GLOBALS['DB']->query("INSERT INTO committees (committee_name, department, supervisor) VALUES ('{$this->getCommitteeName()}', '{$this->getDepartment()}', '{$this->getSupervisor()}') RETURNING id;");
          $result = $statement->fetch(PDO::FETCH_ASSOC);
          $this->setId($result['id']);
        }

        static function getAll()
        {
          $query = $GLOBALS['DB']->query("SELECT * FROM committees;");
          $returned_committees = $query->fetchAll(PDO::FETCH_ASSOC);
          $committees = [];
          foreach($returned_committees as $committee) {
            $committee_name = $committee['committee_name'];
            $department = $committee['department'];
            $supervisor = $committee['supervisor'];
            $id = $committee['id'];
            $new_committee = new Committee($committee_name, $department, $supervisor, $id);
            array_push($committees, $new_committee);
          }
          return $committees;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM committees *;");
        }

        static function find($search_id)
        {
          $found_committee = null;
          $all_committees = Committee::getAll();
          foreach($all_committees as $committee) {
            $committee_id = $committee->getId();
            if($committee_id === $search_id) {
              $found_committee = $committee;
            }
          }
          return $found_committee;
        }

    }

?>
