<?php

class M_quiz extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->select('quiz.*, materi.nama_mapel')
        ->join('materi', 'quiz.id_materi = materi.id')
        ->get('quiz')
        ->result();
    }

    public function tampil_data2()
    {
        return $this->db->select('quiz.*, materi.nama_mapel')
        ->join('materi', 'quiz.id_materi = materi.id')
        ->group_by('quiz.id_materi') // Group by id_materi
        ->get('quiz')
        ->result();
    }

    public function detail_quiz($id = null)
    {
        $query = $this->db->get_where('quiz', array('id' => $id))->row();
        return $query;
    }

    public function delete_quiz($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_quiz($where, $table)
    {
        $result = $this->db->select('quiz.*, materi.nama_mapel')
        ->join('materi', 'quiz.id_materi = materi.id')
        ->get_where($table, $where)
        ->result();

        // Mengembalikan hasil query
        return $result;
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
