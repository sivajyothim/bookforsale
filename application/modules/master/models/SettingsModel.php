<?php 
defined('BASEPATH') or die('some thing error occured');

class SettingsModel extends CI_Model
{


    public function menuList($param=NULL)
    {
         
        $cols ="*";
        $status = (isset($param['status']))?$param['status']:'';
        $where=[];
        if($status!='')
        {
            $where['flag_status']=$status;
        }
        $result =  $this->crud->singleTableData(
           [
               'table'=>'menu_tbl',
               'cols'=>$cols,
               'order_by'=>['column'=>'id','sort'=>'DESC'],
               'response_param'=>'menu_result',
               'description_message'=>'Getting menu list',
               'debug'=>FALSE,
               'where_condition'=>$where,
           ]
        );
       return $result; 
    }

     //Insert Menu
     public function insertMenu($param)
     {
         $response=[];
         //Duplication checking is pending
         $menuSql = $this->db->insert_string('menu_tbl',$param);
         $menuInsert = $this->db->query($menuSql);
         $insertStaus = $this->db->affected_rows();
         if($insertStaus > 0)
         {
            
             $response[CODE]=SUCCESS_CODE;
             $response[MESSAGE]='success';
             $response[DESCRIPTION]='Menu added successfully';
         
         }
         else
         {
                     $response[CODE]=FAIL_CODE;
                     $response[MESSAGE]='fail';
                     $response[DESCRIPTION]='Unable to add menu';
         }
         return json_encode($response);
     }

    public function sliderList($param=NULL)
    {
         
        $cols ="*";
        $status = (isset($param['status']))?$param['status']:'';
        $where=[];
        if($status!='')
        {
            $where['flag_status']=$status;
        }
        $result =  $this->crud->singleTableData(
           [
               'table'=>'slider_tbl',
               'cols'=>$cols,
               'order_by'=>['column'=>'id','sort'=>'DESC'],
               'response_param'=>'slider_result',
               'description_message'=>'Getting slider list',
               'debug'=>FALSE,
               'where_condition'=>$where,
           ]
        );
       return $result; 
    }
 //Insert Item
 public function insertSlider($param)
 {
     $response=[];
     //Duplication checking is pending
     $menuSql = $this->db->insert_string('slider_tbl',$param);
     $menuInsert = $this->db->query($menuSql);
     $insertStaus = $this->db->affected_rows();
     if($insertStaus > 0)
     {
        
         $response[CODE]=SUCCESS_CODE;
         $response[MESSAGE]='success';
         $response[DESCRIPTION]='Slider added successfully';
     
     }
     else
     {
                 $response[CODE]=FAIL_CODE;
                 $response[MESSAGE]='fail';
                 $response[DESCRIPTION]='Unable to add Slider';
     }
     return json_encode($response);
 }
 

    //Food Menu List

    public function foodMenuList($param)
    {
       
       $response=[];
       $cols='m.*,vg.title as veg_type,w.week_title as week_title';
       $this->db->select($cols)->from('food_menu m')->join('veg_types vg','vg.id=m.menu_vegtype','inner');
       $this->db->join('weeks w','w.week_id=m.menu_day','left');
       $sql = $this->db->order_by('m.menu_id','DESC')->get();
       $count = $sql->num_rows();
       $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
       $response[MESSAGE]=($count > 0)?'success':'fail';
       $response[DESCRIPTION]=($count > 0)?'Getting the Food Menu list':'No results found';
       $response['menu_result']=($count > 0)?$sql->result():[];
       return json_encode($response);
    } 

   /*>> Submenu list module section code start */

   public function subNenuList($param=NULL)
    {
         
        $cols ="*";
        $status = (isset($param['status']))?$param['status']:'';
        $where=[];
        if($status!='')
        {
            $where['flag_status']=$status;
        }
        $result =  $this->crud->singleTableData(
           [
               'table'=>'submenu_tbl',
               'cols'=>$cols,
               'order_by'=>['column'=>'id','sort'=>'DESC'],
               'response_param'=>'submenu_result',
               'description_message'=>'Getting sub menu list',
               'debug'=>FALSE,
               'where_condition'=>$where,
           ]
        );
       return $result; 
    }
    public function insertSubMenu($param)
     {
         $response=[];
         //Duplication checking is pending
         $menuSql = $this->db->insert_string('submenu_tbl',$param);
         $menuInsert = $this->db->query($menuSql);
         $insertStaus = $this->db->affected_rows();
         if($insertStaus > 0)
         {
            
             $response[CODE]=SUCCESS_CODE;
             $response[MESSAGE]='success';
             $response[DESCRIPTION]='Submenu added successfully';
         
         }
         else
         {
                     $response[CODE]=FAIL_CODE;
                     $response[MESSAGE]='fail';
                     $response[DESCRIPTION]='Unable to add Submenu';
         }
         return json_encode($response);
     }


     /*>> Submenu list module section code end */

     /*>> Weight list module section code start */

   public function weightList($param=NULL)
   {
        
       $cols ="*";
       $status = (isset($param['status']))?$param['status']:'';
       $where=[];
       if($status!='')
       {
           $where['flag_status']=$status;
       }
       $result =  $this->crud->singleTableData(
          [
              'table'=>'postal_weigths',
              'cols'=>$cols,
              'order_by'=>['column'=>'weight_id','sort'=>'DESC'],
              'response_param'=>'weight_result',
              'description_message'=>'Getting weight list',
              'debug'=>FALSE,
              'where_condition'=>$where,
          ]
       );
      return $result; 
   }
   public function insertWeight($param)
    {
        $response=[];
        //Duplication checking is pending
        $menuSql = $this->db->insert_string('postal_weigths',$param);
        $menuInsert = $this->db->query($menuSql);
        $insertStaus = $this->db->affected_rows();
        if($insertStaus > 0)
        {
           
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]='success';
            $response[DESCRIPTION]='Weight added successfully';
        
        }
        else
        {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='fail';
                    $response[DESCRIPTION]='Unable to add weight';
        }
        return json_encode($response);
    }


    /*>> Weight list module section code end */
    
    /*>> Subgroups module section code start */
    public function insertSubGroup($param)
    {
        $response=[];
        //Duplication checking is pending
        $menuSql = $this->db->insert_string('subgroups',$param);
        $menuInsert = $this->db->query($menuSql);
        $insertStaus = $this->db->affected_rows();
        if($insertStaus > 0)
        {
           
            $response[CODE]=SUCCESS_CODE;
            $response[MESSAGE]='success';
            $response[DESCRIPTION]='Subgroup added successfully';
        
        }
        else
        {
                    $response[CODE]=FAIL_CODE;
                    $response[MESSAGE]='fail';
                    $response[DESCRIPTION]='Unable to add Subgroup';
        }
        return json_encode($response);
    }

    public function subGroupList($param=NULL)
    {
         
        $cols ="sg.*,m.menu_title";
        $status = (isset($param['status']))?$param['status']:'';
        $where=[];
        if($status!='')
        {
            $where['sg.flag_status']=$status;
        }
        $result =  $this->crud->fetchSingleJoinsData(
           [
               'table'=>'subgroups sg',
               'cols'=>$cols,
               'order_by'=>['column'=>'sg.subgroup_id','sort'=>'DESC'],
               'response_param'=>'submenu_result',
               'description_message'=>'Getting subgroup list',
               'debug'=>FALSE,
               'where_condition'=>$where,
               'joins'=>['table'=>'menu_tbl m','original_column'=>'m.id','ref_column'=>'sg.menu_id','condition'=>'inner']
           ]
        );
       return $result; 
    }
    /*>> Subgroups module section code end */
}

