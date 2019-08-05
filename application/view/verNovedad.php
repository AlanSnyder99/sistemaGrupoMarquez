
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1"/>
    <meta name="author" content="Theme Industry">
    <!-- description -->
    <meta name="description" content="boltex">
    <!-- keywords -->
    <meta name="keywords" content="">
        <title>Red Del Hogar</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../application/resources/css/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="css/bootstrap3.min.css"> -->
    <link rel="stylesheet" href="../application/resources/css/style_sucursal.css">
    <link rel="stylesheet" href="../application/resources/css/font-awesome.min.css">
    <link rel="stylesheet" href="../application/resources/css/magnific-popup.css">
    <link rel="stylesheet" href="../application/resources/css/cubeportfolio.min.css">
    <link rel="stylesheet" type="text/css" href="../application/resources/css/component.css" />
        <!-- Slick slider -->
    <link  rel="stylesheet" href="../application/resources/css/slick.css">
    <link  rel="stylesheet" href="../application/resources/css/slick-theme.css">

   <style type="text/css">
      #map {
        height: 100%;
      }
    </style>

    

  </head>
  <body>
  <nav class="navbar navbar-expand-lg fixed-top activate-menu navbar-light bg-light">
    <!--<a class="navbar-brand mu-logo" href="index.html"><img class="logo" href="index.html" src="imgs/logo2.png" alt="logo"></a>-->
    <a class="navbar-brand" href="/main/index">Red Del Hogar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse"    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li >
          <a class="nav-link" href="/main/empresa">Empresa</a>
        </li>
        <li>
          <a class="nav-link" href="/main/proveedores">Proveedores</a>
        </li>
        <li>
          <a class="nav-link" href="/main/sumateALaRed">Sumate a la red</a>
        </li>
        <li>
          <a class="nav-link" href="/main/marketing">Marketing</a>
        </li>
        <li>
          <a class="nav-link" href="/sucursales/index">Sucursales</a>
        </li>
        <li>
          <a class="nav-link" href="/main/catalogos">Catalogos</a>
        </li>
        <li>
          <a class="nav-link" href="/main/novedades">Novedades</a>
        </li>
         <li>
          <a class="nav-link" href="/main/beneficioAnses">Beneficio ANSES</a>
        </li>
        <li>
          <a class="nav-link" href="/main/#contact">Contacto</a>
        </li>
      </ul>
    </div>
  </nav>

<br><br>

<?php
if(mysqli_num_rows($data) >= 1){
   while($novedad = mysqli_fetch_assoc($data)){
 
 echo "  
<div id='features'>
     <div class='text-center features-caption features'>
                
                <h3>".$novedad['titulo']."</h3>
                <h5>".$novedad['fecha']." , </h5>
                <br>
                 <img class='bannerEmpresa' style='width:60%'' src='../application/resources/img/".$novedad['bannerImg'].".jpg' />
                 
                  
     </div>
<br>
 <div class='text-lefts features-caption features'>  
  <p>
                  ".$novedad['subtitulo']."
                  </p>        
  <p>
  ".$novedad['desarrollo']."
  </p>





</div>    
</div>
";
  }
}
?>



  




  <footer class="text-center pos-re">
    <div class="container">
      <div class="footer__box">
        <br>  <br>
        <p>&copy;  2016 Red del Hogar</p>
<p>Paunero 715, Morón.

Pcia. Buenos Aires.

4483-4005/ 06/ 07

info@reddelhogar.com.ar
</p>
<a href="#">
            <img class="dataFiscal" src="../application/resources/img/dataFiscal.jpg" alt="logo">
 </a>
      </div>
    </div>

    <div class="curve curve-top curve-center"></div>
</footer>

  <script src="../application/resources/js/jquery.min.js"></script>
  <script src="../application/resources/js/modernizr.custom.js"></script>
  <script src="../application/resources/js/bootstrap.min.js"></script>
  <script src="../application/resources/js/slick.min.js" type="text/javascript"></script>
  <script src="../application/resources/js/slick.js" type="text/javascript"></script>
  <script src="../application/resources/js/scrollreveal.min.js"></script>
  <script src="../application/resources/js/jquery.cubeportfolio.min.js"></script>
  <script src="../application/resources/js/jquery.matchHeight-min.js"></script>
  <script src="../application/resources/js/masonry.pkgd.min.js"></script>
  <script src="../application/resources/js/jquery.flexslider-min.js"></script>
  <script src="../application/resources/js/classie.js"></script>
	<script src="../application/resources/js/helper.js"></script>
  <script src="../application/resources/js/grid3d.js"></script>
  <script src="../application/resources/js/script.js"></script>


</body>
</html>
