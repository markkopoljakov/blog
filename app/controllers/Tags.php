<?php


class Tags extends Controller
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->tagModel = $this->model('Tag');
    }

    public function index() {
        $tags = $this->tagModel->getTags();
        $data = array(
            'tags' => $tags
        );
        $this->view('tags/index', $data);
    }

    public function show($id){
        $tag = $this->tagModel->getTagId($id);
        $data = array(
            'tag' => $tag

        );
        $this->view('tags/show', $data);
    }

    public function delete($id){
        if(is_numeric($id)){
            $tag = $this->tagModel->getTagId($id);
            if($tag->user_id != $_SESSION['user_id']){
                redirect('tags');
            }
            if($this->tagModel->deleteTag($id)){
                msg('tag_message', 'Tag Removed');
                redirect('tags');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('tags');
        }

    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'info' => trim($_POST['info']),
                'color' => trim($_POST['color']),
                'color' => trim($_POST['color']),
                'user_id' => $_SESSION['user_id'],
                'info_err' => '',
                'color_err' => ''
            );

            if(empty($data['info'])){
                $data['info_err'] = 'Please enter info';
            }
            if(empty($data['color'])){
                $data['color_err'] = 'Please enter content text';
            }

            if(empty($data['info_err']) and empty($data['color_err'])){
                if($this->tagModel->addTag($data)){
                    msg('tag_message', 'Tag Added');
                    redirect('tags/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/index', $data);
            }
        } else {
            $data = array(
                'info' => '',
                'color' => ''
            );
            $this->view('tags/add', $data);
        }
    }
    public function addPT(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'post_id' => trim($_POST['']),
                'color' => trim($_POST['color']),
                'color' => trim($_POST['color']),
                'user_id' => $_SESSION['user_id'],
                'info_err' => '',
                'color_err' => ''
            );

            if(empty($data['info'])){
                $data['info_err'] = 'Please enter info';
            }
            if(empty($data['color'])){
                $data['color_err'] = 'Please enter content text';
            }

            if(empty($data['info_err']) and empty($data['color_err'])){
                if($this->tagModel->addTag($data)){
                    msg('tag_message', 'Tag Added');
                    redirect('tags/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/index', $data);
            }
        } else {
            $data = array(
                'info' => '',
                'color' => ''
            );
            $this->view('tags/add', $data);
        }
    }

}