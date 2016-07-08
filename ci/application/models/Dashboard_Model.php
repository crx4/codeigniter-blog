<?php
Class Dashboard_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_user_count()
  {
    if( $query = $this->db->count_all('users'))
      return $query;
    else
      return false;
  }

  public function get_post_count()
  {
    if( $query = $this->db->count_all('posts'))
      return $query;
    else
      return false;
  }

  public function get_message_count()
  {
    if( $query = $this->db->count_all('messages'))
      return $query;
    else
      return false;
  }

  public function get_image_count()
  {
    if( $query = $this->db->count_all('images'))
      return $query;
    else
      return false;
  }

  public function get_group_count()
  {
    if( $query = $this->db->count_all('users_groups'))
      return $query;
    else
      return false;
  }

  public function get_last_users()
  {
    $this->db->select('
                        users.id,
                        users.username,
                        users.created_on,
                        users.active,
                        groups.description as user_group'
                      );
    $this->db->limit(5);
    $this->db->join('users_groups', 'users_groups.user_id = users.id');
    $this->db->join('groups', 'groups.id = users_groups.group_id');
    $query = $this->db->get('users');
    if($query->num_rows()>0)
      return $query->result_array();
    else
      return false;
  }

  public function get_last_groups()
  {
    $this->db->limit(5);
    if( $query = $this->db->get('groups'))
      return $query->result_array();
    else
      return false;
  }

  public function get_last_images()
  {
    $this->db->limit(8);
    if( $query = $this->db->get('images'))
      return $query->result_array();
    else
      return false;
  }
}
?>
