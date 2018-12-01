<?php
defined('BASEPATH') or die('Some thing error occured');

class Books_model extends CI_Model
{

    public function insertBook($param)
    {
        $response=[];
        //Duplication checking is pending
        $sql = $this->db->insert_string('books',$param);
        $insert = $this->db->query($sql);
        $insertStaus = $this->db->affected_rows();
        if($insertStaus > 0)
        {
           
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]='success';
            $response[DESCRIPTION]='book added successfully';
        
        }
        else
        {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='fail';
                    $response[DESCRIPTION]='Unable to add book';
        }
        return json_encode($response);
    }
}