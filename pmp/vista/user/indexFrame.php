<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Atenos Consulting & Services Version 1.0</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/layout.css"/>
         <link rel="shortcut icon" href="recursos/img/icons/favicon.png">
    </head>
    <?php
       //UsuarioTo userVal = (UsuarioTo) request.getSession().getAttribute("userValidated");
    ?>
    <body>
        <header>
            <div>
                <a href="http://www.atenos.com" target="self">
                    <img style="border:0px;" alt="Atenos Consulting & Services" height="50px" src="../../recursos/img/logos/logo.png"/>
                </a>
            </div>
            <div style="right: 10px;top:15px;position: fixed;" >
                <a href="_proxy.php?controlador=Index&accion=login">
                    <img src="../../recursos/img/logos/logo_test_pmi.png" height="20px"/>
                </a>
            </div>
        </header>
        <menu>               
              <?php include 'menu.php';?>
        </menu>
        <article>
            <iframe name="content" id="content" height="100%" width="100%" style="border:none" ></iframe>
        </article>
        <footer>

            <nav>Usuario: xxxx</nav>
            <nav>Cargo: xxxx</nav>
            <nav>Nombres: XXXXX
            </nav>
        </footer>
    </body>
</html>