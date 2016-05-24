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
        
        echo "<pre>";
        print_r($_POST);
        
        
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
            
            $customer_id_from = $distributor_id;
            $customer_id_to = 0;
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
            
            }
            elseif($this->input->post("radio1") == "retailer"){
                
                $distributor_id = $this->input->post("distributor_data");
                $retailer_id = $this->input->post("retailer_data");

                $customer_id_from = $retailer_id;
                $customer_id_to = $distributor_id;
                $order_taken_by_id = $user_id;
                
            }
            elseif($this->input->post("radio1") == "distributor"){
                
                $distributor_id = $this->input->post("distributor_data");
                
                $customer_id_from = $distributor_id;
                $customer_id_to = 0;
                $order_taken_by_id = $user_id;
                
            }
            
            
            
            $order_status = 4;
            
            $po_no = NULL;
            
            $order_date = date("Y-m-d", strtotime($this->input->post("order_date")));
            
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
    
    public function get_employee_geo_data($user_id,$country_id,$customer_type,$parent_geo_id=null,$radio_checked=null,$action_data=null){

        $main_query_start = "";
        $main_query_end = "";
        $select_data = " * ";
        $sub_query = "";
        
        

       //$action_data =  $this->uri->segment(2);
       
     //  echo $user_id."===".$country_id."===".$customer_type."===".$parent_geo_id."===".$radio_checked."===".$action_data;
       
      //  testdata($action_data);
        if($radio_checked == 10 && $action_data == "order_place" && $parent_geo_id == null){
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
        
        $query1 = $main_query_start." SELECT  ".$select_data." FROM (`bf_master_employe_to_customer` as etc) 

JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` 
JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id` 
JOIN `bf_master_political_geography_details` as bmpgd ON `bmpgd`.`political_geo_id` = `bmucd`.`geo_level_id3`


WHERE `etc`.`employee_id` = $user_id 

AND YEAR(etc.year) = '".date("Y")."' 
AND `bu`.`role_id` = ".$radio_checked." 
AND `bu`.`type` = 'Customer' 
AND `bu`.`deleted` = '0' 
AND `bu`.`country_id` = '".$country_id."' ".$sub_query." 
    
GROUP BY `bmpgd`.`political_geography_name` ".$main_query_end;
        
        
        $query = $this->db->query($query1);

        $geo_loc_data =  $query->result_array();
        
  //    echo  $this->db->last_query();
       
     // echo "<pre>";
      //print_r($geo_loc_data);
      
    /*    
        $this->db->select('*');

        $this->db->from('bf_master_employe_to_customer as etc');
        $this->db->join('bf_users as bu','bu.id = etc.customer_id');
        $this->db->join('bf_master_user_contact_details as bmucd','bmucd.user_id = bu.id'); // GET GEO FROM HERE FOR CUSTOMER USER
        $this->db->join('bf_master_political_geography_details as bmpgd','bmpgd.political_geo_id = bmucd.geo_level_id3');
        $this->db->where('etc.employee_id',$user_id);
        $this->db->where('YEAR(etc.year)',date("Y"));

        $this->db->where('bu.role_id',$customer_type);
        $this->db->where('bu.type','Customer');
        $this->db->where('bu.deleted','0');
        $this->db->where('bu.country_id',$country_id);
        $this->db->group_by("bmpgd.political_geography_name");
        
        
        $geo_loc_data=$this->db->get()->result_array();

     // echo  $this->db->last_query();die;

        */
      // echo $this->db->last_query();
       
      // die;
        

        return $geo_loc_data;
        
    }
    
    /**
     * @ Function Name		: get_user_for_geo_data
     * @ Function Params	: selected geo id, country id
     * @ Function Purpose 	: For getting user for selected geo location for FO
     * @ Function Return 	: Json
     * */
    
    public function get_user_for_geo_data($selected_geo_id,$country_id,$checked_data) {
            
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
    
}
