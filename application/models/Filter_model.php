<?php 
defined('BASEPATH') or die('Some thing error occured');

class Filter_model extends CI_Model
{

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


   public function homeBookList($param=NULL)
   {
       $repsonse=['menu_products'=>[]];
       
       $sql = $this->db->select('id,menu_title')->from('menu_tbl')->where('flag_status',1)->order_by('menu_title',"ASC")->get();
       $count = $sql->num_rows();
       if($count > 0)
       {
           $repsonse[CODE]=200;
           $repsonse[MESSAGE]='success';
           $repsonse[DESCRIPTION]='Getting the menu related products ';
           $menuArray=[];
           foreach($sql->result() as $res)
           {
               $menuArray['menu_id']=$res->id;
               $menuArray['menu_title']=fetch_ucfirst($res->menu_title);
               $menuArray['products']=[];
               //Menu Related Products 
               $booksWhere=['book_status'=>1,'menu_id'=>$res->id];
               $booksql = $this->db->select('book_id,menu_id,book_title,mrp,selling_price,book_image,stock')->from('books')->where($booksWhere)->limit(12)->order_by('book_id','DESC')->get();
               $bookCount = $booksql->num_rows();
               if($bookCount > 0)
               {
                   $bookArray=[];
                   foreach($booksql->result() as $book_res)
                   {
                        foreach($book_res as $key=>$val)
                        {
                            $bookArray[$key]=$val;
                        }
                        array_push($menuArray['products'],$bookArray);
                   }
               }
               array_push($repsonse['menu_products'],$menuArray);
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



   public function productList($param)
   {
      $category = $param['category'];
       $id = $param['categrory_id'];
       $category_col ='';
       switch($category)
       {
           case 'menu':$category_col='p.menu_id';break;
           case 'submenu':$category_col='p.sub_group_id';break;
       } 
       $repsonse=[];
       $booksWhere=['p.book_status'=>1,$category_col=>$id];
       $booksql = $this->db->select('p.*,l.language')->from('books p')
       ->join('language l','l.id=p.language','left')
       ->where($booksWhere)->order_by('book_id','DESC')->get();
       $bookCount = $booksql->num_rows();
       $repsonse[CODE]=($bookCount > 0)?SUCCESS_CODE:FAIL_CODE;
       $repsonse[MESSAGE]=($bookCount > 0)?'success':'fail';
       $repsonse[DESCRIPTION]=($bookCount > 0)?'Getting product list':'No results found';
       $repsonse['result_count']=$bookCount;
       $repsonse['product_result']=($bookCount > 0)?$booksql->result():[];
       return  json_encode($repsonse);
   }

    public function searchProductList($param)
   {
       $repsonse=[];
       $title = $param['title'];
       $booksWhere=['p.book_status'=>1,];
       $booksql = $this->db->select('p.*,l.language')->from('books p')
                           ->join('language l','l.id=p.language','left')
                           ->where($booksWhere);
        if($title !='')
        {
          $this->db->like('p.book_title',$title,'both');
          $this->db->or_like('p.region_name',$title,'both');
          $this->db->or_like('p.author_name',$title,'both');
           $this->db->or_like('p.published_year',$title,'both');
        }                   
       $booksql = $this->db->order_by('book_id','DESC')->get();
       $bookCount = $booksql->num_rows();
       $repsonse[CODE]=($bookCount > 0)?SUCCESS_CODE:FAIL_CODE;
       $repsonse[MESSAGE]=($bookCount > 0)?'success':'fail';
       $repsonse[DESCRIPTION]=($bookCount > 0)?'Getting product list':'No results found';
       $repsonse['result_count']=$bookCount;
       $repsonse['product_result']=($bookCount > 0)?$booksql->result():[];
       return  json_encode($repsonse);
   }
   
   
    public function productDetails($param)
   {
       $id = $param['productid'];
       $repsonse=[];
       $booksWhere=['p.book_status'=>1,'book_id'=>$id];
       $booksql = $this->db->select('p.*,l.language,m.menu_title,s.subgroup_title as submenu')->from('books p')
       ->join('language l','l.id=p.language','left')
       ->join('menu_tbl m','m.id=p.menu_id','inner')
       ->join('subgroups s','s.subgroup_id=p.sub_group_id','left')
       ->where($booksWhere)->order_by('book_id','DESC')->get();
       $bookCount = $booksql->num_rows();
       $repsonse[CODE]=($bookCount > 0)?SUCCESS_CODE:FAIL_CODE;
       $repsonse[MESSAGE]=($bookCount > 0)?'success':'fail';
       $repsonse[DESCRIPTION]=($bookCount > 0)?'Getting product list':'No results found';
       $repsonse['result_count']=$bookCount;
       $repsonse['product_result']=($bookCount > 0)?$booksql->row():[];
       return  json_encode($repsonse);
   }
   
  
}