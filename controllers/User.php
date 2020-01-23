<?php


class User extends Controller
{
    /**
     * @var User_Model
     */
    protected $model;

    public function books($bookID)
    {
        $read = $_POST['data'];
        $zakladka = $read==1 ? '"przeczytane"' : '"chcę przeczytać"';

        $result = $this->model->isBookExist($bookID, Session::get('user')['id']);
        if ($result)
        {
            echo "Ta pozycja istnieje już w zakładce Moje Książki";
            die;
        }

        $result = $this->model->addBook($bookID, $read, Session::get('user')['id']);
        if ($result)
        {
            echo "Dodano książkę do zakładki Moje Książki.". $zakladka;
            die;
        }
    }

    public function showUserBooks()
    {
        $result = $this->model->getUserBooks(Session::get('user')['id']);
        $this->view->getUserBooks = $result;

        $this->view->render('users/myBooks');
    }

    public function deleteBook($bookID)
    {
        $result = $this->model->deleteBook($bookID, Session::get('user')['id']);
        if ($result)
        {
            echo "Usunieto";
        }
    }

    public function updateReadBook($bookID)
    {
        $result = $this->model->updateReadBook($bookID, Session::get('user')['id']);
        if ($result)
        {
            echo "Zmodyfikowano";
        }
    }

    public function addComment($bookId)
    {
        $error = '';
        $commentContent = '';
        $parentID = $_POST['data'][0]['value'];
        $num = $_POST['data'][1]['value'];

        if (empty($_POST['data'][2]['value']))
        {
            $error = " Nie możesz dodać pustego komentarza. ";
        }
        else
        {
            $commentContent = $_POST['data'][2]['value'];
        }

        if ($error == '')
        {
            $result = $this->model->addComment($parentID, $commentContent, $bookId, Session::get('user')['id'], $num);
            if ($result)
            {
                $error = "Komentarz został dodany.";

                require_once 'models/Index_Model.php';
                $indexModel = new Index_Model();
                $book = $this->model->getBook($bookId);
                $comments = $indexModel->fetchComments($book['id'], $parentID);
                $book['comments'] = $comments;
//                echo '<pre>';
//                print_r(end($book['comments']));
//                die;
                $this->view->oneComment = end($book['comments']);

                $this->view->render("index/oneComment", true);
                die;

            }
        }

        $data = array(
            'error' => $error
        );

        echo json_encode($data);
        die;

    }

}