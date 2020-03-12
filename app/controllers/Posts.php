<?php


class Posts extends Controller
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->tagModel = $this->model('Tag');
        $this->tag1Model = $this->model('Tagpost');
    }

    public function index() {
        $posts = $this->postModel->getPosts();
        foreach ($posts as $post) {
            $post->tags = $this-> tagModel->getTag($post->postId);
        }
        $data = array(
            'posts' => $posts,
            'tags' => $post->tags
        );
        $this->view('posts/index', $data);
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $data = array(
            'post' => $post
        );
        $this->view('posts/show', $data);
    }
    public function showtag($tagid){
        $post = $this->postModel->getTagId($tagid);
        $data = array(
            'post' => $post
        );
        $this->view('posts', $data);
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array(
                'id' => $id,
                'title' => trim($_POST['title']),
                'post_id' => trim($_POST['post_id']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'content_err' => ''
            );

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['content'])){
                $data['content_err'] = 'Please enter body text';
            }

            if(empty($data['title_err']) and empty($data['content_err'])){
                if($this->postModel->editPost($data)){
                    msg('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts', $data);
            }
        } else {
            $post = $this->postModel->getPostById($id);
           if($post->user_id != $_SESSION['user_id']){
               redirect('posts');
            }
            $data = array(
                'id' => $id,
                'title' => $post->post_title,
                'content' => $post->post_content
            );
            $this->view('posts/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $this->postModel->getPostById($id);
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if($this->postModel->deletePost($id)){
                msg('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'content_err' => ''
            );

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['content'])){
                $data['content_err'] = 'Please enter content text';
            }

            if(empty($data['title_err']) and empty($data['content_err'])){
                if($this->postModel->addPost($data)){
                    msg('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts/add', $data);
            }
        } else {
            $data = array(
                'title' => '',
                'content' => ''
            );
            $this->view('posts/add', $data);
        }
    }
    public function addtag(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'post_id' => trim($_POST['post_id']),
                'tag_id' => trim($_POST['tag_id']),
                'user_id' => $_SESSION['user_id'],
                'post_id_err' => '',
                'tag_id_err' => ''
            );

            if(empty($data['post_id'])){
                $data['post_id_err'] = 'Please enter info';
            }
            if(empty($data['tag_id'])){
                $data['tag_id_err'] = 'Please enter content text';
            }

            if(empty($data['tag_id']) and empty($data['post_id_err'])){
                if($this->tagpModel->addTagp($data)){
                    msg('tag_message', 'Tag Added');
                    redirect('tags/posttag');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/posttag', $data);
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