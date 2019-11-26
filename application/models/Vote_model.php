<?php
class Vote_model extends CI_Model {

    public function getVotesNumberByPollId($poll_id) {
		$this->db->select("count(id) as total_votes");
		$this->db->from("tbl_votes");
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row(); 
		return $result;  
    }

    public function getFirstTypeVote($poll_id){
    	$this->db->select("count(id) as first_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(rotation AS DECIMAL(6,4))<", -30);
		$this->db->where("CAST(rotation AS DECIMAL(6,4))>=", -90);
		$this->db->where("poll_id", $poll_id);

		$result = $this->db->get()->row()->first_part; 
		return $result;	
    }
    public function getMidTypeVote($poll_id){
    	$this->db->select("count(id) as mid_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(rotation AS DECIMAL(6,4))<", 30);
		$this->db->where("CAST(rotation AS DECIMAL(6,4))>=", -30);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->mid_part;  
		return $result;	
    }
    public function getLastTypeVote($poll_id){
    	$this->db->select("count(id) as final_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(rotation AS DECIMAL(6,4))<=", 90);
		$this->db->where("CAST(rotation AS DECIMAL(6,4))>=", 31);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->final_part;  
		return $result;	
    }
    public function getFirstTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as first_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 0);
		$this->db->where("rotation<=", 60);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->first_part;  
		return $result;
    }
    public function getSecondTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as second_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 61);
		$this->db->where("rotation<=", 120);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->second_part;  
		return $result;
    }
    public function getThirdTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as third_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 121);
		$this->db->where("rotation<=", 180);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->third_part;  
		return $result;
    }
    public function getForthTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as forth_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 181);
		$this->db->where("rotation<=", 240);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->forth_part;  
		return $result;
    }
    public function getFifthTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as fifth_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 241);
		$this->db->where("rotation<=", 300);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->fifth_part;  
		return $result;
    }
    public function getSixthTypeVoteCompass($poll_id){
    	$this->db->select("count(id) as sixth_part");
		$this->db->from("tbl_votes");
		$this->db->where("rotation>=", 301);
		$this->db->where("rotation<=", 360);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->sixth_part;  
		return $result;
    }
    public function getFirstTypeSliderVote($poll_id){
    	$this->db->select("count(id) as first_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(percentage AS DECIMAL(6,4))<", 33.3333);
		$this->db->where("poll_id", $poll_id);

		$result = $this->db->get()->row()->first_part; 
		return $result;	
    }
    public function getMidTypeSliderVote($poll_id){
    	$this->db->select("count(id) as mid_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(percentage AS DECIMAL(6,4))<", 66.6667);
		$this->db->where("CAST(percentage AS DECIMAL(6,4))>=",33.4444);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->mid_part;  
		return $result;	
    }
    public function getLastTypeSliderVote($poll_id){
    	$this->db->select("count(id) as final_part");
		$this->db->from("tbl_votes");
		$this->db->where("CAST(percentage AS DECIMAL(6,4))>", 66.6667);
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->row()->final_part;  
		return $result;	
    }
 	public function getAllPercentagesOfSliderPoll($poll_id){
		$this->db->select("percentage");
		$this->db->from("tbl_votes");
		$this->db->where("poll_id", $poll_id);
		$result = $this->db->get()->result();  
		return $result;	
	}   
	public function getThreeHighestDays($poll_id){
		$this->db->select("count(id) as votes,DATE_FORMAT(created_at, '%a %D %b %y') as created_at");
		$this->db->from('tbl_votes');
		$this->db->where("poll_id", $poll_id);
		$this->db->group_by('DATE(created_at)');
		$this->db->order_by('count(id)', 'DESC');
		$this->db->limit(3);
		return $this->db->get()->result(); 
	}
	public function getThreeLowestDays($poll_id){
		$this->db->select("count(id) as votes,DATE_FORMAT(created_at, '%a %D %b %y') as created_at");
		$this->db->from('tbl_votes');
		$this->db->where("poll_id", $poll_id);
		$this->db->group_by('DATE(created_at)');
		$this->db->order_by('count(id)', 'ASC');
		$this->db->limit(3);
		return $this->db->get()->result();	
	}

	public function getVotesNumberFromCountry($poll_id){
		$this->db->select("count(v.id) as votes,c.name as country_name");
		$this->db->from('tbl_votes v');
		$this->db->join('tbl_countries c', 'c.code = v.voted_from', 'left');
		$this->db->where("v.poll_id", $poll_id);
		$this->db->group_by('v.voted_from');
		$this->db->order_by('count(v.id)', 'DESC');
		return $this->db->get()->result();		
	}
    

}