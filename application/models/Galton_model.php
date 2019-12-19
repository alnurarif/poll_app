<?php
class Galton_model extends CI_Model {
	public function getGaltonInfoByCompanyId($companyId){
		$this->db->select("*");
        $this->db->from('tbl_galtons');
        $this->db->where("company_id", $companyId);
        return $this->db->get()->row();
	}

	public function calculate($given_votes){
        $votes = $given_votes;
        $galton_array = array();
        $j = 1;
        for($i = 0; $i <= 11; $i++){
            $random_percentage = rand(40,60)/100;
            $inside_galton = array();
            for($k = 0; $k <= $j; $k++){
                if($k == 0 || $k == $j){
                    $inside_galton[$k] = 0;
                }else{
                    // echo "this is i:".$i."<br/>";
                    if($i == 1){
                        // echo 'here is the problem<br/>';
                        $inside_galton[$k] = $votes;
                    }else if($i != 0){
                        // echo $galton_array[$i-1][$k-1]."-a".($k-1)."<br/>";
                        // echo $galton_array[$i-1][$k]."-b".($k)."<br/>";
                        $inside_galton[$k] = round(($galton_array[$i-1][$k-1]*$random_percentage)+($galton_array[$i-1][$k]*(1-$random_percentage)));
                    }
                }
            }
            
            $galton_array[$i] = $inside_galton;
            $j++;

        }
        $last_array = array_slice($galton_array[11], 1, -1);
        // echo $votes;
        // echo json_encode($last_array);
        // echo array_sum($last_array);
        // dd($galton_array);
        $data['votes'] = $votes;
        $data['total_galton_calculation'] = $galton_array;
        $data['last_galton_result_array'] = $last_array;
        return $data;
    }
}