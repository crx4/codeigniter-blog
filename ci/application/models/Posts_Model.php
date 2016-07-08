<?php
Class Posts_Model extends CI_Model {

  function __construct()
  {
      parent::__construct();
  }

  public function get_posts()
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
                        categories.name as post_category_name,
                        users.username as post_user_username,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.type', '1');
    $this->db->order_by('time', 'DESC');
    $this->db->join('posts_categories', 'posts_categories.post_id = posts.id');
    $this->db->join('categories', 'categories.id = posts_categories.category_id');
    $this->db->join('posts_users', 'posts_users.post_id = posts.id');
    $this->db->join('users', 'users.id = posts_users.user_id');
    $query = $this->db->get('posts');
    if ( $query->num_rows()>0  )
        return $query->result_array();
    else
        return false;
  }

  public function get_category_posts($category_id)
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
                        categories.name as post_category_name,
                        users.username as post_user_username,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.type', '1');
    $this->db->where('categories.id', $category_id);
    $this->db->order_by('time', 'DESC');
    $this->db->join('posts_categories', 'posts_categories.post_id = posts.id');
    $this->db->join('categories', 'categories.id = posts_categories.category_id');
    $this->db->join('posts_users', 'posts_users.post_id = posts.id');
    $this->db->join('users', 'users.id = posts_users.user_id');
    $query = $this->db->get('posts');
    if ( $query->num_rows()>0  )
        return $query->result_array();
    else
        return false;
  }

  public function get_user_posts($user_id)
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
                        categories.name as post_category_name,
                        users.username as post_user_username,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.type', '1');
    $this->db->where('users.id', $user_id);
    $this->db->order_by('time', 'DESC');
    $this->db->limit(10);
    $this->db->join('posts_categories', 'posts_categories.post_id = posts.id');
    $this->db->join('categories', 'categories.id = posts_categories.category_id');
    $this->db->join('posts_users', 'posts_users.post_id = posts.id');
    $this->db->join('users', 'users.id = posts_users.user_id');
    $query = $this->db->get('posts');
    if ( $query->num_rows()>0  )
        return $query->result_array();
    else
        return false;
  }

  public function get_limited_posts($limit, $start)
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
                        categories.name as post_category_name,
                        users.username as post_user_username,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.type', '1');
    $this->db->limit($limit, $start);
    $this->db->order_by('time', 'DESC');
    $this->db->join('posts_categories', 'posts_categories.post_id = posts.id');
    $this->db->join('categories', 'categories.id = posts_categories.category_id');
    $this->db->join('posts_users', 'posts_users.post_id = posts.id');
    $this->db->join('users', 'users.id = posts_users.user_id');
    $query = $this->db->get('posts');
    if ( $query->num_rows()>0  )
        return $query->result_array();
    else
        return false;
  }

  public function get_posts_dd()
  {
    $query = $this->db->get('posts');
    $selectboxData = array();
    foreach ($query->result_array() as $value) {
      $selectboxData[$value['id']] = $value['header'];
    }
    return $selectboxData;
  }

  public function get_post($id)
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
                        users.image_name as post_user_image,
                        categories.name as post_category_name,
                        categories.id as post_category_id
                      ');
    $this->db->where('posts.id', $id);
    $this->db->where('posts.type', '1');
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

  public function update_post($data, $category_id, $user_id)
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

  public function insert_post($data, $category_id, $user_id)
  {
    $this->db->insert('posts', $data);
    $post_id = $this->db->insert_id();

    if($this->db->insert('posts_categories', array('category_id' => $category_id,
                                                   'post_id' => $post_id)) &&
       $this->db->insert('posts_users', array('post_id' => $post_id,
                                              'user_id' => $user_id)))
      return true;
    else
      return false;
  }

  public function delete_post($id)
  {
    $this->db->where('id', $id);
    if($this->db->delete('posts'))
      return true;
  }

  public function get_posts_count()
  {
    if( $query = $this->db->count_all('posts'))
      return $query;
    else
      return false;
  }

  public function insert_post_comment($data, $post_id)
  {
    $this->db->insert('comments', $data);
    $comment_id = $this->db->insert_id();

    if($this->db->insert('posts_comments', array('post_id' => $post_id,
                                                  'comment_id' => $comment_id)))
      return true;
    else
      return false;
  }

  public function get_comments($post_id)
  {
    $this->db->select('
                        posts.id,
                        comments.id as comment_id,
                        comments.fullname as comment_fullname,
                        comments.content as comment_content,
                        comments.header as comment_header,
                        comments.email as comment_email,
                        comments.time as comment_time'
                      );
    $this->db->where('posts.id', $post_id);
    $this->db->join('posts_comments', 'posts_comments.post_id = posts.id');
    $this->db->join('comments', 'comments.id = posts_comments.comment_id');
    $query = $this->db->get('posts');

    if($query->num_rows()>0)
      return $query->result_array();
    else {
      $this->db->where('posts.id', $post_id);
      $query = $this->db->get('posts');

      if($query->num_rows()>0)
        return $query->result_array();
      else
        return false;
    }
  }
}
?>
