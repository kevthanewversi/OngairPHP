<?php
class OngairAPIV1 {
	var $token;
	public $request = new Requests();
	// public $env = getenv('SUBDOMAIN');
    public $url1 ='http://beta.ongair.im/api/v1/base';
	
	public function __construct($token){
	$this->token = $token; // the
	
	} 
	

 function status(){
	     $url = $this->url1.'/status?token='.$this->token;
	     $this->request->getUrl($url);
	}


	

function sendMessage($phone_number,$message){  
	     $url = $this->url1.'/send';
	     $post_data['token'] = $this->token;
	     $post_data['phone_number'] = $phone_number;
	     $post_data['text'] = $message;
	     $this->request->implodeandPost($post_data,$url);

}

function createContact($phone_number, $name)
{       $post_data['token'] = $this->token; 
		$post_data['phone_number'] = $phone_number;
		$post_data['$name'] = $name;
        $url = $this->$url1.'/create_contact';
	    $this->request->implodeandPost($post_data,$url);
}

	 function createGroup($name) {   
	 	$post_data['token'] = $this->token; 
		$post_data['$name'] = '$name';
		$url = $this->$url1.'/create_group';	
		$this->request->implodeandPost($post_data,$url);
	 }


	function addParticipant($id, $phone_number) { 
		$post_data['token'] = $this->token;   
		$post_data['$phone_number'] = $phone_number;
		$url = $this->$url1.'/groups/$id/add_participant';
		$this->request->implodeandPost($post_data,$url);	
	}

	function removeFromGroup($id, $phone_number){
		$post_data['token'] = $this->token;  
		$post_data['$phone_number'] = $phone_number;

		$url = $this->$url1.'/groups/$id/remove_participant';
		$this->request->implodeandPost($post_data,$url);
	}

	function sendGroupMessage($phone_number, $message, $id){
	    $post_data['token'] = $this->token; 
		$post_data['phone_number'] = $phone_number;
		$post_data['text'] = $message;
		$url = $this->$url1.'/groups/$id/send_message'; //where does the $id come from

		$this->request->implodeandPost($post_data,$url);
	}

	
                  }

class OngairAPIV2 {
	var $token;
	public $request = new Requests();
	public $url2 ='http://beta.ongair.im/api/v2';
	
	public function __construct($token){
    	$this->token = $token;
	}

	function createList($name,$description) {
	   $post_data['token'] = $this->token;
       $post_data['name'] = $name;
       $post_data['description'] = $description;
       $url = $this->url2.'/list';
       $this->request->implodeandPost($post_data,$url);
	}

	function addListMember($list_id,$contact_id){
	   $post_data['token'] = $this->token;
	   $post_data['id'] = $list_id;
       $post_data['contact_id'] = $contact_id;
       $url = $this->url2.'/lists/$listid/add_contact';
       $this->request->implodeandPost($post_data,$url);
	}

	function removeListMember($list_id,$contact_id){
	   $post_data['token'] = $this->token;
	   $post_data['id'] = $list_id;
       $post_data['contact_id'] = $contact_id;
       $url = $this->url2.'/lists/$list_id/remove_contact';
       $this->request->implodeandPost($post_data,$url);
	}

	function createContact($name,$phone_number){
	   $post_data['token'] = $this->token;
	   $post_data['contact[name]'] = $name;
       $post_data['contact[phone_number]'] = $phone_number;
       $url = $this->url2.'/contacts';
       $this->request->implodeandPost($post_data,$url);
	}

	function createGroup($name,$type,$jid){
	   $post_data['token'] = $this->token; 
	   $post_data['group[name]'] = $name;
	   $post_data['group[group_type]'] = $type;
	   $post_data['group[jid]'] = $jid;
       $url = $this->url2.'/groups';
       $this->request->implodeandPost($post_data,$url);
	}

	function sendMessage($phone_number,$text,$thread){
	   $post_data['token'] = $this->token; 
	   $post_data['phone_number'] = $phone_number;
	   $post_data['text'] = $text;
	   $post_data['thread'] = $thread;
       $url = $this->url2.'messages/send_message';
       $this->request->implodeandPost($post_data,$url);
		
	}

	function lists(){
		$url = $this->url1.'/lists?token='.$this->token;
	    $this->request->getUrl($url);
           
	}

	function listMembers($list_id){
		$url = $this->url1.'lists/$list_id/members?token='.$this->token;
	    $this->request->getUrl($url);
		
	}

                 }


class Requests{
	function implodeandPost($post_data, $url){ //for POST requests
		foreach ( $post_data as $key => $value)  //implode url post parametres so they can be appended to the url
		 {
			$post_items[] = $key . '=' . $value;
		 }
		$post_string = implode ('&', $post_items);
		 // $token = "";
		$ch = curl_init(); //initialize connection
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post_string); //set post parametres
        $result = curl_exec($ch);//go to url
		echo $result; //either 1 0r 0
		print_r(curl_getinfo($ch)); //request info for debugging
        curl_close($ch); //close connection
	}

    function getUrl($url){ //for GET requests
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL,$url);
	    $result = curl_exec($ch);
		echo $result;
		print_r(curl_getinfo($ch)); 
	    curl_close($ch);
	}
}
  
?>

