<?php


class panel extends Controller {

    //fonksiyon çalışır çalışmaz koşulsuz şartsız ilk hareketi
    function __construct()
    {

        parent::__construct();

        // sessionı başlattık
        Session::init();

        // kullanıcı adı yoksa forma geri gönderiyoruz
        if (Session::get("kulad") == false) :

            session_destroy();
            header("Location:" .URL. "/login/Form");
            exit;

        else:

            $this->view->goster("panel/index");

        endif;

    }


    // çıkış yap
    function cikis() {

        Session::destroy(); // sessionu sonlandırır
        header("Location:" .URL. "/login/Form");
    }

    


}




?>