<?php
Class About_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_about()
  {
    $this->db->select('
                        posts.id,
                        posts.time,
                        posts.content,
                        posts.header,
                        posts.hit,
                        posts.type,
                        posts.meta_keywords,
                        posts.meta_description,
                        posts.image_url,
                        users.username as post_user_username,
                        categories.name as post_category_name,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.type', '2');
    $this->db->join('posts_categories', 'posts_categories.post_id = posts.id');
    $this->db->join('categories', 'categories.id = posts_categories.category_id');
    $this->db->join('posts_users', 'posts_users.post_id = posts.id');
    $this->db->join('users', 'users.id = posts_users.user_id');
    $query = $this->db->get('posts');
    if ( $query->num_rows()>0 )
        return $query->row();
    else
        return false;
  }

  public function update_about($data, $category_id, $user_id)
  {
    $this->db->where('id', $data['id']);
    $this->db->replace('posts', $data);

    if ( $this->db->replace('posts_categories', array('category_id' => $category_id,
                                                   'post_id' => $data['id'])) &&
       $this->db->replace('posts_users', array('post_id' => $data['id'],
                                              'user_id' => $user_id)) )
      return true;
    else
      return false;
  }
}
?>
