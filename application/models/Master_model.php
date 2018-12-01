<?php 
defined('BASEPATH') or die('Some thing error occured');

class Master_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        /*Setting the Cart Session (Temporary session) COde Start*/
        $this->cartsession=$this->session->userdata('cartsession');
        if(!isset($this->cartsession) && empty($this->cartsession))
        {
            $set_new_session=md5('VAV'.PROJECT_NAME.time().rand(3,99999));
            $this->session->set_userdata('cartsession',$set_new_session);
            $this->cartsession=$set_new_session;
            
        }
        /*Setting the Cart Session (Temporary session) COde End*/
    }
    public function sliderList($param=NULL)
   {
        
       $cols ="*";
        
       $where=[];
      
           $where['flag_status']=1;
        
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
   

   public function  common($title,$search=NULL)
   {
        $table=$orderby=$result_title=$cols=$status='';
        switch($title)
        {
            case 'menu':
                $cols='*';
                $table='menu_tbl';
                $orderby='menu_title';
                $order_condition='ASC';
                $result_title='menu';
                $status='flag_status';
            break;
            case 'region':
                $cols='*';
                $table='submenu_tbl';
                $orderby='submenu_title';
                $order_condition='ASC';
                $result_title='region';
                $status='flag_status';
            break;
            case 'language':
                $cols='*';
                $table='language';
                $orderby='language';
                $order_condition='ASC';
                $result_title='language';
                $status='flag_status';
            break;
        }

        if($table!='' && $cols!='' && $orderby!='' && $order_condition!='' && $result_title!='')
        {
            $where[$status]=1;
            $result =  $this->crud->singleTableData(
                [
                    'table'=>$table,
                    'cols'=>$cols,
                    'order_by'=>['column'=>$orderby,'sort'=>$order_condition],
                    'response_param'=>$result_title.'_result',
                    'description_message'=>"Getting $result_title list",
                    'debug'=>FALSE,
                    'where_condition'=>$where,
                ]
             );
             return $result; 
        }
        else
        {
            return json_encode([CODE=>204,MESSAGE=>'fail',DESCRIPTION=>'main keys are missing']); 
        }

   }


   public function bookList($param=NULL)
   {
        
       $cols ="*";
       $where=['book_status !='=>2];
       $status=(isset($param['status']))?$param['status']:'';
       $userid=(isset($param['userid']))?$param['userid']:'';
       if($status!='' && ($status==1 || $status==0))
       {
            $where['book_status']=$status;
       }
       if(!empty($userid))
       {
            $where['user_id']=$userid;
       }
       
        
       $result =  $this->crud->singleTableData(
          [
              'table'=>'books',
              'cols'=>$cols,
              'order_by'=>['column'=>'book_id','sort'=>'DESC'],
              'response_param'=>'book_result',
              'description_message'=>'Getting books list',
              'debug'=>FALSE,
              'where_condition'=>$where,
          ]
       );
      return $result; 
   }

  
   public function allMenuList($param=NULL)
   {
       $repsonse=['menu_result'=>[]];
       
       $sql = $this->db->select('id,menu_title')->from('menu_tbl')->where('flag_status',1)->order_by('menu_title',"ASC")->get();
       $count = $sql->num_rows();
       if($count > 0)
       {
           $repsonse[CODE]=200;
           $repsonse[MESSAGE]='success';
           $repsonse[DESCRIPTION]='Getting the menu list ';
           $menuArray=[];
           foreach($sql->result() as $res)
           {
               $menuArray['menu_id']=$res->id;
               $menuArray['menu_title']=fetch_ucfirst($res->menu_title);
               $menuArray['submenu']=[];
               //Menu Related Products 
               $subWhere=['flag_status'=>1,'menu_id'=>$res->id];
               $subsql = $this->db->select('subgroup_id,menu_id,subgroup_title,years')->from('subgroups')->where($subWhere)->order_by('subgroup_title','ASC')->get();
               $subCount = $subsql->num_rows();
               if($subCount > 0)
               {
                   $subArray=[];
                   foreach($subsql->result() as $sub_res)
                   {
                        foreach($sub_res as $key=>$val)
                        {
                            $subArray[$key]=$val;
                        }
                        array_push($menuArray['submenu'],$subArray);
                   }
               }
               array_push($repsonse['menu_result'],$menuArray);
           }
       }
       else
       {
        $repsonse[CODE]=204;
        $repsonse[MESSAGE]='fail';
        $repsonse[DESCRIPTION]='No Results found';
       }

      return json_encode($repsonse); 
   }
}