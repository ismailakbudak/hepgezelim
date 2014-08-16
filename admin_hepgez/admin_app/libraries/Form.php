<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DEVELOPER İsmail AKBUDAK 
 * Form Libraries
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class CI_Form {
    
    // global variables
	protected $CI;
    public $result = TRUE;
    public $method = FALSE;
    public $name = "";
    public $param = "";

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
        
		// sunucuda zaman geri olduğu için
        date_default_timezone_set('Europe/Istanbul');  

		// Automatically load the form helper
		$this->CI->load->helper('form');

		// Set the character encoding in MB.
		if (function_exists('mb_internal_encoding'))
		{
			mb_internal_encoding($this->CI->config->item('charset'));
		}

		log_message('debug', "Form Validation Class Initialized");
	}

	 /**
	  * check Post elements methods
      *  @parameter field appear name, $field name , $rules
      *  @output no
     **/
     public function check($apname, $field, $rules = ''){
        if( $this->result){                                                                      // if previous result is true                                                           
        	        $this->name = $apname;                                                       // for error message appears field name
			        $this->param = "";                                                           // param is in the begining null
			        $rules = explode('|', $rules);                                               // our rules
			        
			        foreach ($rules as $function) {												 // methods							
			        	  $function = trim($function); 
			              if( strcmp( $function, "") == 0 )                                      // if there is no function return back
			                  continue;

			              $fields = FALSE;
			              preg_match("/(.*?)\[(.*)\]/", $function, $fields);                      // is there a  this character []
			              if( $fields ){                                                          // is there second field  
			                  $function = $fields[1];  											  // post parameter name
			                  $field2 =  $fields[2];                                              // value for post parameter like  email length[50]
			                  if(method_exists($this, $function))
			                       $this->result =  $this->$function(  $_POST[$field], $field2 ); // call function
			                  else{
                                   $this->result  = FALSE;
                                   $function = "funcion_exist"; 								  // error name 
			                  }
			                  $this->param = $field2; 											  // this is for second parameter 
			              }
			              else{
			              	   if(method_exists($this, $function)){
			                       if( strcmp("xss_clean",  $function) != 0 )
			                           $this->result =  $this->$function( $_POST[$field] ); 	  // call function
			                       else
			                            $_POST[$field] = $this->$function( $_POST[$field] ); 	  // call function for xss_clean
			                   }
			                   else{
                                   $this->result  = FALSE;
                                   $function = "funcion_exist";  								  // error name
			                   }   
			              }
			              if( $this->result  == FALSE){
			              	  $this->method = $function;                                          // last using method name
			                  break;   
			              }  
			        }
		 }	        
     }
     
     /**
	  *  After control what is the result
      *  @parameter no
      *  @output result of rules true, false
     **/
     public function get_result(){
     	  return $this->result;     // general result for rules
     }
     
     /**
	  *  return Array() errors
      *  @parameter no
      *  @output array
     **/
     public function get_error(){
     	   $this->CI->lang->load('form_validation'); 
     	   return   Array( 'message' => sprintf( lang($this->method), $this->name, $this->param )   ); // special message from language file
     }
     
     //---------------------------------------------------------------------
     

    /**
	 * date_check Between start and end dates is there any real date check it
	 *
	 * @access	public
	 * @param	dates
	 * @return	array
	 */
     public function date_check(  $start, $end, $round_trip , $daysDeparture , $daysReturn  ){
     	    $this->CI->lang->load('form_validation'); 
     	    $currentDate = strtotime(date('d-m-Y H:i:s'));
            $startDate = strtotime(  $start  ) ; 
            $endDate   = strtotime( $end );       
            $startDate = ( $currentDate > $startDate ) ? $currentDate : $startDate;
            $dateDeparture = array();
            $dateReturn = array();
            while($startDate <= $endDate   )
            {  
                 $day =  date_format(date_create( date('d-m-Y', $startDate)  ), ' l ') ;
                 $day = enToTr( trim($day), "tr" );   
                 $departure_days = explode("?", $daysDeparture);
                 foreach ($departure_days as $value) {
                      if(  strcmp( trim( $value ) , $day) == 0  ){
                          $dateDeparture[] =   array('date' => date('Y-m-d', $startDate) , 'is_return' => 0 );
                      } 
                 }
                 if( $round_trip == "true" ){
                      $return_days = explode("?", $daysReturn);
                      foreach ($return_days as $value) {
                           if(  strcmp( trim( $value ) , $day) == 0  ){
                               $dateReturn[] =   array('date' => date('Y-m-d', $startDate) , 'is_return' => 1 );
                           } 
                      }
                 }

                $startDate += ( 24 * 3600); // add 1 day
            }
            $result = array_merge($dateDeparture, $dateReturn); 
            
            if( count( $dateDeparture ) == 0 ){
            	 $this->result = FALSE;
                 $this->method = "date_departure";
                 $this->name   = lang("gf.departure");
                 $this->param  = lang("gf.departure");
                 $result = array();
            }
            if(  $round_trip && $round_trip == "true" && count($dateReturn) == 0 ){
                 $this->result = FALSE;
                 $this->method = "date_return";
                 $this->name   = lang("gf.return");
                 $this->param  = lang("gf.return");
                 $result = array();
            } 
            return $result;
     }

    /**
	 * date_check Between start and end dates is there any real return date check it
	 *
	 * @access	public
	 * @param	dates
	 * @return	array
	 */
     public function date_check_return(  $start, $end, $daysReturn  ){
     	    $this->CI->lang->load('form_validation');
			
     	    $currentDate = strtotime(date('d-m-Y H:i:s'));
            $startDate = strtotime(  $start  ) ; 
            $endDate   = strtotime( $end );       
            $startDate = ( $currentDate > $startDate ) ? $currentDate : $startDate;
            $dateReturn = array();
            while($startDate <= $endDate  )
            {  
                 $day =  date_format(date_create( date('d-m-Y', $startDate)  ), ' l ') ;
                 $day = enToTr( trim($day), "tr" );   
                 $return_days = explode("?", $daysReturn);
                 foreach ($return_days as $value) {
                      if(  strcmp( trim( $value ) , $day) == 0  ){
                          $dateReturn[] =   array('date' => date('Y-m-d', $startDate) , 'is_return' => 1 );
                      } 
                 }
                 $startDate += ( 24 * 3600); // add 1 day
            }
            if( count($dateReturn) == 0 ){
                 $this->result = FALSE;
                 $this->method = "date_return";
                 $this->name   = lang("gf.return");
                 $this->param  = lang("gf.return");
            } 
            return $dateReturn;
     }

	/**
	 * date_compare
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function date_compare($date1, $date2, $field1, $field2 ){ 
         $daparture_date = strtotime($date1);  
         $now = strtotime(date('Y-m-d H:i:s'));
         if( $now < $daparture_date ){
              $diff = strtotime($date2) - strtotime($date1);
              $result = $diff >  59 * 60 ?  1 : 0;  
              if($result){
                  $this->result = TRUE; 
              	 return TRUE;
              }	 
              else{
               	  $this->result = FALSE;
                  $this->method = "date_compare";
                  $this->name   = $field2;
                  $this->param  = $field1;
                  return FALSE;
              }
         } 
         else{
                  $this->result = FALSE;
                  $this->method = "date_compare_small";
                  $this->name   = $field1;
                  $this->param  = $field2;
                  return FALSE;
         }
              	
              
    } 

	// --------------------------------------------------------------------

	/**
	 * Required
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function required($str)
	{
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}
    
    /**
	 * check_array
	 *
	 * @access	public
	 * @param	dizi
	 * @return	bool
	 */
	public function check_array($dizi)
	{
		if ( is_array($dizi))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------
    
	 
	 /**
	 *  check names
	 *
	 * @access	public
	 * @param	$origin
	 * @param	$destination
	 * @param	$ways
	 * @return	bool
	 */
	public function check_names($origin,$destination,$ways)
	{
		 //$this->CI->lang->load('form_validation');
		 
		 $origin      = trim( $_POST[$origin] );
		 $destination = trim( $_POST[$destination] );
		 $way_points  = trim( $_POST[$ways] );
		 
		 // is there any way points
		
		 if( strcmp($way_points, "") != 0 ){
		 	 $way_points = explode('?', $way_points);
			 if( count($way_points) > 0 ){
			 	  
				  // origin ve destination kontrol et
			      if( strcmp($origin, $destination) == 0 ){
			 	     $this->result = FALSE;
	                 $this->method = "check_names";
	                 $this->name   = "";
	                 $this->param  = "";
				  }
				  else{
				  	   foreach ($way_points as  $way ) {
						     $way = trim($way);
						   	 // origin ve destination kontrol et
						     if( strcmp($origin, $way) == 0 || strcmp($destination, $way) == 0 ){
						 	     $this->result = FALSE;
				                 $this->method = "check_names";
				                 $this->name   = "";
				                 $this->param  = "";
								 break;
							 }else{
							 	 // herşey yolunda
							 	 $this->result = TRUE;
							 }  
				       }   
				  } 
			 }else{
			 	 // hata var
			 	 $this->result = FALSE;
                 $this->method = "check_names";
                 $this->name   = "";
                 $this->param  = "";
			 }  
		 }
		 else{
		 	  // sadece origin ve destination karşilaştır
		 	  if( strcmp($origin, $destination) == 0 ){
		 	     $this->result = FALSE;
                 $this->method = "check_names";
                 $this->name   = "";
                 $this->param  = "";
			  }
			  else{
			  	  // herşey yolunda
			  	  $this->result = TRUE;   
			  }
		 }
		  
	}

	// --------------------------------------------------------------------
	
	
	/**
	 * is_day
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_day($str){

		$days = array(  "Pazartesi" ,  
                        "Salı"      ,  
                        "Çarşamba"  ,  
                        "Perşembe"  ,  
                        "Cuma"      ,  
                        "Cumartesi" ,  
                        "Pazar"      );
		$array = explode('?', $str);
		if( count($array) == 0)
			 return TRUE;

		foreach ($array as $value) {
		     if( strcmp("", trim($value)) == 0)
		    	 continue;

			 $result = FALSE;
		     foreach ($days as $day) {
		            if( strcmp( trim($value) , $day ) == 0 ){
		            	   $result = TRUE;
		            	   break;
		            }	   
		     }
		     if( ! $result )
		     	 return FALSE;
		 }

		 return TRUE;   
	}
	
	
	//---------------------------------------------------------------------
    /**
	 * is_time
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
    public function is_time($str){
        $format = 'H:i';
        $d = DateTime::createFromFormat($format, $str);
        $result = $d && $d->format($format) == $str;
        return $result ?  1 : 0;
    }
    
    //---------------------------------------------------------------------
    /**
	 * is_date
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
    public function is_date($str){
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $str);
        $result = $d && $d->format($format) == $str;
        return $result ?  1 : 0;
    }

	// --------------------------------------------------------------------

	/**
	 * Performs a waypoints_match Expression match test.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function waypoints_match($str)
	{
		if( strcmp(trim($str), "") == "" )
		    return TRUE;
        
        if ( ! preg_match('/^([a-z0-9?.,\/öçişğüı ÖÇŞİĞÜI])+$/i', $str))
		{
			return FALSE;
		}

		return  TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Performs a Regular Expression match test.
	 *
	 * @access	public
	 * @param	string
	 * @param	regex
	 * @return	bool
	 */
	public function regex_match($str, $regex)
	{
		if( strcmp(trim($str), "") == "" )
		    return TRUE;
       
        if ( ! preg_match($regex, $str))
		{
			return FALSE;
		}

		return  TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	public function matches($str, $field)
	{
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$field = $_POST[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	public function is_unique($str, $field)
	{
		list($table, $field)=explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		
		return $query->num_rows() === 0;
    }

	// --------------------------------------------------------------------

	/**
	 * Minimum Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function min_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) < $val) ? FALSE : TRUE;
		}

		return (strlen($str) < $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Max Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function max_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) > $val) ? FALSE : TRUE;
		}

		return (strlen($str) > $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Exact Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	public function exact_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) != $val) ? FALSE : TRUE;
		}

		return (strlen($str) != $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Email
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Emails
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}

		foreach (explode(',', $str) as $email)
		{
			if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate IP Address
	 *
	 * @access	public
	 * @param	string
	 * @param	string "ipv4" or "ipv6" to validate a specific ip format
	 * @return	string
	 */
	public function valid_ip($ip, $which = '')
	{
		return $this->CI->input->valid_ip($ip, $which);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		return ( ! preg_match("/^([a-zçığüşöÇIĞÜŞÖİ ])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric($str)
	{
		return ( ! preg_match("/^([a-z0-9çığüşöÇIĞÜŞÖİ])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		return ( ! preg_match("/^([-a-z0-9_-çığüşöÇIĞÜŞÖİ])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}

	// --------------------------------------------------------------------

	/**
	 * Is Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_numeric($str)
	{
		return ( ! is_numeric($str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Decimal number
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Greather than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function greater_than($str, $min)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str > $min;
	}

	// --------------------------------------------------------------------

	/**
	 * Less than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function less_than($str, $max)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str < $max;
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number  (0,1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_natural($str)
	{
		return (bool) preg_match( '/^[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function is_natural_no_zero($str)
	{
		if ( ! preg_match( '/^[0-9]+$/', $str))
		{
			return FALSE;
		}

		if ($str == 0)
		{
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Base64
	 *
	 * Tests a string for characters outside of the Base64 alphabet
	 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_base64($str)
	{
		return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Prep data for form
	 *
	 * This function allows HTML to be safely shown in a form.
	 * Special characters are converted.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function prep_for_form($data = '')
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				$data[$key] = $this->prep_for_form($val);
			}

			return $data;
		}

		if ($this->_safe_form_data == FALSE OR $data === '')
		{
			return $data;
		}

		return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), stripslashes($data));
	}

	// --------------------------------------------------------------------

	/**
	 * Prep URL
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function prep_url($str = '')
	{
		if ($str == 'http://' OR $str == '')
		{
			return '';
		}

		if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
		{
			$str = 'http://'.$str;
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Strip Image Tags
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function strip_image_tags($str)
	{
		return $this->CI->input->strip_image_tags($str);
	}

	// --------------------------------------------------------------------

	/**
	 * XSS Clean
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function xss_clean($str)
	{
		return $this->CI->security->xss_clean($str);
	}

	// --------------------------------------------------------------------

	/**
	 * Convert PHP tags to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function encode_php_tags($str)
	{
		return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}

}
// END Form Validation Class

/* End of file Form.php */
/* Location: ./application/libraries/Form.php */
