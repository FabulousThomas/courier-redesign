<?php

class Index extends Controller
{
   private $data = [];
   public function __construct()
   {
   }

   public function index()
   {
      $this->data = [
         "title" => "COURIER LOGISTICS",
      ];

      $this->view("index", $this->data);
   }
}
