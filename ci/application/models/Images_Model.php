<?php
Class Images_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_images()
  {
    $this->db->order_by('id', 'DESC');
    if ( $query = $this->db->get('images') )
        return $query->result_array();
    else
        return false;
  }

  public function get_image($id)
  {
    $this->db->where('id', $id);
    if ( $query = $this->db->get('images') )
        return $query->row();
    else
        return false;
  }

  public function update_image($data)
  {
      $this->db->where('id', $data['id']);
      if($this->db->update('images', $data))
        return true;
  }

  public function insert_image($data)
  {
      if($this->db->insert('images', $data))
        return true;
  }

  public function delete_image($id)
  {
    $this->db->where('id', $id);
    if($this->db->delete('images'))
      return true;
  }
}
?>
