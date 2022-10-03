<?php
    //создание сессии для сохронения информации, передачи и чтения данных на других страницах
    session_start();
    //проверка кнопки send и полей формы name, email, message
    if (isset($_POST['send'])) {
        $errorString='';//собрать список ошибок
        //читаем данные из формы

        $name=$_POST['name'];
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $message=$_POST['message'];

        //---------------------------------------------проверка заполненность полей на корректность 

        if(trim($name)==''){ //если поле name осталось пустое
            $errorString.='Имя пользователя не введено<br>';
        }
        if(!$email){ //если поле заполнено неправильно
            $errorString.='Неправильный емайл адрес<br>';
        }
        if(trim($message)==''){ //если поле message осталось пустое
            $errorString.='Текст сообщение не введен<br>';
        }
        //-----------------------Report send email создание отчета и отправка на сообщения на емайл 
        if($errorString==''){
            $sitemail='sitemail@firma.ee';//емайл КУДА уйдет сообщение
            $subject='Message from site - contact form';//тема сообщения
            $comment="
            <i>Contact form from site</i><hr>
            Hello!<br>
            Your name: $name<br>
            Message:<br> $message
            <hr>
            сообщение отправлено на почту фирмы и ваш е-майл: $email<br>
            -----------------End message--------------
            ";

            mail($sitemail,$subject,$comment);//отправка на email фирмы
            mail($email,$subject,$comment);//отправка на mail клиента - дублирование

            $_SESSION['comment']=$comment;//переменная сессии, сохроняем сообщение, чтобы вывести на страницу
        
        }//errorstring
        //если есть ошибки заполнения, сохраним в переменную сессии, чтобы вывести на страницу
        elseif($errorString!=''){
            $_SESSION['error']=$errorString;
        }

        //Переход на страницу ответ после отправки сообщения
        header('Location:contactAnswer.php');
    }//send
    else{
        //Переход на страницу формы, в случае если попытаются просто запустить этот файл без заполнения формы
        header('Location:contactForm.php');
    }//else
?>