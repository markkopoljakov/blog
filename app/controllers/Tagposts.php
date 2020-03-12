<?php


class Tagposts extends Controller
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->tagModel = $this->model('Tagpost');
    }
    public function index() {
        $tags = $this->tagModel->getTags();
        $data = array(
            'tags' => $tags
        );
        $this->view('tags/index', $data);
    }

    public function addtag(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'post_id' => trim($_POST['post_id']),
                'tag_id' => trim($_POST['tag_id']),
                'info_err' => '',
                'color_err' => ''
            );

            if(empty($data['post_id'])){
                $data['post_id_err'] = 'Please enter info';
            }
            if(empty($data['tag_id'])){
                $data['tag_id_err'] = 'Please enter content text';
            }

            if(empty($data['tag_id_err']) and empty($data['post_id_err'])){
                if($this->tagModel->addTag($data)){
                    msg('tag_message', 'Tag Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts', $data);
            }
        } else {
            $data = array(
                'post_id' => '',
                'tag_id' => ''
            );
            $this->view('tags/posttag', $data);
        }
    }

}