<?php
Class Categories_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_categories()
  {
    if ( $query = $this->db->get('categories') )
        return $query->result_array();
    else
        return false;
  }

  public function get_categories_dd()
  {
    $query = $this->db->get('categories');
    $selectboxData = array();
    foreach ($query->result_array() as $value) {
      $selectboxData[$value['id']] = $value['name'];
    }
    return $selectboxData;
  }

  public function get_category($id)
  {
    $this->db->where('id', $id);
    if ( $query = $this->db->get('categories') )
        return $query->row();
    else
        return false;
  }

  public function update_category($data)
  {
      $this->db->where('id', $data['id']);
      if($this->db->update('categories', $data))
        return true;
  }

  public function insert_category($data)
  {
      if($this->db->insert('categories', $data))
        return true;
  }

  public function delete_category($id)
  {
    $this->db->where('id', $id);
    if($this->db->delete('categories'))
      return true;
  }
}
?>
