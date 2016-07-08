<?php
Class Slides_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_slides()
  {
    $this->db->order_by('id', 'DESC');
    if ( $query = $this->db->get('slides') )
        return $query->result_array();
    else
        return false;
  }

  public function get_slide($id)
  {
    $this->db->where('id', $id);
    if ( $query = $this->db->get('slides') )
        return $query->row();
    else
        return false;
  }

  public function update_slide($data)
  {
      $this->db->where('id', $data['id']);
      if($this->db->update('slides', $data))
        return true;
  }

  public function insert_slide($data)
  {
      if($this->db->insert('slides', $data))
        return true;
  }

  public function delete_slide($id)
  {
    $this->db->where('id', $id);
    if($this->db->delete('slides'))
      return true;
  }
}
?>
