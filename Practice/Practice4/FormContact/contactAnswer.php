<?php
    //создание сессии для сохранения информации, передачи и чтения данных на других страницах
    session_start();
    include_once('header.php');
    include_once('contactHeader.php');
?>

<?php
    //если передана хотя бы одна переменная сессии -  ошибка или сообщение
    if(isset($_SESSION['error']) || isset($_SESSION['comment'])){
        //если передано сообщение, созданное в файле sendContact.php
        if(isset($_SESSION['comment'])){
            echo '<h3>Отправка сообщения</h3>';
            echo '<h4>Сообщение отправлено. Спасибо. </h4><hr>';
            //вывод сообщения на страницу
            echo '<p>Ваше сообщение: <br>'.$_SESSION['comment'].'</p>';
            //---------------------------
            echo '<hr><p><a href = "contactForm.php">Написать сообщение</a></p>';
            //удаление переменной сесссии
            unset($_SESSION['comment']);
        }
        elseif(isset($_SESSION['error'])){
            //если передана ошибка, созданная в файле sendContact.php
            echo '<h3>Сообщение об ошибке</h3>';
            //вывод ошибки на страницу
            echo '<p>' . $_SESSION['error'] . '</p>';
            echo '<hr><p><a href="contactForm.php">Написать сообщение</a></p>';
            //удаление переменной сесссии
            unset($_SESSION['error']);
        }
    }else{
        header('Location: contactForm.php');//переход на начало, файл contactForm.php
    }
    session_destroy();//разрушение сессии
?>
<?php
include_once('footer.php');
?>