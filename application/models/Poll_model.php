<?php
class Poll_model extends CI_Model {

    public function getPollDetails($poll_id) {
		$this->db->select("p.*,pi.icon_id icon_id, pi.icon_rotation icon_rotation, pi.description description, i.id icon_id, i.icon_name icon_name, i.icon_file_name icon_file_name");
		$this->db->from("tbl_polls p");
		$this->db->join('tbl_poll_icons pi', 'pi.poll_id = p.id', 'left');
		$this->db->join('tbl_icons i', 'i.id = pi.icon_id', 'left');
		$this->db->where("p.id", $poll_id);
		$result = $this->db->get()->result(); 
		return $result;  
    }

    public function getDebateDetailsById($id) {
        $this->db->select("p.*,c.name as company_name,c.logo as company_logo");
        $this->db->from('tbl_polls p');
		$this->db->join('tbl_companies c', 'p.company_id = c.id', 'left');
        $this->db->where("p.id", $id);
        return $this->db->get()->row();
    }
}