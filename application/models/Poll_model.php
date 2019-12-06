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
    public function getVotesOfPolls($company_id){
    	$this->db->select("p.question as question,count(v.id) as responses");
		$this->db->from("tbl_polls p");
		$this->db->join('tbl_votes v', 'v.poll_id = p.id', 'left');
		$this->db->where("p.company_id", $company_id);
		$this->db->group_by('p.id');
		$result = $this->db->get()->result(); 
		return $result;	
    }
    public function getCountriesOfPolls($company_id){
    	$this->db->select("p.id as poll_id, p.question as question,count(v.id) as votes,c.name as country_name");
		$this->db->from("tbl_polls p");
		$this->db->join('tbl_votes v', 'v.poll_id = p.id', 'left');
		$this->db->join('tbl_countries c', 'c.code = v.voted_from', 'left');
		$this->db->where("p.company_id", $company_id);
		$this->db->group_by('p.id,v.voted_from');
		$this->db->order_by('p.id,count(v.id)', 'DESC');
		$this->db->order_by('p.id,count(v.id)', 'DESC');
		$result = $this->db->get()->result(); 
		return $result;		
    }
    public function most_voted_time_of_countries($company_id){
    	$this->db->select('v.poll_id as poll_id,p.question as question,, c.name as voted_country, count(v.voted_from) votes_from_country, v.voted_from as voted_country_code, CASE 
		    WHEN TIME(v.created_at)>= TIME("05:00:00") AND TIME(v.created_at)<= TIME("10:30:00") THEN "Morning" 
		    WHEN TIME(v.created_at)>= TIME("10:31:00") AND TIME(v.created_at)<= TIME("12:00:00") THEN "Late Morning" 
		    WHEN TIME(v.created_at)>= TIME("12:01:00") AND TIME(v.created_at)<= TIME("16:30:00") THEN "Afternoon"
		    WHEN TIME(v.created_at)>= TIME("16:31:00") AND TIME(v.created_at)<= TIME("17:00:00") THEN "Late Afternoon"
		    WHEN TIME(v.created_at)>= TIME("17:01:00") AND TIME(v.created_at)<= TIME("21:00:00") THEN "Evening"
		    WHEN TIME(v.created_at)>= TIME("21:01:00") AND TIME(v.created_at)<= TIME("23:59:00") THEN "Night"
		    WHEN TIME(v.created_at)>= TIME("00:00:00") AND TIME(v.created_at)<= TIME("04:59:00") THEN "Early Morning"
		    ELSE "The quantity is under 30" 
		END as voted_time');
		$this->db->from("tbl_polls p");
		$this->db->join('tbl_votes v', 'v.poll_id = p.id', 'left');
		$this->db->join('tbl_countries c', 'c.code = v.voted_from', 'left');
		$this->db->where("p.company_id", $company_id);
		$this->db->group_by('v.voted_from,p.id,CASE 
		    WHEN TIME(v.created_at)>= TIME("05:00:00") AND TIME(v.created_at)<= TIME("10:30:00") THEN "Morning" 
		    WHEN TIME(v.created_at)>= TIME("10:31:00") AND TIME(v.created_at)<= TIME("12:00:00") THEN "Late Morning" 
		    WHEN TIME(v.created_at)>= TIME("12:01:00") AND TIME(v.created_at)<= TIME("16:30:00") THEN "Afternoon"
		    WHEN TIME(v.created_at)>= TIME("16:31:00") AND TIME(v.created_at)<= TIME("17:00:00") THEN "Late Afternoon"
		    WHEN TIME(v.created_at)>= TIME("17:01:00") AND TIME(v.created_at)<= TIME("21:00:00") THEN "Evening"
		    WHEN TIME(v.created_at)>= TIME("21:01:00") AND TIME(v.created_at)<= TIME("23:59:00") THEN "Night"
		    WHEN TIME(v.created_at)>= TIME("00:00:00") AND TIME(v.created_at)<= TIME("04:59:00") THEN "Early Morning"
		    ELSE "The quantity is under 30" 
		END');
		$this->db->order_by('p.id ASC,count(v.voted_from) DESC');
		$result = $this->db->get()->result(); 
		return $result;		
    }
}