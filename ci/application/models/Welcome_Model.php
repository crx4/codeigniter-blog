<?php
Class Welcome_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function add_newsletter_email($data)
  {
      if($this->db->insert('newsletter_emails', $data))
        return true;
      else
        return false;
  }

  public function get_options()
  {
    $query = $this->db->get('options');

    $options = array();

    if ($query->num_rows() > 0){
      foreach ($query->result() as $row)
      {
        $options[$row->name] = $row->value;
      }
      return $options;
    }
    else
        return false;
  }

  public function get_slides()
  {
    $this->db->select('
        slides.id,
        slides.header,
        slides.content,
        slides.link,
        slides.post_id,
        posts.time as post_time
      ');
    $this->db->join('posts', 'posts.id = slides.post_id');
    $query = $this->db->get('slides');

    if ($query->num_rows() > 0){
      return $query->result();
    }
    else
        return false;
  }
}
?>
