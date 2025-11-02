<?php 

class mysqli_to_json { 
    var $json; 
    var $cbfunc; 
    var $json_array; 

    //constructor 
    function mysqli_to_json($query = '', $cbfunc = '') { 
        //set cbfunc 
        $this->set_cbfunc($cbfunc); 
         
        //check they don't just want a new class 
        if($query != '') { 
            //set query 
            $this->set_query($query); 
        } 
    } 

    //produces json output 
    function get_json() { 
        //generate json 
        $this->json = $this->cbfunc . '(' . json_encode($this->json_array) . ')';
        $this->json = preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $this->json);

        //return json 
        return $this->json; 
    } 
     
    //produces json from query 
    function get_json_from_query($query, $cbfunc = '') { 
        //set cbfunc 
        $this->set_cbfunc($cbfunc); 
         
        //set query 
        $this->set_query($query); 
         
        //return json data 
        return $this->get_json(); 
    } 
     
    //set query 
    function set_query($query) {
      //execute query
      $exec_query = mysqli_query($DB_Conn, $query);
     
        //reset json array 
        $this->json_array = array(); 

        //loop through rows 
        while($row = mysqli_fetch_assoc($exec_query)) { 
            //add row 
            array_push($this->json_array, $row); 
        }
     
        //enable method chaining 
        return $this; 
    } 
     
    //set cbfunc 
    function set_cbfunc($cbfunc) { 
        //set cbfunc 
        $this->cbfunc = $cbfunc; 

        //enable method chaining 
        return $this; 
    } 
} 

?>
