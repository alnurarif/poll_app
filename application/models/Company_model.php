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
	public function getCompanyInfoByPollId($poll_id){
		$this->db->select('c.*,gb.*');
        $this->db->from('tbl_companies c');
        $this->db->join('tbl_polls p', 'p.company_id = c.id', 'left');
        $this->db->join('tbl_galtons gb', 'gb.company_id = c.id', 'left');
        $this->db->where("p.id", $poll_id);
        return $this->db->get()->row();	
	}
    
}