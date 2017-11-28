<?php
class Router{
  private $command = null;
  private $request;
  private $response;
  private $message;

  function __construct() {
    $this->request = new Request();
    $this->response = new Response($this->request);
  }

  function excecuteCommand(){
    $command = $this->request->getCommand();
    require_once(DIR['commands'].COMMAND[$command]['class'].'.php');
    $class = COMMAND[$command]['class'];
    $object = new $class($this->request, $this->response);

    $object->beforeExcecute();
    $this->message = $object->excecute();
    $object->afterExcecute();
  }

  function end($send = true){
    if($send){
      $this->response->sendMessage($this->message);
    }
  }

}
