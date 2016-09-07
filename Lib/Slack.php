<?php
namespace Lib;
class Slack
{
  public function __construct($teamname, $apiToken)
  {
    $this->teamname = $teamname;
    $this->apiToken = $apiToken;
    $this->curl = new \Curl();
  }
  public function inviteMail($firstname, $mail) {
    $url = 'https://'.$this->teamname.'.slack.com/api/users.admin.invite?t='.time();
    $data = [];
    $data["email"] = $mail;
    $data["channels"] = "";
    $data["first_name"] = $firstname;
    $data["token"] = $this->apiToken;
    $data["set_active"] = true;
    $data["_attempts"] = 1;
    $res = $this->curl->post($url, $data);
    return json_decode($res->body, true);
  }
}
