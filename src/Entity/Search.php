<?php namespace App\Entity;
 class Search {

     private $cin;

      public function getCin(): ?string 
       { return $this->cin; }

        public function setCin(string $cin): self

        { $this->cin = $cin;

             return $this;
         } 
        }