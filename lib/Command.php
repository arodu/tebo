<?php
  abstract class Command{

    private $request;
    private $response;

    public function __construct($request, $response) {
      $this->request = $request;
      $this->response = $response;
    }

    public function getResponse(){
      return $this->response();
    }

    public function beforeExcecute(){}

    public function afterExcecute(){}

    abstract public function excecute();

  }
 ?>
