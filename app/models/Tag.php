<?php


class Tag
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getTags(){
        $this->db->query('SELECT *,
                            tags.tag_id as tagId,
                            users.user_id as userId,
                            tags.color as tagColor,
                            tags.time as tagCreated
                            FROM tags
                            INNER JOIN users
                            ON tags.user_id = users.user_id
                            ORDER BY tags.time DESC');
        $tags = $this->db->getAll();
        return $tags;
    }
    public function getTagId($id){
        $this->db->query('SELECT * FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        $tag = $this->db->getOne();
        return $tag;
    }

    public function deleteTag($id){
        $this->db->query('DELETE FROM tags WHERE tag_id=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
    public function editTag($data){
        $this->db->query('UPDATE tags SET info=:info, color=:color WHERE tag_id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':info', $data['info']);
        $this->db->bind(':color', $data['color']);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function addTag($data){
        $this->db->query('INSERT INTO tags (info, user_id, color) VALUES(:info, :user_id, :color)');
        $this->db->bind(':info', $data['info']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':color', $data['color']);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
}