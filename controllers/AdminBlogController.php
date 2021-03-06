<?php

class AdminBlogController extends AdminBase
{
    public static function actionIndex()
    {
        $total = Blog::getTotalBlogs();

        $blogs = Blog::getAllBlogs($total, 0);
        if (!$blogs) {$blogs = array();}

        $message = FunctionLibrary::sessionMessage();

        require_once(ROOT . '/views/admin-blog/index.php');
        return true;
    }

    public static function actionCreate()
    {
        $errors      = array();
        $title       = '';
        $description = '';
        $content     = '';

        if (isset($_POST['submit'])) {
            $title       = FunctionLibrary::clearStr($_POST['title']);
            $description = nl2br(FunctionLibrary::clearStr($_POST['description']));
            $content     = nl2br(FunctionLibrary::clearStr($_POST['content']));

            if (!User::checkName($title)) {
                $errors[] = 'Заглавие не может быть пустым.';
            }

            if (!User::checkName($description)) {
                $errors[] = 'Описание не может быть пустым.';
            }

            if (!User::checkName($content)) {
                $errors[] = 'Содержание не может быть пустым.';
            }

            if (empty($errors)) {
                $id = Blog::saveBlog($title, $description, $content);

                if ($id) {
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        $tmpName = $_FILES['image']['tmp_name'];

                        $imagePath = "/images/blog/blog{$id}.jpg";
                        $result = Blog::putImageToDataBase($id, $imagePath);
                        if ($result) {
                            $destination = ROOT . '/template' . $imagePath;
                            $moveResult = move_uploaded_file($tmpName, $destination);
                            if (!$moveResult) {
                                $_SESSION['message'] = "Произошла ошибка при добавлении картинки.";
                            }
                        }
                    }
                }
                FunctionLibrary::redirectTo('/admin/blog');
            }
        }


        require_once(ROOT . '/views/admin-blog/create.php');
        return true;
    }

    public static function actionUpdate($id)
    {
        $blog = Blog::getBlogById($id);
        if (!$blog) {$blog = array();}

        $errors      = array();
        $title       = '';
        $description = '';
        $content     = '';

        if (isset($_POST['submit'])) {
            $title       = FunctionLibrary::clearStr($_POST['title']);
            $description = nl2br(FunctionLibrary::clearStr($_POST['description']));
            $content     = nl2br(FunctionLibrary::clearStr($_POST['content']));

            if (!User::checkName($title)) {
                $errors[] = 'Заглавие не может быть пустым.';
            }

            if (!User::checkName($description)) {
                $errors[] = 'Описание не может быть пустым.';
            }

            if (!User::checkName($content)) {
                $errors[] = 'Содержание не может быть пустым.';
            }

            if (empty($errors)) {
                $result = Blog::updateBlogById($id, $title, $description, $content);

                if (!$result) {
                    $_SESSION['message'] = 'Произошла ошибка при редактировании.';
                } else  {
                    if (!empty($_FILES['image']['tmp_name'])) {
                        $tmpName = $_FILES['image']['tmp_name'];
                        if (is_uploaded_file($tmpName)) {
                            $imagePath = "/images/blog/blog{$id}.jpg";
                            $result = Blog::putImageToDataBase($id, $imagePath);
                            if ($result) {
                                $destination = ROOT . '/template' . $imagePath;
                                $moveResult = move_uploaded_file($tmpName, $destination);
                                if (!$moveResult) {
                                    $_SESSION['message'] = "Произошла ошибка при добавлении картинки.";
                                }
                            }
                        }

                    }

                }
                FunctionLibrary::redirectTo('/admin/blog');
            }
        }

        require_once(ROOT . '/views/admin-blog/update.php');
        return true;
    }

    public static function actionDelete($id)
    {
        if (isset($_POST['submit'])) {
            $result = Blog::deleteBlog($id);
            if (!$result) {
                $_SESSION['message'] = "Произошла ошибка при удалении блога.";
            }
            FunctionLibrary::redirectTo('/admin/blog');
        }

        return true;
    }
}