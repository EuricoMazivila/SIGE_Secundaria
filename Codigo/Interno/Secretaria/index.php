<!DOCTYPE html>
<html>
<head>
	<title>Home Page Secretaria</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../bootstrap/_css/bootstrap.css">
	<link rel="stylesheet" href="../../css/outros/estilo_.css">
	<link rel="stylesheet" href="../../css/outros/MenLateral.css">
  <link href="../../fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet">
  <link href="../../css/outros/main.css">
  <link href="../../css/outros/mainGrid.css"> 
  <script src="../../jquery/jquery.js"></script>
  <script src="../../bootstrap/_js/bootstrap.js"></script>
  <script src="../../js/outros/highcharts.js"></script>
  <script src="../../js/outros/modules/exporting.js"></script>
  <script src="../../js/outros/modules/export-data.js"></script>

</head>
<body>

<?php
include ('../header.php');
?> 


<div class="row container">
		
		<div class="area">
      <?php
      include ('Matricula/menuLateral.php');
      ?>


		<div class="centro col-md-12">  <!--div para parte central -->

			<div class="row"> 
				<ol class="breadcrumb bg-white col-md-12 col-sm-2"> 
					<li><a href="#">Home</a></li> 
					<li><a href="#">Next</a></li>
					<small id="lect">Ano lectivo 2019</small>
				</ol>
			</div>

			<div class="row">
				
				<div class="alunos col-md-1 offset-md-2 shiva">

          <div class="row">
            <span class="centere col-md-1">  
              <i class="fas fa-users"></i>
            </span>

          <p class="col-md-5 ver ">Alunos Matriculados <span class="count">1145</span></p>

          </div>
				</div>

				<div class="turmas col-md-1 offset-md-1 shiva">
          <span class="centere"> 
            <i class="fas fa-book-open"></i>
          </span>
          <p class=" ver">Turmas <span class="count">55</span></p>
					
				</div>

				<div class="orcamento col-md-1 offset-md-1 shiva">

          <span class="centere"> 
            <i class="fas fa-users"></i>
          </span>
          <p class=" ver">Professores <span class="count">25</span></p>
					
				</div>

			</div>

      <div class = "row">

        <div class="col-md-10 offset-md-1">
          <div id="containerB" style=""></div>
          <script src="../../_js/Grafico_Barras.js"></script>
        </div>

      </div>

		</div> 
</div>


<?php 
include('../rodape.php');
?>
<script src="_js/contador.js"></script>
</body> 
</html>
