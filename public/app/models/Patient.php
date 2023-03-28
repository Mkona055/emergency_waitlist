<?php
namespace Models;
class Patient {
    public $id ;
    public $first_name ;
    public $last_name ;
    public $email;
    public $injury_severity;
    public $code;
    public $phone;
    public $came_at ;
    public $served = false ;
    public function __construct($id, $first_name,$last_name, $email, $injury_severity, $phone, $came_at, $served, $code){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->injury_severity = $injury_severity;
        $this->phone = $phone;
        $this->came_at = $came_at;
        $this->served = $served;    
        $this->code = $code ;

    }

    public static function getPatientfromForm($form){
        $first_name = $form['first_name'];
        $last_name = $form['last_name'];
        $email = $form['email'];
        $injury_severity = $form['injury_severity'];
        $phone = $form['phone_number'];
        return new Patient(null,$first_name, $last_name, $email, $injury_severity, $phone, date('Y-m-d H:i:s'), 'f', Patient::randomCode());
    }
    public static function getPatientfromDb($db, $last_name, $code){
        $result = pg_query($db, "SELECT * FROM patients WHERE last_name = $last_name AND code = $code");
        if (!$result) {
            return null;
        }else{
            $row = pg_fetch_assoc($result);
            return new Patient($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['injury_severity'], $row['phone'], $row['came_at'], $row['served'], $row['code']);

        }
    }
    public static function getOrderedPatientsfromDb($db){
        $result = pg_query($db,"SELECT * FROM patients 
                                WHERE served = 'f' 
                                ORDER BY injury_severity DESC, came_at ASC");
        # return all of patients from results
        if (!$result) {
            return null;
        }else{
            # iterates result until there are no more rows and add them to an array
            $patients = array();
            while ($row = pg_fetch_assoc($result)) {
                $patients[] = new Patient($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['injury_severity'], $row['phone'], $row['came_at'], $row['served'], $row['code']);
            }
            return $patients;
        }
        
    }
    
    public static function randomCode(){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString; 
    }
    public function save($db){
        $result = pg_query($db, "INSERT INTO patients ( first_name, last_name, code, email, injury_severity, phone, came_at, served)
                                 VALUES ('$this->first_name', '$this->last_name', '$this->code', 
                                        '$this->email', $this->injury_severity, '$this->phone', '$this->came_at', '$this->served')");
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
    public static function markPatientServed($db, $id){
        $result = pg_query($db, "UPDATE patients SET served = true WHERE id = '$id'");
        if (!$result) {
            return false;
        }else{
            return true;
        }
    }


}