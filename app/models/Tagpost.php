<?php


class Tagpost
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getTags(){
        $this->db->query('SELECT *,
                            tags.tag_id as tagId,
                            tagposts.tag_id as tagdId
                            FROM tags
                            INNER JOIN tagposts
                            ON tagposts.tag_id = tags.tag_id');
        $tags = $this->db->getAll();
        return $tags;
    }

    public function addTag($data){
        $this->db->query('INSERT INTO tagposts (post_id, tag_id) VALUES(:post_id, :tag_id)');
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':tag_id', $data['tag_id']);
        $result = $this->db->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }
}
