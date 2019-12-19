<?php
class Poll_icons_model extends CI_Model {

    public function getPollIcons($poll_id) {
		$this->db->select("pi.*,i.id as icon_id,pi.icon_rotation as icon_rotation,i.icon_file_name as icon_file_name");
		$this->db->from("tbl_poll_icons pi");
		$this->db->join('tbl_polls p', 'pi.poll_id = p.id', 'left');
		$this->db->join('tbl_icons i', 'i.id = pi.icon_id', 'left');
		$this->db->where("p.id", $poll_id);
		$result = $this->db->get()->result(); 
		return $result;  
    }
    public function getAllIconsByCompanyId($company_id){
    	$this->db->select("*");
        $this->db->from('tbl_icons');
        $this->db->where('company_id',$company_id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }
}