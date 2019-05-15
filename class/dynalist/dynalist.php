<?php
namespace dynalist;

class dynalist {

    const BASE_URL = 'https://dynalist.io/api/v1/';

    private $dynalist_api_private_key;

    function __construct($api_private_key) {
        echo "I am an dynalist";
        $this->dynalist_api_private_key = $api_private_key;
    }

    public function get_all_documents() {
        $data = array("token"=>$this->dynalist_api_private_key);
        $request_data = json_encode($data);
        return $this->execute_request("file/list",$request_data);    
    }
    public function get_document_content($file_id) {
        $data = array("token"=>$this->dynalist_api_private_key, "file_id"=>$file_id);
        $request_data = json_encode($data);
        return $this->execute_request("doc/read",$request_data);    
    }

    public function set_document_content($file_id, $changes) {
        
        $data = array("token"=>$this->dynalist_api_private_key, 
                      "file_id"=>$file_id, 
                      "changes"=> $changes);
                      echo "<pre>";
                      print_r($data);
                      echo "</pre>";
        
        $request_data = json_encode($data);
        echo "<pre>";
        print_r($request_data);
        echo "</pre>";

        return $this->execute_request("doc/edit",$request_data);  
    }


    public function add_item_to_inbox($content, $list_position=-1, $note="", $checked=false, $check_box=false, $heading=0, $colour=0) {

        $data = array("token"=>$this->dynalist_api_private_key, 
                      "index"=>$list_position, 
                      "content"=>$content,
                      "note"=>$note,
                      "checked"=>$checked,
                      "check_box"=>$check_box,
                      "heading"=>$heading,
                      "colour"=>$colour,);
        print_r($data);
        $request_data = json_encode($data);
        return $this->execute_request("inbox/add",$request_data); 

    }
    
    private function execute_request($request_path,$request_data) {
        $ch = curl_init(self::BASE_URL . $request_path);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($request_data))                                                                       
        );                                                                                                                   
                                                                                                                         
        $result = curl_exec($ch);

        return json_decode($result,true);

    }
}

