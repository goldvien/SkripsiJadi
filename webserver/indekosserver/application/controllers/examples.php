<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login_status')!= TRUE)
        {
			$this->load->helper('url');
            redirect('loginManager');
        }
		else
		{
		$this->load->model('pos_model');
		$this->load->model('inquiry_model');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('file');
		}
	}
	
	function _example_output($output = null)
	{
		$this->load->view("header");
		$this->load->view('example.php',$output);	
	}

	function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	
	function offices_management()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_office');
			$crud->set_subject('Kantor Cabang');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function ref_jenis_biaya()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_jenis_biaya');
			$crud->set_subject('Jenis Biaya');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
		function ref_wilayah()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_wilayah');
			$crud->set_subject('Wilayah');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_propinsi()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_propinsi');
			$crud->set_subject('Propinsi');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_bentuk_kerjasama()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_bentuk_kerjasama');
			$crud->set_subject('Bentuk Kerjasama');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

		function ref_barang()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_barang');
			$crud->set_subject('Referensi Barang');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_shift()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_shift');
			$crud->set_subject('Shift');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_roles()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_roles');
			$crud->set_subject('Roles');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_jenis_karyawan()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_jenis_karyawan');
			$crud->set_subject('Jenis Karyawan');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
		function ref_barang_inventaris()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_barang_inventaris');
			$crud->set_subject('Barang Inventaris');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function ref_supplier()
	{

			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('ref_supplier');
			$crud->set_subject('Supplier');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('mst_karyawan');
			
			$crud->set_subject('Data Karyawan');

			$output = $crud->render();

		
			$this->_example_output($output);
	}
	
	function get_super()
	{
		$countryID = $this->uri->segment(3);
		
		$this->db->select("*")
				 ->from('KARYAWAN')
				 ->where('ID_JABATAN', $countryID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("value" => $row->ID_SALESMAN, "property" => $row->NAMA);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	function customers_management()
	{

		
			$crud = new grocery_CRUD();
	
			$crud->set_theme('datatables');
			$crud->set_table('pelanggan');
			$crud->unset_columns('KABUPATEN','KODE_POS','TGL_LAHIR','NO_TLP_RUMAH','NO_TLP_HP','TLP_KANTOR','FAX');
			$crud->set_subject('Data Pelanggan');

			
			$output = $crud->render();
			
			$this->_example_output($output);
	}	
	function user_management()
	{

		
			$crud = new grocery_CRUD();
	
			$crud->set_theme('datatables');
			$crud->set_table('mst_pengguna');
			$crud->set_subject('Data Pengguna	');

			
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	
	function orders_management()
	{
			
			$this->config->set_item('url_suffix', '');
			$crud = new grocery_CRUD();
			$crud->set_model('users_join');
			$crud->set_theme('datatables');
			$crud->set_table('inquiry_card','spk','sales_order','leasing');
		//	$this->load->model('inquiry_model');
		//	$this->inquiry_model->join_spk('inquiry_card','spk');
			$crud->display_as('ID_INQUIRY','No Inquiry');
			$crud->columns('ID_INQUIRY','TGL_INQUIRY','TGL_INQUIRY_LAST','ID_OUTLET','ID_JABATAN','ID_SALESMAN','ID_PELANGGAN','ID_DATA','LAST_PROGRESS','ID_TYPE','ID_WARNA','SISTEM_PENJUALAN','TGL_SPK','NILAI_SPK','PEMBAYARAN','NAMA_LEASING','TGL_SO');
		//	$crud->set_relation_n_n('LEASING','spk','leasing','id_inquiry','ID_LEASING','nama_leasing');
			$crud->display_as('ID_LEASING','LEASING');
			$crud->set_relation('ID_OUTLET','outlet','{nama_outlet}');
			$crud->display_as('ID_OUTLET','CABANG');
			$crud->set_relation('ID_JABATAN','karyawan','{nama}',array('ID_JABATAN' => '6'));
			$crud->display_as('ID_JABATAN','SUPERVISOR');
			$crud->set_relation('ID_SALESMAN','karyawan','{nama}');
			$crud->display_as('ID_SALESMAN','SALESMAN');
			$crud->set_relation('ID_PELANGGAN','pelanggan','{nama}');
			$crud->display_as('ID_PELANGGAN','NAMA PELANGGAN');
			$crud->set_relation('ID_DATA','perolehan_data','{data}');
			$crud->display_as('ID_DATA','PEROLEHAN DATA');
			$crud->set_relation('ID_TYPE','type','{type}');
			$crud->display_as('ID_TYPE','TYPE MOTOR');
			$crud->set_relation('ID_WARNA','warna','{warna}');
			$crud->display_as('ID_WARNA','WARNA MOTOR');
	//		$this->pos_model->join_table('inquiry_card','spk');
    //$crud->set_relation('ID_SPK','inquiry_card','{ID_SPK}','(select ID_SPK from spk, inquiry_card i where spk.id_inquiry=i.inquiry_card )');
			//	$crud->set_relation('ID_SPK','spk','{TGL_SPK}');
			$crud->set_subject('Inquiry Card');
			$output = $crud->render();
			
	//		$crud->callback_add_field('ID_SALESMAN', array($this, 'empty_state_dropdown_select'));
	//		$crud->callback_edit_field('ID_SALESMAN', array($this, 'empty_state_dropdown_select'));
			
			$dd_data = array(
				//GET THE STATE OF THE CURRENT PAGE - E.G LIST | ADD
				'dd_state' =>  $crud->getState(),
				//SETUP YOUR DROPDOWNS
				//Parent field item always listed first in array, in this case countryID
				//Child field items need to follow in order, e.g stateID then cityID
				'dd_dropdowns' => array('ID_JABATAN','ID_SALESMAN'),
				//SETUP URL POST FOR EACH CHILD
				//List in order as per above
				'dd_url' => array('', site_url().'/examples/get_sales/'),
				//LOADER THAT GETS DISPLAYED NEXT TO THE PARENT DROPDOWN WHILE THE CHILD LOADS
				'dd_ajax_loader' => base_url().'ajax-loader.gif'
			);
			
			$output->dropdown_setup = $dd_data;
			
			$this->_example_output($output);
	}
	//CALLBACK FUNCTIONS
	function empty_state_dropdown_select()
	{
		//CREATE THE EMPTY SELECT STRING
		$empty_select = '<select name="ID_SALESMAN" class="chosen-select" data-placeholder="Select State/Province" style="width: 300px; display: none;">';
		$empty_select_closed = '</select>';
		//GET THE ID OF THE LISTING USING URI
		$listingID = $this->uri->segment(4);
		
		//LOAD GCRUD AND GET THE STATE
		$crud = new grocery_CRUD();
		$state = $crud->getState();
		
		//CHECK FOR A URI VALUE AND MAKE SURE ITS ON THE EDIT STATE
		if(isset($listingID) && $state == "edit") {
			//GET THE STORED STATE ID
			$this->db->select("ID_JABATAN,ID_SALESMAN")
				 ->from('INQUIRY_CARD') 
				 ->where('ID_INQUIRY', $listingID);
			$db = $this->db->get();
			$row = $db->row(0);
			$countryID = $row->ID_JABATAN;
			$stateID = $row->ID_SALESMAN;
			
			//GET THE STATES PER COUNTRY ID
			$this->db->select("*")
				 ->from('KARYAWAN') 
				 ->where('ID_SUPERVISOR', $countryID);
			$db = $this->db->get();
			
			//APPEND THE OPTION FIELDS WITH VALUES FROM THE STATES PER THE COUNTRY ID
			foreach($db->result() as $row):
				if($row->ID_SALESMAN == $stateID) {
					$empty_select .= '<option value="'.$row->ID_SALESMAN.'" selected="selected">'.$row->NAMA.'</option>';
				} else {
					$empty_select .= '<option value="'.$row->ID_SALESMAN.'">'.$row->NAMA.'</option>';
				}
			endforeach;
			
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;
		} else {
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;	
		}
	}
	//GET JSON OF STATES
	function get_sales()
	{
		$countryID = $this->uri->segment(3);
		
		$this->db->select("*")
				 ->from('KARYAWAN') 
				 ->where('ID_SUPERVISOR', $countryID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("value" => $row->ID_SALESMAN, "property" => $row->NAMA);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	function log_user_after_insert($post_array,$primary_key)
	{
	$user = $this->db->get('inquiry_card')->row();
    $user_logs_insert = array(
		"ID_INQUIRY" =>  $primary_key,
        "TGL_INQUIRY_LAST" => date('Y-m-d'),
    
	);
	$this->db->where('ID_INQUIRY',array('ID_INQUIRY' => $primary_key));
    $this->db->update('inquiry_card',$user_logs_insert );
 
    return true;
}
		function followup_management()
	{
			$crud = new grocery_CRUD();


			$crud->set_theme('datatables');
			$crud->set_table('follow_up');
			$crud->set_subject('Follow Up');

			$crud->set_relation('ID_INQUIRY','inquiry_card','{ID_INQUIRY}');
			$crud->display_as('ID_INQUIRY','NO INQUIRY');
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	
	function lostcase_management()
	{
			$crud = new grocery_CRUD();


			$crud->set_theme('datatables');
			$crud->set_table('lost_case');
			$crud->set_subject('Lost Case');
			$crud->set_relation('ID_INQUIRY','inquiry_card','{ID_INQUIRY}','ID_INQUIRY IN (select ID_INQUIRY from inquiry_card where LAST_PROGRESS = "Hot Prospect" OR LAST_PROGRESS = "Prospect" OR LAST_PROGRESS = "SPK")');
			$crud->display_as('ID_INQUIRY','NO INQUIRY');
			$crud->display_as('ID_KET_LOSTCASE','Lost Case');
			$crud->display_as('ID_DETAIL_LOSTCASE','Detail Lost Case');
			$crud->set_relation('ID_KET_LOSTCASE','KET_LOST_CASE','{KET_LOST_CASE}');
			$crud->set_relation('ID_DETAIL_LOSTCASE','DETAIL_LOST_CASE','{DETAIL_LOST_CASE}');
			$output = $crud->render();
			$crud->callback_add_field('ID_DETAIL_LOSTCASE', array($this, 'empty_lost_dropdown_select'));
			$crud->callback_edit_field('ID_DETAIL_LOSTCASE', array($this, 'empty_lost_dropdown_select'));
			//DEPENDENT DROPDOWN SETUP
			$dd_data = array(
				//GET THE STATE OF THE CURRENT PAGE - E.G LIST | ADD
				'dd_state' =>  $crud->getState(),
				//SETUP YOUR DROPDOWNS
				//Parent field item always listed first in array, in this case countryID
				//Child field items need to follow in order, e.g stateID then cityID
				'dd_dropdowns' => array('ID_KET_LOSTCASE','ID_DETAIL_LOSTCASE'),
				//SETUP URL POST FOR EACH CHILD
				//List in order as per above
				'dd_url' => array('', site_url().'/examples/get_states/'),
				//LOADER THAT GETS DISPLAYED NEXT TO THE PARENT DROPDOWN WHILE THE CHILD LOADS
				'dd_ajax_loader' => base_url().'ajax-loader.gif'
			);
			
			$output->dropdown_setup = $dd_data;
			
			$this->_example_output($output);
	}
	
	//CALLBACK FUNCTIONS
	function empty_lost_dropdown_select()
	{
		//CREATE THE EMPTY SELECT STRING
		$empty_select = '<select name="stateID" class="chosen-select" data-placeholder="Select State/Province" style="width: 300px; display: none;">';
		$empty_select_closed = '</select>';
		//GET THE ID OF THE LISTING USING URI
		$listingID = $this->uri->segment(4);
		
		//LOAD GCRUD AND GET THE STATE
		$crud = new grocery_CRUD();
		$state = $crud->getState();
		
		//CHECK FOR A URI VALUE AND MAKE SURE ITS ON THE EDIT STATE
		if(isset($listingID) && $state == "edit") {
			//GET THE STORED STATE ID
			$this->db->select('countryID, stateID')
					 ->from('customers')
					 ->where('customerNumber', $listingID);
			$db = $this->db->get();
			$row = $db->row(0);
			$countryID = $row->countryID;
			$stateID = $row->stateID;
			
			//GET THE STATES PER COUNTRY ID
			$this->db->select('*')
					 ->from('state')
					 ->where('countryID', $countryID);
			$db = $this->db->get();
			
			//APPEND THE OPTION FIELDS WITH VALUES FROM THE STATES PER THE COUNTRY ID
			foreach($db->result() as $row):
				if($row->state_id == $stateID) {
					$empty_select .= '<option value="'.$row->state_id.'" selected="selected">'.$row->state_title.'</option>';
				} else {
					$empty_select .= '<option value="'.$row->state_id.'">'.$row->state_title.'</option>';
				}
			endforeach;
			
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;
		} else {
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;	
		}
	}
	
	//GET JSON OF STATES
	function get_states()
	{
		$countryID = $this->uri->segment(3);
		
		$this->db->select("*")
				 ->from('DETAIL_LOST_CASE')
				 ->where('ID_KET_LOSTCASE', $countryID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("value" => $row->ID_DETAIL_LOST_CASE, "property" => $row->DETAIL_LOST_CASE);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	function spk_management()
	{
			$crud = new grocery_CRUD();


			$crud->set_theme('datatables');
			$crud->set_table('spk');
			$crud->set_subject('SPK');
			$crud->set_relation('ID_INQUIRY','inquiry_card','{ID_INQUIRY}','ID_INQUIRY IN (select ID_INQUIRY from inquiry_card where LAST_PROGRESS = "Hot Prospect" OR LAST_PROGRESS = "Prospect")');
			$crud->display_as('ID_INQUIRY','NO INQUIRY');
			$crud->unset_edit_fields('ID_INQUIRY');
			$crud->set_relation('ID_LEASING','LEASING','{NAMA_LEASING}');
			$crud->display_as('ID_LEASING','LEASING');
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	
	function salesorder_management()
	{
			$crud = new grocery_CRUD();


			$crud->set_theme('datatables');
			$crud->set_table('sales_order');
			$crud->set_subject('Sales Order');
			$crud->set_relation('ID_INQUIRY','inquiry_card','{ID_INQUIRY}','ID_INQUIRY IN (select ID_INQUIRY from inquiry_card where LAST_PROGRESS = "SPK")');
			$crud->display_as('ID_INQUIRY','NO INQUIRY');

			$output = $crud->render();
			
			$this->_example_output($output);
	}
	function leasing_management()
	{
			$crud = new grocery_CRUD();
	
			$crud->set_theme('datatables');
			$crud->set_table('leasing');
			$crud->set_subject('Leasing');

			
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	function products_management()
	{
			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('type');
			$crud->set_subject('Product');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	function WARNA_management()
	{

		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('warna');
			$crud->set_subject('Warna Motor');

			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output = $crud->render();
		
		$this->_example_output($output);
	}
	
	function film_management2()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('film');
		$crud->columns('title', 'description', 'actors' ,  'category');

		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title','category');
		
		$output = $crud->render();
		
		$this->_example_output($output);
		
		//////////////////////////////////////////////
		$crud2 = new grocery_CRUD();
		
		$crud2->set_table('film');
		$crud2->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud2->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud2->unset_columns('special_features','description','actors');
		
		$crud2->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output2 = $crud2->render();
		
		$this->_example_output2($output2);
	}
	
	function pegawai_management()
	{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('pegawai');

			
			$output = $crud->render();

			$this->_example_output($output);
	}
	
	function add_field_callback_1()
{
    return '0274 - <input type="text" maxlength="50" value="" name="NO_TLP_RUMAH" style="width:462px">';
}

}