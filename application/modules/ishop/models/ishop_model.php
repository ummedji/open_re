<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ishop_model extends BF_Model
{

    public function __construct()
    {

        parent::__construct();

    }


    /**
     * @ Function Name		: get_distributor_by_user_id
     * @ Function Params	: $country_id
     * @ Function Purpose 	: Return list of distributor
     * @ Function Return 	: Array
     * */
    
    public function get_distributor_by_user_id($country_id)
    {

            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('type','customer');
            $this->db->where('role_id','9');
            $this->db->where('country_id',$country_id);
            $distributor=$this->db->get()->result_array();
            if(isset($distributor) && !empty($distributor)) {
                return $distributor;
            } else{
                return false;
            }
    }

    /**
     * @ Function Name		: get_product_sku_by_user_id
     * @ Function Params	: $country_id
     * @ Function Purpose 	: Return list of products
     * @ Function Return 	: Array
     * */

    /*  Set in product modules*/
    public function get_product_sku_by_user_id($country_id)
    {
        $this->db->select('psc.product_sku_country_id,psc.product_sku_name,psr.product_sku_code,ptlc.product_type_label_name');
        $this->db->from('master_product_sku_country as psc');
        $this->db->join('master_product_sku_regional as psr', 'psr.product_sku_id = psc.product_sku_id');
        $this->db->join('master_product_type_label_regional as ptlr', 'ptlr.product_type_label_regional_id = psc.PBG');
        $this->db->join('master_product_type_label_country as ptlc', 'ptlc.product_type_label_country_id = ptlr.product_type_label_regional_id');
        $this->db->where('ptlc.country_id',$country_id);
        $product_sku=$this->db->get()->result_array();
        //testdata($product_sku);
        if(isset($product_sku) && !empty($product_sku)) {
            return $product_sku;
        } else{
            return false;
        }
    }

    /**
     * @ Function Name		: get_product_sku_by_user_id
     * @ Function Params	:
     * @ Function Purpose 	: Return list of products
     * @ Function Return 	: Array
     * */

    public function add_primary_sales_details($user_id)
    {
        $customer_id = $this->input->post("customer_id");
        $invoice_no = $this->input->post("invoice_no");
        $invoice_date = $this->input->post("invoice_date");
        $order_tracking_no = $this->input->post("order_tracking_no");
        $PO_no = $this->input->post("PO_no");

        $product_sku_id = $this->input->post("product_sku_id");
        $quantity = $this->input->post("quantity");
      /*  $dispatched_quantity = $this->input->post("dispatched_quantity");*/
        $amount = $this->input->post("amount");
        $total_amount=array_sum($amount);

        $primary_sales_data = array(
            'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
            'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
            'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
            'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
            'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
            'invoice_recived_status' => '0',
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

       if ($this->db->insert('bf_ishop_primary_sales', $primary_sales_data)) {
            $insert_id = $this->db->insert_id();
        }

        $primary_sales_id = $insert_id;
       foreach($product_sku_id as $key=>$prd_sku)
       {
           $primary_sales_product_data = array(

                'primary_sales_id'=>$primary_sales_id,
                'product_sku_id'=>$prd_sku,
                'quantity'=>$quantity[$key],
               /* 'dispatched_quantity'=>$dispatched_quantity[$key],*/
                'amount'=>$amount[$key],
           );
           $this->db->insert('bf_ishop_primary_sales_product', $primary_sales_product_data);
       }
        return 1;
    }

    /**
     * @ Function Name		: get_primary_details_view
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function get_primary_details_view($form_date,$to_date,$by_distributor,$by_invoice_no)
    {

        $this->db->select('ips.invoice_no,ips.invoice_date,bu.user_code,bu.display_name,ips.PO_no,ips.order_tracking_no,ips.total_amount,ips.primary_sales_id');
        $this->db->from('ishop_primary_sales as ips');

        if(isset($by_distributor) && !empty($by_distributor) && $by_distributor != 0)
        {
            $this->db->where('customer_id', $by_distributor);
        }
        if(isset($by_invoice_no) && !empty($by_invoice_no))
        {
            $this->db->where('invoice_no', $by_invoice_no);
        }
        if(isset($form_date) && !empty($form_date))
        {
                $this->db->where('invoice_date >=', $form_date);
        }
        if(isset($to_date) && !empty($to_date))
        {
            $this->db->where('invoice_date <=', $to_date);
        }
        $this->db->join('users as bu', 'bu.id = ips.customer_id');
        $sales = $this->db->get();
       // echo $this->db->last_query();
        $primary_sales = $sales->result_array();

        if(isset($primary_sales) && !empty($primary_sales))
        {
            $primary['head'] =array('Sr. No.','Action','Invoice No','Invoice Date','Distributor Code','Distributor Name','PO No.','Order Tracking No.','Dispatch Amount');
            $i=1;
            foreach($primary_sales as $ps )
            {
                $primary['row'][]= array($i,$ps['primary_sales_id'],$ps['invoice_no'],$ps['invoice_date'],$ps['user_code'],$ps['display_name'],$ps['PO_no'],$ps['order_tracking_no'],$ps['total_amount']);
                $i++;
            }
            $primary['eye']=1;
            return $primary;
        }
    }
    /*--------------------------------------------------------------------------------------------------------------------*/

    /**
     * @ Function Name		: get_provience_by_customer_type
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function get_provience_by_customer_type($customer_type_id)
    {
        $this ->db->select('geo_id');
        $this ->db->from('master_customer_type_to_geo_mapping');
        $this ->db->where('cusomer_type_id',$customer_type_id);
        $this ->db->where('status',1);
        $geo_id=$this->db->get()->row_array();

        if(isset($geo_id) && !empty($geo_id)) {
            $this ->db->select('political_geo_id,political_geography_name');
            $this ->db->from('master_political_geography_details');
            $this ->db->where('geo_level_id',$geo_id['geo_id']);
            $this ->db->where('status',1);
            $provience = $this->db->get()->result_array();
            //testdata($provience);
            if(isset($provience) && !empty($provience))
            {
                return $provience;
            }
        }
        else
        {
            return false;
        }

    }


    /**
     * @ Function Name		: get_distributor_by_provience_id
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function get_distributor_by_provience_id($provience_id)
    {
        $this ->db->select('bu.id,bu.display_name,bu.user_code');
        $this ->db->from('users as bu');
        $this->db->join('master_user_contact_details as ucd', 'ucd.user_id = bu.id');
        if(isset($provience_id) && !empty($provience_id) && $provience_id !='0')
        {
            $this ->db->where('ucd.geo_level_id3',$provience_id);
        }
        $this ->db->where('bu.active',1);
        $distributor = $this->db->get()->result_array();
      //  testdata($distributor);
        return $distributor;
    }

    /**
     * @ Function Name		: add_rol_detail
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function add_rol_detail($user_id)
    {

        $customer_id = $this->input->post("distributor_name");
        $product_sku_id = $this->input->post("product_sku_id");
        $units = $this->input->post("units");
        $rol_quantity = $this->input->post("rol_qty");
        $rol_quantity_Kg_Ltr = $this->input->post("rol_qty_kgl");

        foreach($product_sku_id as $key=>$prd_sku) {
            $rol_data = array(
                'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                'product_sku_id' => (isset($product_sku_id) && !empty($product_sku_id)) ? $prd_sku : '',
                'units' => (isset($units) && !empty($units)) ? $units[$key] : '',
                'rol_quantity' => (isset($rol_quantity) && !empty($rol_quantity)) ? $rol_quantity[$key] : '',
                'rol_quantity_Kg_Ltr' => (isset($rol_quantity_Kg_Ltr) && !empty($rol_quantity_Kg_Ltr)) ? $rol_quantity_Kg_Ltr[$key] : '',
                'created_by_user' => $user_id,
                'status' => '1',
                'created_on' => date('Y-m-d H:i:s')
            );
            $this->db->insert('ishop_rol', $rol_data);
        }
        return 1;
    }

    /**
     * @ Function Name		: get_customer_type_id_by_user_id
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function get_customer_type_id_by_user_id($country_id)
    {
        $this ->db->select('ctc.customer_type_country_id,ctc.customer_type_name as ctc_ctn,ctr.customer_type_name as ctr_ctn');
        //$this ->db->select('*');
        $this ->db->from('master_customer_type_country as ctc');

        $this ->db->join('master_customer_type_regional as ctr','ctr.customer_type_id=ctc.customer_type_id');

        $this ->db->where('ctc.country_id',$country_id);
        $this ->db->where('ctc.status',1);
        $this ->db->where('ctc.deleted',0);
        $distributor = $this->db->get()->result_array();
          //testdata($distributor);
        return $distributor;
    }


    /**
     * @ Function Name		: get_retailer_by_distributor_id
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function get_retailer_by_distributor_id($id,$country_id)
    {
        $this->db->select('*');
        $this->db->from('master_customer_to_customer_mapping as mctcm');
        $this->db->join('users as bu','bu.id =mctcm.to_customer_id');
        $this->db->where('mctcm.from_customer_id',$id);
        $this->db->where('bu.type','customer');
        $this->db->where('bu.role_id','10');
        $this->db->where('bu.active','1');
        $this->db->where('bu.country_id',$country_id);
        $retailer = $this->db->get()->result_array();

        if(isset($retailer) && !empty($retailer)) {
            return $retailer;
        } else{
            return false;
        }
    }

    /**
     * @ Function Name		: add_secondary_sales_details_data
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function add_secondary_sales_details_data($user_id)
    {
        $customer_id = $this->input->post("customer_id");
        $invoice_no = $this->input->post("invoice_no");
        $invoice_date = $this->input->post("invoice_date");
        $order_tracking_no = $this->input->post("order_tracking_no");
        $PO_no = $this->input->post("PO_no");

        $product_sku_id = $this->input->post("product_sku_id");
        $dispatched_quantity = $this->input->post("dis_quantity");
        $quantity = $this->input->post("quantity");
        $amount = $this->input->post("amount");
        $total_amount=array_sum($amount);

        $secondary_sales_data = array(
            'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
            'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
            'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
            'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
            'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
            'invoice_recived_status' => '0',
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

        if ($this->db->insert('ishop_secondary_sales', $secondary_sales_data)) {
            $insert_id = $this->db->insert_id();
        }

        $secondary_sales_id = $insert_id;
        foreach($product_sku_id as $key=>$prd_sku)
        {
            $secondary_sales_product_data = array(

                'secondary_sales_id'=>$secondary_sales_id,
                'product_sku_id'=>$prd_sku,
                'quantity'=>$quantity[$key],
                'dispatched_quantity'=>$dispatched_quantity[$key],
                'amount'=>$amount[$key],
            );
            $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);
        }
        return 1;
    }

    /**
     * @ Function Name		: secondary_sales_details_data_view
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function secondary_sales_details_data_view($form_date,$to_date,$by_retailer,$by_invoice_no)
    {
        $this->db->select('iss.invoice_no,iss.invoice_date,bu.user_code,bu.display_name,iss.PO_no,iss.order_tracking_no,iss.total_amount,iss.secondary_sales_id');
        $this->db->from('ishop_secondary_sales as iss');

        if(isset($by_retailer) && !empty($by_retailer) && $by_retailer != 0)
        {
            $this->db->where('customer_id', $by_retailer);
        }
        if(isset($by_invoice_no) && !empty($by_invoice_no))
        {
            $this->db->where('invoice_no', $by_invoice_no);
        }
        if(isset($form_date) && !empty($form_date))
        {
            $this->db->where('invoice_date >=', $form_date);
        }
        if(isset($to_date) && !empty($to_date))
        {
            $this->db->where('invoice_date <=', $to_date);
        }
        $this->db->join('users as bu', 'bu.id = iss.customer_id');
        $sales = $this->db->get();
       // echo $this->db->last_query();
        $secondary_sales = $sales->result_array();
       // testdata($secondary_sales);
        if(isset($secondary_sales) && !empty($secondary_sales))
        {
            $secondary['head'] =array('Sr. No.','Action','Invoice No','Invoice Date','Retailer Code','Retailer Name','PO No.','Order Tracking No.','Dispatch Amount');
            $i=1;
            foreach($secondary_sales as $ss )
            {
                $secondary['row'][]= array($i,$ss['secondary_sales_id'],$ss['invoice_no'],$ss['invoice_date'],$ss['user_code'],$ss['display_name'],$ss['PO_no'],$ss['order_tracking_no'],$ss['total_amount']);
                $i++;
            }
            $secondary['eye']=1;
            return $secondary;
        }
    }

    /**
     * @ Function Name		: secondary_sales_product_details_view_by_id
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

   public function secondary_sales_product_details_view_by_id($secondary_sales_id)
   {
       $sql ='SELECT issp.secondary_sales_product_id,psr.product_sku_code,psc.product_sku_name,issp.quantity,issp.amount ';
       $sql .= 'FROM bf_ishop_secondary_sales_product AS issp ';
       $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = issp.product_sku_id) ';
       $sql .= 'JOIN bf_master_product_sku_regional AS psr ON (psr.product_sku_id = psc.product_sku_id) ';
       $sql .= 'WHERE 1 ';
       $sql .= 'AND issp.secondary_sales_id ='.$secondary_sales_id.' ';
       $info = $this->db->query($sql);
       $secondary_sales_product_detail = $info->result_array();
       $product_detail = array('result'=>$secondary_sales_product_detail);
      // var_dump($product_detail);die;

       if(isset($product_detail['result']) && !empty($product_detail['result']))
       {
           $product_view['head'] =array('Sr. No.','Action','Product SKU Code','Product SKU Name','Qty. Kg/Ltr','Amount');
           $i=1;
           foreach($product_detail['result'] as $pd )
           {
               $product_view['row'][]= array($i,$pd['secondary_sales_product_id'],$pd['product_sku_code'],$pd['product_sku_name'],$pd['quantity'],$pd['amount']);
               $i++;
           }
           $product_view['eye'] ='';
           // $product_view['pagination'] = $report_details['pagination'];
           return $product_view;
       }
   }

    /**
     * @ Function Name		: add_physical_stock_detail
     * @ Function Params	:
     * @ Function Purpose 	:
     * @ Function Return 	: Array
     * */

    public function add_physical_stock_detail($user_id)
    {
        $stock_month = $this->input->post("stock_month");
        $retailer_id=$this->input->post("fo_retailer_id");
        $distributor_id=$this->input->post("distributor_phystok");
        if(isset($retailer_id) && !empty($retailer_id) && $retailer_id != '0')
        {
            $customers_id=$retailer_id;
        }
        elseif(isset($distributor_id) && !empty($distributor_id) && $distributor_id != '0')
        {
            $customers_id=$distributor_id;
        }
        else{
            $customers_id=$user_id;
        }

        $product_sku_id = $this->input->post("product_sku_id");
        $quantity = $this->input->post("quantity");


      /*  echo "<pre>";
        print_r($_POST);
        die;*/
        foreach($product_sku_id as $key=>$prd_sku)
        {
            $physical_stock_data = array(

                'customer_id'=>$customers_id,
                'stock_month'=>$stock_month.'-01',
                'product_sku_id'=>$prd_sku,
                'quantity'=>$quantity[$key],
                'created_by_user' => $user_id,
                'status' => '1',
                'created_on' => date('Y-m-d H:i:s')

            );
           //echo "<pre>";
          /*  print_r($physical_stock_data);
            echo "=====================================";
            var_dump($physical_stock_data);*/
           $this->db->insert('ishop_physical_stock', $physical_stock_data);
        }
      // die;
        return 1;
    }



    /*--------------------------------------------------------------------------------------------------------------------*/



    public function primary_sales_product_details_view_by_id($primary_sales_id)
    {
        $sql ='SELECT ipsp.primary_sales_product_id,psr.product_sku_code,psc.product_sku_name,ipsp.quantity,ipsp.dispatched_quantity,ipsp.amount ';
        $sql .= 'FROM bf_ishop_primary_sales_product AS ipsp ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = ipsp.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS psr ON (psr.product_sku_id = psc.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND ipsp.primary_sales_id ='.$primary_sales_id.' ';
        $info = $this->db->query($sql);
        $primary_sales_product_detail = $info->result_array();
        $product_detail = array('result'=>$primary_sales_product_detail);
       // var_dump($product_detail);die;

        if(isset($product_detail['result']) && !empty($product_detail['result']))
        {
            $product_view['head'] =array('Sr. No.','Action','Product SKU Code','Product SKU Name','Qty. Kg/Ltr','Dispatched Qty. Kg/Ltr','Amount');
            $i=1;
            foreach($product_detail['result'] as $pd )
            {
                $product_view['row'][]= array($i,$pd['primary_sales_product_id'],$pd['product_sku_code'],$pd['product_sku_name'],$pd['quantity'],$pd['dispatched_quantity']
                ,$pd['amount']);
                $i++;
            }
            $product_view['eye'] ='';
           // $product_view['pagination'] = $report_details['pagination'];
            return $product_view;
        }
    }
    
    
    /**
     * @ Function Name		: get_product_conversion_data
     * @ Function Params	: product sku id , quantity to be calculated , unit data on basis of whiuch calculation need to be done
     * @ Function Purpose 	: Return converted quantity value
     * @ Function Return 	: value
     * */
    
    public function get_product_conversion_data($skuid,$quantity_data,$unit_data){
        
        $this->db->select('*');
        $this->db->from('bf_master_conversation as conv');
        $this->db->where('product_sku_id',$skuid);
        $product_conversion_data=$this->db->get()->result_array();
        
        $result = "";
        
        if(!empty($product_conversion_data)){
            
            if($unit_data == "box"){
                $box_conversion_data =  $product_conversion_data[0]["box_conversion_factor"];
                $result = $quantity_data*$box_conversion_data;
                
            }else if($unit_data == "packages"){
                $package_conversion_data =  $product_conversion_data[0]["sku_convesion_factor"];
                $result = $quantity_data*$package_conversion_data;
           
            }else{
                $result = $quantity_data;
            } 
        }
        return $result;
        
    }
    
    /**
     * @ Function Name		: get_retailer_by_user_id
     * @ Function Params	: $country_id
     * @ Function Purpose 	: Return list of retailers of specific country
     * @ Function Return 	: Array
     * */
    
    public function get_retailer_by_user_id($country_id)
    {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('type','customer');
            $this->db->where('role_id','10');
            $this->db->where('country_id',$country_id);
            $retailer=$this->db->get()->result_array();
            if(isset($retailer) && !empty($retailer)) {
                return $retailer;
            } else{
                return false;
            }
    }
    
    /**
     * @ Function Name		: get_distributor_by_retailer
     * @ Function Params	: country_id, retailer_id
     * @ Function Purpose 	: Return list of distributors for specific retailers
     * @ Function Return 	: Array
     * */
    
    public function get_distributor_by_retailer($country_id,$retailer_id){
        
        $this->db->select('*');
        $this->db->from('users as u');
        $this->db->join('bf_master_customer_to_customer_mapping as c_to_c','c_to_c.from_customer_id = u.id');
        $this->db->where('u.type','customer');
        $this->db->where('c_to_c.to_customer_id',$retailer_id);
        $this->db->where('u.role_id','9');
        $this->db->where('u.deleted','0');
        $this->db->where('u.country_id',$country_id);
        
        $retailer_distributer_data=$this->db->get()->result_array();
        if(isset($retailer_distributer_data) && !empty($retailer_distributer_data)) {
            return json_encode($retailer_distributer_data);
        } else{
            return 0;
        }
        
    }
    
    /**
     * @ Function Name		: add_order_place_details
     * @ Function Params	: Login user id = user_id
     * @ Function Purpose 	: Add order to database table orders
     * @ Function Return 	: Array
     * */
    
    public function add_order_place_details($user_id) {
        
       // echo "<pre>";
       // print_r($_POST);
        
        
        if($this->input->post("login_customer_type") == 9){
            
            /*
             * IF LOGIN USER IS DISTRIBUTOR
             */
            
            $customer_id_from = $user_id;
            $customer_id_to = 0;
            $order_taken_by_id = $user_id;
            
            $order_status = 0;
            
            $po_no = $this->input->post("po_no");
            
            $order_date = date("Y-m-d");
            
        }
        else if($this->input->post("login_customer_type") == 10){
            
            /*
             * IF LOGIN USER IS RETAILER
             */
            
            $distributor_id = $this->input->post("distributor_id");
            
            $customer_id_from = $user_id;
            $customer_id_to = $distributor_id;
            $order_taken_by_id = $user_id;
            
            $order_status = 4;
            
            $po_no = NULL;
            
            $order_date = date("Y-m-d");
            
        }
        else if($this->input->post("login_customer_type") == 8){
            
            /*
             * IF LOGIN USER IS FEILD OFFICER
             */
            if($this->input->post("radio1") == "farmer"){
                
                $farmer_id = $this->input->post("farmer_data");
                $retailer_id = $this->input->post("retailer_data");

                $customer_id_from = $farmer_id;
                $customer_id_to = $retailer_id;
                $order_taken_by_id = $user_id;
                
                 $order_date = date("Y-m-d", strtotime($this->input->post("order_date")));
            
            }
            elseif($this->input->post("radio1") == "retailer"){
                
                $distributor_id = $this->input->post("distributor_data");
                $retailer_id = $this->input->post("retailer_data");

                $customer_id_from = $retailer_id;
                $customer_id_to = $distributor_id;
                $order_taken_by_id = $user_id;
                
                $order_date = date("Y-m-d");
                
            }
            elseif($this->input->post("radio1") == "distributor"){
                
                $distributor_id = $this->input->post("distributor_data");
                
                $customer_id_from = $distributor_id;
                $customer_id_to = 0;
                $order_taken_by_id = $user_id;
                
                $order_date = date("Y-m-d");
                
            }
            
            $order_status = 4;
            $po_no = NULL;
            
        }
        else{
        
            /*
             * IF LOGIN USER IS HO
             */
            
            $distributor_id = $this->input->post("distributor_id");
            $retailer_id = $this->input->post("retailer_id");

            if($retailer_id == 0){
                $customer_id_from = $distributor_id;
                $customer_id_to = 0;
                $order_taken_by_id = $user_id;
            }
            else{
                $customer_id_from = $retailer_id;
                $customer_id_to = $distributor_id;
                $order_taken_by_id = $user_id;
            }
            
            $order_status = 4;
            
            $po_no = NULL;
            
            $order_date = date("Y-m-d");
            
        }
        
        $units = $this->input->post("units");
        $product_sku_id = $this->input->post("product_sku_id");
        $quantity = $this->input->post("quantity");
        $Qty = $this->input->post("Qty");
        
        $order_place_data = array(
            'customer_id_from' => $customer_id_from,
            'customer_id_to' => $customer_id_to,
            'order_taken_by_id' => $order_taken_by_id,
            'order_date' => $order_date,
            'order_tracking_no' => mt_rand(100000, 999999),
            'PO_no'=>$po_no,
            'order_status' => $order_status,
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );
        
        
        if ($this->db->insert('bf_ishop_orders', $order_place_data)) {
            $insert_id = $this->db->insert_id();
        }

        $order_id = $insert_id;
        foreach($product_sku_id as $key=>$prd_sku)
        {
           $order_data = array(
                'order_id'=>$order_id,
                'product_sku_id'=>$prd_sku,
                'quantity'=>$quantity[$key],
                'unit'=>$units[$key],
                'quantity_kg_ltr'=>$Qty[$key],
           );
           $this->db->insert('bf_ishop_product_order', $order_data);
        }
        return $order_id;
        
    }
    
    /**
     * @ Function Name		: get_employee_geo_data
     * @ Function Params	: user id, countryid, customertype
     * @ Function Purpose 	: For getting employee geo data
     * @ Function Return 	: Array
     * */
    
    public function get_employee_geo_data($user_id,$country_id,$customer_type,$parent_geo_id=null,$radio_checked=null,$action_data=null,$mobileno=null){

        $main_query_start = "";
        $main_query_end = "";
        $select_data = " bmpgd.political_geo_id, bmpgd.political_geography_name ";
        $sub_query = "";
        

       //$action_data =  $this->uri->segment(2);
       
    //   echo $user_id."===".$country_id."===".$customer_type."===".$parent_geo_id."===".$radio_checked."===".$action_data;
     //  die;
      //  testdata($action_data);
        
       // if($customer_type == 7){
            
      //  }
        
  if($customer_type == 8){
            
            
            if(($action_data == "order_place" || $action_data == "order_status") && $parent_geo_id == null){
            $main_query_start = "SELECT `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
`bmpgd2`.`parent_geo_id` FROM `bf_master_political_geography_details` as bmpgd2
 where `political_geo_id` IN ( ";
         
                
            $main_query_end .= " )";
        
            $select_data = " bmpgd.parent_geo_id ";
            
        } 
        
        if($parent_geo_id != null){
            
            $customer_type = 10;
            $sub_query = " AND bmpgd.parent_geo_id = $parent_geo_id ";
            
        }
        
      $subquery1 =  $main_query_start." SELECT  ".$select_data." FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";
      
      $where1  = " `etc`.`employee_id` = ".$user_id;
      $where2  = " AND YEAR(etc.year) = '".date("Y")."' AND ";
      $where3 = "";
      if($mobileno != null)
      {
          $where3 = " `bmucd`.`primary_mobile_no` = '".$mobileno."' AND ";
      }
      
            
   }
   elseif($customer_type == 7){
       
         
        if($radio_checked == 10 && ($action_data == "order_place" || $action_data == "order_status" ) && $parent_geo_id == null){
            $main_query_start = "SELECT `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
`bmpgd2`.`parent_geo_id` FROM `bf_master_political_geography_details` as bmpgd2
 where `political_geo_id` IN ( ";
         
                
            $main_query_end .= " )";
        
            $select_data = " bmpgd.parent_geo_id ";
            
            
            $subquery1 = $main_query_start." SELECT ".$select_data." FROM `bf_users` as bu";
            $where1  = " ";
            $where2  = " ";
            $where3 = " ";
            
            
        }elseif($parent_geo_id != null){
            
            $customer_type = 10;
            $sub_query = " AND bmpgd.parent_geo_id = $parent_geo_id ";
            
            
            $subquery1 = $main_query_start." SELECT ".$select_data." FROM `bf_users` as bu";
      
            $where1  = " ";
            $where2  = " ";
            $where3 = " ";
            
        }
        else{
        
            $subquery1 = " SELECT ".$select_data." FROM `bf_users` as bu";
            $where1  = " ";
            $where2  = " ";
            $where3 = " ";
            
        }
            
    }
    else{
         $subquery1 =  $main_query_start." SELECT  ".$select_data." FROM (`bf_master_employe_to_customer` as etc)
                       JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";
         
         $where1  = " `etc`.`employee_id` = ".$user_id;
         $where2  = " AND YEAR(etc.year) = '".date("Y")."' AND ";
         
         $where3 = "";
         
        if($mobileno != null)
        {
            $where3 = "AND `bmucd`.`primary_mobile_no` = '".$mobileno;
        }
      
    }
        
        $query1 = $subquery1." JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id` 
JOIN `bf_master_political_geography_details` as bmpgd ON `bmpgd`.`political_geo_id` = `bmucd`.`geo_level_id3`

WHERE ".$where1." ".$where2." ".$where3."

`bu`.`role_id` = ".$radio_checked." 
AND `bu`.`type` = 'Customer' 
AND `bu`.`deleted` = '0' 
AND `bu`.`country_id` = '".$country_id."' ".$sub_query." 
    
GROUP BY `bmpgd`.`political_geography_name` ".$main_query_end;
        
        
        $query = $this->db->query($query1);

        $geo_loc_data =  $query->result_array();
        
      // echo $this->db->last_query();
//die;
        return $geo_loc_data;
        
    }
    
    
    /**
     * @ Function Name		: get_user_for_geo_data
     * @ Function Params	: selected geo id, country id
     * @ Function Purpose 	: For getting user for selected geo location for FO
     * @ Function Return 	: Json
     * */
    
    public function get_user_for_geo_data($selected_geo_id,$country_id,$checked_data,$mobile_no=null) {
            
            if($checked_data == "farmer"){
                
                $selected_type = 11;
                
            }
            else if($checked_data == "retailer"){
                
                 $selected_type = 10;
                
            }
            else if($checked_data == "distributor"){
                
                 $selected_type = 9;
                
            }
        
        $this->db->select('bu.id,bu.display_name,bmupd.first_name,bmupd.middle_name,bmupd.last_name,bmucd.geo_level_id3');
        $this->db->from('bf_users as bu');
        
        $this->db->join('bf_master_user_contact_details as bmucd','bmucd.user_id = bu.id'); // GET GEO FROM HERE FOR CUSTOMER USER
        $this->db->join('bf_master_user_personal_details as bmupd','bmupd.user_id = bu.id'); // FOR GETTING USER NAME AND OTHER DATA
        
        $this->db->where('bmucd.geo_level_id3',$selected_geo_id);
        
        $this->db->where('bu.role_id',$selected_type); // FOR GETTING USER (FARMERS = 11) OF SPECFIC GEO
        
        if($mobile_no != null){
           $this->db->where('bmucd.primary_mobile_no',$mobile_no); // FOR GETTING FARMER OF SPECIFIC MOBILE NUMBER
        }
        
        $this->db->where('bu.type','Customer');
        $this->db->where('bu.deleted','0');
        $this->db->where('bu.country_id',$country_id); //FOR GETTING USER OF SPECFIC COUNTRY
     //   $this->db->where('bu.deleted','0');
        
        $geo_user_data = $this->db->get()->result_array();

       // echo $this->db->last_query();
       // die;
        if(isset($geo_user_data) && !empty($geo_user_data)) {
            return json_encode($geo_user_data);
        } else{
            return 0;
        }
        
    }
    
    
    /**
     * @ Function Name		: get_retailer_for_customer_data
     * @ Function Params	: selected user id
     * @ Function Purpose 	: For getting retailers for selected users (i.e FARMER) FO
     * @ Function Return 	: Json
     * */
    
    function get_retailer_for_customer_data($selected_user_id,$radio_checkedtype,$logincustomerrole){
        
        if($radio_checkedtype == "farmer"){
            
            $role_data = 10;  // If farmer check box checked than to get retailer (role id 10) data
            
        }
        elseif($radio_checkedtype == "retailer"){
            
            $role_data = 9;
            
        }
        
        $this->db->select('bu.id,bmupd.first_name,bmupd.middle_name,bmupd.last_name');
        $this->db->from('bf_master_customer_to_customer_mapping as bmctcm');
        
        $this->db->join('bf_users as bu','bu.id = bmctcm.from_customer_id');
        $this->db->join('bf_master_user_personal_details as bmupd','bmupd.user_id = bu.id'); // FOR GETTING USER NAME AND OTHER DATA
        
        $this->db->where('bmctcm.to_customer_id',$selected_user_id);
        
        $this->db->where('bu.role_id',$role_data); // FOR GETTING USER (RETAILERS = 10) OF SPECIFICE FARMER
        $this->db->where('bu.type','Customer');
        $this->db->where('bu.deleted','0');
        
        $retailer_user_data = $this->db->get()->result_array();
        
        if(isset($retailer_user_data) && !empty($retailer_user_data)) {
            return json_encode($retailer_user_data);
        } else{
            return 0;
        }
        
        
    }
    
    /**
     * @ Function Name		: get_prespective_order
     * @ Function Params	: from date, to date, login userid , login usertype(role id)
     * @ Function Purpose 	: For getting retailers for selected users (i.e FARMER) FO
     * @ Function Return 	: Json
     * */
    
    public function get_prespective_order($from_date,$todate,$loginusertype,$loginuserid) {
        
        $this->db->select('bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.read_status,bio.created_on, bmupd.first_name as from_fname,bmupd.middle_name as from_mname,bmupd.last_name as from_lname, bmucd.primary_mobile_no, bmucd.address ,bmupd1.first_name as ot_from_fname1,bmupd1.middle_name as ot_from_mname1,bmupd1.last_name as ot_from_lname1');
        $this->db->from('bf_ishop_orders as bio');
        
        $this->db->join('bf_users as bu','bu.id = bio.customer_id_from',"LEFT");
        $this->db->join('bf_master_user_personal_details as bmupd','bmupd.user_id = bu.id',"LEFT"); // FOR GETTING USER NAME AND OTHER DATA
        $this->db->join('bf_master_user_contact_details as bmucd','bmucd.user_id = bu.id',"LEFT"); 
        
        $this->db->join('bf_users as u','u.id = bio.order_taken_by_id',"LEFT");
        $this->db->join('bf_master_user_personal_details as bmupd1','bmupd1.user_id = u.id',"LEFT"); // FOR GETTING USER NAME AND OTHER DATA
      
        $this->db->where('bio.order_date >=', $from_date);
        $this->db->where('bio.order_date <=', $todate);
        
        $this->db->where('bio.customer_id_to',$loginuserid);
        $this->db->order_by("order_date", "desc"); 
        
        $prespective_order = $this->db->get()->result_array();
        
      //  echo $this->db->last_query();
        
     //   echo "<pre>";
     //   print_r($prespective_order);//die;
        
        if(isset($prespective_order) && !empty($prespective_order))
        {
            
            if($loginusertype == 9){
                $head_data = "Retailer Name";
            }
            else{
                $head_data = "Farmer Name";
            }
            
            $prespective['head'] =array('Sr. No.','Action','Entered By','PO No','OTN','Date Of Entry',$head_data,'Address','Mobile No.','Read');
            $i=1;
            foreach($prespective_order as $po )
            {
                //$read_status = "";
               // if($loginusertype == 9){
                
                    if($po['read_status'] == 0){
                        $read_status = "<a class='read_".$po['order_id']."' href='javascript:void(0);' onclick = 'mark_as_read(".$po['order_id'].");' >Mark as Read</a>";
                    }
                    else{
                        $read_status = "<a class='unread_".$po['order_id']."'  href='javascript:void(0);'  onclick = 'mark_as_unread(".$po['order_id'].");'>Mark as Unread</a>";
                    }

               // }
              //  else if($loginusertype == 10){
              //  
              //      if($po['read_status'] == 0){
              //          $read_status = "Unread";
              //      }
             //       else{
             //           $read_status = "Read";
              //      }

              //  }
            
                $otn = '<div class="eye_i" prdid ="'.$po['order_id'].'"><a href="javascript:void(0);">'.$po['order_tracking_no'].'</a></div>';
                
                
                $prespective['row'][]= array($i,$po['order_id'],$po['ot_from_fname1']." ".$po['ot_from_mname1']." ".$po['ot_from_lname1'],$po['PO_no'],$otn,date("Y-m-d",strtotime($po['order_date'])),$po['from_fname']." ".$po['from_mname']." ".$po['from_lname'],$po['address'],$po['primary_mobile_no'],$read_status);
                $i++;
            }
            $prespective['eye']=1;
            return $prespective;
        }
       
    }
    
    public function order_product_details_view_by_id($order_id) {
        
        $this->db->select('bipo.product_order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit');
        $this->db->from('bf_ishop_product_order as bipo');
        
        $this->db->join('bf_master_product_sku_country as psc','psc.product_sku_country_id = bipo.product_sku_id',"LEFT");
        $this->db->join('bf_master_product_sku_regional as psr','psr.product_sku_id = psc.product_sku_id',"LEFT");
        
        $this->db->where('bipo.order_id',$order_id);
        
        $prespective_order_details = $this->db->get()->result_array();
        
       // echo "<pre>";
       // print_r($prespective_order_details);
        
        $order_detail = array('result'=>$prespective_order_details);
       // var_dump($product_detail);die;

        if(isset($order_detail['result']) && !empty($order_detail['result']))
        {
            $product_view['head'] =array('Sr. No.','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr');
            $i=1;
            foreach($order_detail['result'] as $od )
            {
                $product_view['row'][]= array($i,$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr']);
                $i++;
            }
            $product_view['eye'] ='';
           // $product_view['pagination'] = $report_details['pagination'];
            return $product_view;
        }
        
    }
    
    public function order_mark_as_read($orderid) {
        
        $read_array = array('read_status'=>1);
       // $this->db->where('order_id', $orderid);
      //  $this->db->update('bf_ishop_orders', $read_array); 
        
        $this->db->update('bf_ishop_orders', $read_array, array('order_id' => $orderid));
        
        return $this->db->affected_rows();
    }
    
    public function order_mark_as_unread($orderid) {
        
        $unread_array = array('read_status'=>0);
        //$this->db->where('order_id', $orderid);
       // $this->db->update('bf_ishop_orders', $unread_array); 
        
         $this->db->update('bf_ishop_orders', $unread_array, array('order_id' => $orderid));
        
        return $this->db->affected_rows();
    }
    
    /*
     * GET ORDER FOR ORDER STATUS
     */
    
    public function get_order_data($loginusertype,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,$order_tracking_no=null) {
        
            $this->db->select('bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.estimated_delivery_date,bio.total_amount,bio.order_status,bio.read_status, bmupd.first_name as ot_fname,bmupd.middle_name as ot_mname,bmupd.last_name as ot_lname,t_bmupd.first_name as to_fname,t_bmupd.middle_name as to_mname,t_bmupd.last_name as to_lname,f_bmupd.first_name as fr_fname,f_bmupd.middle_name as fr_mname,f_bmupd.last_name as fr_lname');
            $this->db->from('bf_ishop_orders as bio');

            $this->db->join('bf_users as bu','bu.id = bio.order_taken_by_id',"LEFT");
            $this->db->join('bf_master_user_personal_details as bmupd','bmupd.user_id = bu.id',"LEFT"); // FOR GETTING USER NAME AND OTHER DATA
            
            //FROM USER DATA
            $this->db->join('bf_users as f_bu','f_bu.id = bio.customer_id_from',"LEFT");
            $this->db->join('bf_master_user_personal_details as f_bmupd','f_bmupd.user_id = f_bu.id',"LEFT");
            
            //TO USER DATA
            $this->db->join('bf_users as t_bu','t_bu.id = bio.customer_id_to',"LEFT");
            $this->db->join('bf_master_user_personal_details as t_bmupd','t_bmupd.user_id = t_bu.id',"LEFT");
            
            if($order_tracking_no != null){
                
                $this->db->where('bio.order_tracking_no',$order_tracking_no);
                
            }
            else{
                    $this->db->where('bio.order_date >=', $from_date);
                    $this->db->where('bio.order_date <=', $todate);
                    $this->db->where('bio.customer_id_from',$customer_id);
            }
            
            $this->db->order_by("bio.order_date", "desc"); 

            $order_data = $this->db->get()->result_array();
            
          //  echo $this->db->last_query();die;
            
            $orderdata = array('result'=>$order_data);
       // var_dump($product_detail);die;

            if(isset($orderdata['result']) && !empty($orderdata['result']))
            {
                
                if($loginusertype == 7){
            
                    //FOR HO

                        $order_view['head'] =array('Sr. No.','Remove','Order Date','PO No.','Order Tracking No.','EDD','Amount','Entered By','Status');

                        $i=1;

                        foreach($orderdata['result'] as $od )
                        {
                            $otn = '<div class="eye_i" prdid ="'.$od['order_id'].'"><a href="javascript:void(0);">'.$od['order_tracking_no'].'</a></div>';

                            $order_view['row'][]= array($i,$od['order_id'],$od['order_date'],$od['PO_no'],$otn,$od['estimated_delivery_date'] ,$od['total_amount'],$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'],$od['order_status']);
                            $i++;
                        }
                        $order_view['eye'] ='';


                   }
                   else if($loginusertype == 8){
            
                        //FOR FO

                        if($radio_checked == "farmer"){
                            
                            $order_view['head'] =array('Sr. No.','','Farmer Name','Retailer Name','Order Tracking No.','Entered By','Read');
                            
                        }
                        elseif($radio_checked == "retailer"){
                            
                            $order_view['head'] =array('Sr. No.','Action','Retailer Code','Retailer Name','Distributor Name','Order Date','PO NO.','Order Tracking No.','EDD','Amount','Entered By', 'Status');
                            
                        }
                        elseif($radio_checked == "distributor"){
                            
                            $order_view['head'] =array('Sr. No.','Action','Distributor Code','Distributor Name','Order Date','PO NO.','Order Tracking No.','EDD','Amount','Entered By', 'Status');
                            
                        }
                        
                        $i=1;

                        foreach($orderdata['result'] as $od )
                        {
                            
                            if($od['read_status'] == 0){
                                $read_status = "<a class='read_".$od['order_id']."' href='javascript:void(0);' onclick = 'mark_as_read(".$od['order_id'].");' >Mark as Read</a>";
                            }
                            else{
                                $read_status = "<a class='unread_".$od['order_id']."'  href='javascript:void(0);'  onclick = 'mark_as_unread(".$od['order_id'].");'>Mark as Unread</a>";
                            }
                            
                            
                            if($od['order_status'] == 0){
                                $order_status = "Pending";
                            }
                            elseif($od['order_status'] == 1){
                                $order_status = "Dispatched";
                            }
                            elseif($od['order_status'] == 2){
                                $order_status = "";
                            }
                            elseif($od['order_status'] == 3){
                                $order_status = "Rejected";
                            }
                            elseif($od['order_status'] == 4){
                                $order_status = "op_ackno";
                            }
                            
                            
                            $otn = '<div class="eye_i" prdid ="'.$od['order_id'].'"><a href="javascript:void(0);">'.$od['order_tracking_no'].'</a></div>';

                            
                            if($radio_checked == "farmer"){
                            
                                $order_view['row'][]= array($i,"",$od['fr_fname']." ".$od['fr_mname']." ".$od['fr_lname'],$od['to_fname']." ".$od['to_mname']." ".$od['to_lname'],$otn,$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'] ,$read_status);
                            
                            }
                            elseif($radio_checked == "retailer"){
                                
                                 $order_view['row'][]= array($i,$od['order_id'],'',$od['fr_fname']." ".$od['fr_mname']." ".$od['fr_lname'],$od['to_fname']." ".$od['to_mname']." ".$od['to_lname'],$od["order_date"],$od["PO_no"],$otn,$od["estimated_delivery_date"],$od["total_amount"],$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'] ,$order_status);
                                
                            }
                            elseif($radio_checked == "distributor"){
                                
                                 $order_view['row'][]= array($i,$od['order_id'],'',$od['fr_fname']." ".$od['fr_mname']." ".$od['fr_lname'],$od["order_date"],$od["PO_no"],$otn,$od["estimated_delivery_date"],$od["total_amount"],$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'] ,$order_status);
                                
                            }
                            
                            $i++;
                        }
                        $order_view['eye'] ='';
                       

                    }
                    else if($loginusertype == 9){

                        //FOR DISTRIBUTOR

                        
                        $order_view['head'] =array('Sr. No.','','Order Date','PO No.','Order Tracking No.','EDD','Amount','Entered By','Status');

                        $i=1;

                        foreach($orderdata['result'] as $od )
                        {
                            
                            if($od['order_status'] == 0){
                                $order_status = "Pending";
                            }
                            elseif($od['order_status'] == 1){
                                $order_status = "Dispatched";
                            }
                            elseif($od['order_status'] == 2){
                                $order_status = "";
                            }
                            elseif($od['order_status'] == 3){
                                $order_status = "Rejected";
                            }
                            elseif($od['order_status'] == 4){
                                $order_status = "op_ackno";
                            }
                            
                            
                            
                            $otn = '<div prdid ="'.$od['order_id'].'"><a class="set_pono" onclick="set_po_no('.$od['order_id'].');" href="javascript:void(0);">'.$od['order_tracking_no'].'</a></div>';
                            
                            $po_no = '<div class="eye_i" prdid ="'.$od['order_id'].'"><a href="javascript:void(0);">'.$od['PO_no'].'</a></div>';

                            $order_view['row'][]= array($i,'',$od['order_date'],$po_no,$otn,$od['estimated_delivery_date'] ,$od['total_amount'],$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'],$order_status);
                            $i++;
                        }
                        $order_view['eye'] ='';
                        
                        

                    }
                    else if($loginusertype == 10){

                        //FOR RETAILER

                        $order_view['head'] =array('Sr. No.','','Distributor Name','Order Date','PO No.','Order Tracking No.','EDD','Amount','Entered By','Status');

                        $i=1;

                        foreach($orderdata['result'] as $od )
                        {
                            
                            if($od['order_status'] == 0){
                                $order_status = "Pending";
                            }
                            elseif($od['order_status'] == 1){
                                $order_status = "Dispatched";
                            }
                            elseif($od['order_status'] == 2){
                                $order_status = "";
                            }
                            elseif($od['order_status'] == 3){
                                $order_status = "Rejected";
                            }
                            elseif($od['order_status'] == 4){
                                $order_status = "op_ackno";
                            }
                            
                            
                            
                            $otn = '<div prdid ="'.$od['order_id'].'"><a class="set_pono" onClick="pop11(popDiv,'.$od['order_id'].');" href="javascript:void(0);">'.$od['order_tracking_no'].'</a></div>';
                            
                            $po_no = '<div class="eye_i" prdid ="'.$od['order_id'].'"><a href="javascript:void(0);">'.$od['PO_no'].'</a></div>';

                            $order_view['row'][]= array($i,'',$od['to_fname']." ".$od['to_mname']." ".$od['to_lname'],$od['order_date'],$po_no,$otn,$od['estimated_delivery_date'] ,$od['total_amount'],$od['ot_fname']." ".$od['ot_mname']." ".$od['ot_lname'],$order_status);
                            $i++;
                        }
                        $order_view['eye'] ='';
                        
                        
                        

                    }
                
               // $product_view['pagination'] = $report_details['pagination'];
                return $order_view;
            }
        
    }
    
    public function order_status_product_details_view_by_id($order_id,$radiochecked,$logincustomertype) {
        
        $this->db->select('bipo.product_order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit,bipo.amount,bipo.dispatched_quantity');
        $this->db->from('bf_ishop_product_order as bipo');
        
        $this->db->join('bf_master_product_sku_country as psc','psc.product_sku_country_id = bipo.product_sku_id',"LEFT");
        $this->db->join('bf_master_product_sku_regional as psr','psr.product_sku_id = psc.product_sku_id',"LEFT");
        
        $this->db->where('bipo.order_id',$order_id);
        
        $order_details = $this->db->get()->result_array();
        
        $order_detail = array('result'=>$order_details);
     
        if(isset($order_detail['result']) && !empty($order_detail['result']))
        {
            
            if($logincustomertype == 7){
            
            
                if($radiochecked == "distributor"){
                    $product_view['head'] =array('Sr. No.','Action','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount','Approved Quantity');

                }
                else
                {
                    $product_view['head'] =array('Sr. No.','Action','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount');
                }


                $i=1;
                foreach($order_detail['result'] as $od )
                {

                    $unit_data = '<div class="unit_'.$od["product_order_id"].'"><span class="unit">'.$od['unit'].'</span></div>';
                    $qty_data = '<div class="qty_'.$od["product_order_id"].'"><span class="qty">'.$od['quantity'].'</span></div>';
                    $quantity_kg_ltr = '<div class="quantity_kg_ltr_'.$od["product_order_id"].'"><span class="quantity_kg_ltr">'.$od['quantity_kg_ltr'].'</span></div>';
                    $amount = '<div class="amount_'.$od["product_order_id"].'"><span class="amount">'.$od['amount'].'</span></div>';
                    
                    $dispatched_quantity = '<div class="dispatched_quantity_'.$od["product_order_id"].'"><span class="dispatched_quantity">'.$od['dispatched_quantity'].'</span></div>';
                    
                    
                    if($radiochecked == "distributor"){

                        $product_view['row'][]= array($i,$od['product_order_id'],$od['product_sku_code'],$od['product_sku_name'],$unit_data,$qty_data ,$quantity_kg_ltr,$amount,$dispatched_quantity);

                    }
                    else{

                        $product_view['row'][]= array($i,$od['product_order_id'],$od['product_sku_code'],$od['product_sku_name'],$unit_data,$qty_data ,$quantity_kg_ltr,$amount);

                    }
                    $i++;
            }
            $product_view['eye'] ='';
           
            
        }
        elseif($logincustomertype == 8){
            
            
                if($radiochecked == "farmer"){
                    $product_view['head'] =array('Sr. No.',"",'Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr');

                }
                elseif($radiochecked == "retailer"){
                    $product_view['head'] =array('Sr. No.','Action','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount','Approved Quantity');

                }
                elseif($radiochecked == "distributor")
                {
                    $product_view['head'] =array('Sr. No.','Action','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount','Approved Quantity');
                }


                $i=1;
                foreach($order_detail['result'] as $od )
                {

                    if($radiochecked == "farmer"){

                        $product_view['row'][]= array($i,"",$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr']);

                    }
                    elseif($radiochecked == "retailer"){

                        $product_view['row'][]= array($i,$od['product_order_id'],$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr'],$od['amount'],$od['dispatched_quantity']);

                    }
                    elseif($radiochecked == "distributor"){

                        $product_view['row'][]= array($i,$od['product_order_id'],$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr'],$od['amount'],$od['dispatched_quantity']);

                    }
                    $i++;
            }
            $product_view['eye'] ='';
            
        }
        elseif($logincustomertype == 9){
            
                $product_view['head'] =array('Sr. No.','','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount','Approved Quantity');

                $i=1;
                foreach($order_detail['result'] as $od )
                {

                        $product_view['row'][]= array($i,'',$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr'],$od['amount'],$od['dispatched_quantity']);

                    $i++;
            }
            $product_view['eye'] ='';
           
        }
        elseif($logincustomertype == 10){
            
                $product_view['head'] =array('Sr. No.','','Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Amount');

                $i=1;
                foreach($order_detail['result'] as $od )
                {

                        $product_view['row'][]= array($i,'',$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'] ,$od['quantity_kg_ltr'],$od['amount']);

                    $i++;
            }
            $product_view['eye'] ='';
           
        }
        
            
            return $product_view;
        }
        
    }
    
  }
