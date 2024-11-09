<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sikat_Analisa_Indikator_Model extends CI_Model
{

    public function get_where($where) {
        return $this->db->get_where('sikat_analisa_indikator', $where)->result();
    }

    public function getByQuery($unit,$id) {
        $this->db
        ->select('an.*, tp.JUDUL_INDIKATOR,tp.NUMERATOR,tp.DENUMERATOR,tp.TARGET_PENCAPAIAN', false)
        ->from('sikat_analisa_indikator as an')
        ->join('sikat_profile_indikator as tp', 'an.id_profile_indikator=tp.id', 'left')
        ->order_by('an.create_date', 'DESC');

        if(isset($unit)) $this->db->where('tp.process_type =',$unit);
        if(isset($id)) $this->db->where('an.id =',$id);
        return $this->db->get()->result_array();
    }
}