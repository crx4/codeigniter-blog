<?php
Class Options_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_options()
  {
    if ( $query = $this->db->get('options') )
        return $query->result_array();
    else
        return false;
  }

  public function update_options($data)
  {
    foreach ($data as $key => $value) {
      $this->db->set('value', $value);
      $this->db->where('name', $key);
      $this->db->update('options');
    }
  }

  public function get_copyright()
  {
    $this->db->select('value');
    $this->db->where('name', 'copyright');
    $query = $this->db->get('options');
    $result = $query->row();

    return $result->value;
  }

  public function get_meta_description()
  {
    $this->db->select('value');
    $this->db->where('name', 'meta_description');
    $query = $this->db->get('options');
    $result = $query->row();

    return $result->value;
  }

  public function get_meta_keywords()
  {
    $this->db->select('value');
    $this->db->where('name', 'meta_keywords');
    $query = $this->db->get('options');
    $result = $query->row();

    return $result->value;
  }
}
?>
