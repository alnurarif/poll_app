<?php
class Company_model extends CI_Model {
	public function getByIdAndVerificationCode($id,$email_verification_code){
		$this->db->select('*');
        $this->db->from('tbl_companies');
        $this->db->where("id", $id);
        $this->db->where("email_verification_code", $email_verification_code);
        return $this->db->get()->row();
	}
	public function verifyAccount($id){
		$this->db->set('email_verification_code', null);
		$this->db->set('email_verified', 1);
        $this->db->where('id', $id);
        $this->db->update('tbl_companies');
	}
    
}