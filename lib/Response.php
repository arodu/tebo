<?php
class Response{
  private $request;
  private $formatMessage = [
    'chat_id' => null,
    'parse_mode' => 'HTML',
    'text' => '',
    'disable_web_page_preview'=>true,
  ];

  function __construct($request) {
    $this->request = $request;
    $this->setFormatMessage( ['chat_id' => $this->request->getChatID()] );
  }

  public function sendMessage($message){
    $this->setFormatMessage(['text'=>$message]);
    $result = file_get_contents( API_URL."sendmessage",false,$this->contextAPI('json') );
  }

  public function contextAPI($type = 'json'){
    if($type == 'json'){
      return stream_context_create(['http' =>
        [
          'method'  => 'POST',
          'header'  => 'Content-type: application/json',
          'content' => json_encode( $this->getFormatMessage() ),
        ]
      ]);
    }elseif($type = 'url'){
      return stream_context_create(['http' =>
        [
          'method'  => 'GET',
          'header'  => 'application/x-www-form-urlencoded',
          'content' => http_build_query($this->getFormatMessage()),
        ]
      ]);
    }
  }

  public function setFormatMessage($message_options = []){
    $this->formatMessage = array_merge ($this->formatMessage, $message_options);
  }

  public function getFormatMessage(){
      return $this->formatMessage;
  }


}
