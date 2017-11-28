<?php
class Request{
  private $chat_id;
  private $data;

  function __construct() {
    $content = file_get_contents("php://input");
    $this->data = json_decode($content, true);
    $this->chat_id = $this->data["message"]["chat"]["id"];
  }

  public function getChatID(){
    return $this->chat_id;
  }

  public function getArguments(){
    $args = explode(" ",trim($this->data["message"]["text"]));
    $args_command =  explode("_", $args[0]);
    unset($args[0]);
    return array_merge($args_command, $args);
  }

  public function getCommand(){
    $args = $this->getArguments();
    $command = str_replace(array('\\','/'), "", $args[0]);
    return strtolower($command);
  }

}
