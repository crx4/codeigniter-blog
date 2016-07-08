<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_Model extends CI_Model
{
  public $table = 'messages';

  public function __construct()
  {
      parent::__construct();
  }

  public function get_messages()
  {
    $this->db->order_by('time', 'DESC');
    $query = $this->db->get($this->table);

    if($query->num_rows()>0)
      return $query->result_array();
    else
        return false;
  }

  public function get_last_messages()
  {
    $this->db->limit(3);
    $this->db->order_by('time', 'DESC');
    $query = $this->db->get($this->table);

    if($query->num_rows()>0)
      return $query->result_array();
    else
        return false;
  }

  public function get_new_messages_count()
  {
    $this->db->where('messages.is_read', '0');
    $query = $this->db->get($this->table);

    if($query->num_rows()>0)
      return $query->num_rows();
    else
        return false;
  }

  public function get_message($id)
  {
    $this->db->select('
                        messages.id,
                        messages.email,
                        messages.fullname,
                        messages.time,
                        messages.header,
                        messages.content,
                        messages.is_read,
                        messages.is_answered,
                        answers.time as answer_time,
                        answers.content as answer_content,
                        users.id as user_id,
                        users.username as user_username,
                        users.image_name as user_image_name'
                      );
    $this->db->where('messages.id', $id);
    $this->db->join('messages_answers', 'messages_answers.message_id = messages.id');
    $this->db->join('answers', 'answers.id = messages_answers.answer_id');
    $this->db->join('answers_users', 'answers_users.answer_id = answers.id');
    $this->db->join('users', 'users.id = answers_users.user_id');
    $query = $this->db->get($this->table);

    if($query->num_rows()>0)
      return $query->result_array();
    else {
      $this->db->where('messages.id', $id);
      $query = $this->db->get($this->table);

      if($query->num_rows()>0)
        return $query->result_array();
      else
        return false;
    }
  }

  public function insert_message($data)
  {
    $this->db->insert('answers',array('content' => $data['answer_content']));
    $answer_id = $this->db->insert_id();

    if($this->db->insert('answers_users', array('user_id' => $data['user_id'],
                                                  'answer_id' => $answer_id)) &&
       $this->db->insert('messages_answers', array('message_id' => $data['message_id'],
                                                     'answer_id' => $answer_id)))
      return true;
    else
      return false;
  }

  public function insert_user_message($data)
  {
    if($this->db->insert('messages',$data))
      return true;
    else
      return false;
  }

  public function mark_as_read($id)
  {
    $this->db->where('id',$id);
    $this->db->set('is_read', 1);

    if($this->db->update('messages'))
      return true;
    else
      return false;
  }

  public function mark_as_answered($id)
  {
    $this->db->where('id',$id);
    $this->db->set('is_answered', 1);

    if($this->db->update('messages'))
      return true;
    else
      return false;
  }

  public function delete_answers($id)
  {
    $this->db->where('id', $id);
    if($this->db->delete($this->table))
      return true;
  }

  public function delete_message($data)
  {
    $this->db->where('id', $id);
    $this->db->delete('answers');
    $answer_id = $this->db->insert_id();

    if($this->db->insert('answers_users', array('user_id' => $data['user_id'],
                                                  'answer_id' => $answer_id)) &&
       $this->db->insert('messages_answers', array('message_id' => $data['message_id'],
                                                     'answer_id' => $answer_id)))
      return true;
    else
      return false;
  }
}
