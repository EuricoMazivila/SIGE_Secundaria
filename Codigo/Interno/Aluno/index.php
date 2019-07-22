<!DOCTYPE html>
<html>
<head>
  <?php
  $titilo="Pagina Aluno";
 require('metadados.php');
  ?>


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      defaultDate: '2019-06-12',
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-06-01'
        },
        {
          title: 'Long Event',
          start: '2019-06-07',
          end: '2019-06-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-06-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-06-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-06-11',
          end: '2019-06-13'
        },
        {
          title: 'Meeting',
          start: '2019-06-12T10:30:00',
          end: '2019-06-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-06-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-06-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-06-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-06-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-06-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-06-28'
        }
      ]
    });

    calendar.render();
  });

</script>

</head>
<body>

<?php
include ('../header.php');
?>


<div class="row container">
		
		<div class="area">
			
		</div><nav class="main-menu"> <!--Sidebar -->
            <ul>

            	 <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-list fa-2x"></i>
                    </a>
                </li>

                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Home
                        </span>
                    </a>
                    
                </li>
                
                <li class="has-subnav">
                    <a href="#">
                    	<i class="fa fa-user-circle fa-2x"></i>
                        <span class="nav-text">
                            Meu perfil
                        </span>
                    </a>

                    <ul>
                      <li>
                        <a href="Marcar_matricula.html">
                          <i class="fa fa-user fa-2x"></i>
                          <span class="nav-text">
                              Perfil Publico
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="Marcar_matricula.html">
                          <i class="fa fa-user-secret fa-2x"></i>
                          <span class="nav-text">
                              Perfil privado
                          </span>
                        </a>
                      </li>
                    </ul>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                    	<i class="fa fa-edit fa-2x"></i>
                        <span class="nav-text">
                            Avaliações 
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                    	<i class="fa fa-paperclip fa-2x"></i>
                        <span class="nav-text">
                            Matrícula 
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-users fa-2x"></i>
                        <span class="nav-text">
                            Professores
                        </span>
                    </a>
                </li>
                
                <li>
                   <a href="#">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Ajuda & Suporte
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                        <i class="fa fa-cogs fa-2x"></i>
                        <span class="nav-text">
                            Definições
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                   <a href="#">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                           <form action="../DAO/processamento.php" method="post">
                             <input type="submit" name='fecharSecao'>
                           </form> 
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>  
    </div>

		<div class="centro col-md-12">  <!--div para parte central -->

			<div class="row"> 
				<ol class="breadcrumb bg-white col-md-12 col-sm-2"> 
					<li><a href="#">Home</a></li> 
					<li><a href="#">Next</a></li>
					<small id="lect">Ano lectivo 2019</small>
				</ol>
			</div>

			<div class="row">
				
				<div class="faltas col-md-1 offset-md-2">

          <div class="row">
            <span class="centere col-md-1">  
              <i class="fas fa-user-times"></i>
            </span>

          <i class="col-md-5">Faltas</i>

          </div>
				</div>

				<div class="testes col-md-1 offset-md-1">
          <span class="centere"> 
            <i class="fas fa-pencil-ruler"></i>
          </span>
          <p>Testes realizados</p>
					
				</div>

				<div class="media col-md-1 offset-md-1">

          <span class="centere"> 
            <i class="fas fa-balance-scale"></i>
          </span>
          <p>Média trimestral</p>
					
				</div>

			</div>

      <div class="row">
        <table class="table table-bordered bg-white col-md-2 offset-md-2">
            <tr>
              <th>Disciplinas</td>
            </tr>

            <tr>
              <td>Portugues</td>
            </tr>

            <tr>
              <td>Fisica</td>
            </tr>

            <tr>
              <td>Quimica</td>
            </tr>

             <tr>
              <td>Biologia</td>
            </tr>
        </table>

        <div id='calendar' class="col-md-3 offset-md-1"></div>
        

        <table class="table table-hover bg-white col-md-2 offset-md-1">
            <tr>
              <th>Bolsas academicas</th>
            </tr>

            <tr>
              <td>Russia 2019 licenciatura</td>
            </tr>

            <tr>
              <td>Japao 2019 bacharelato</td>
            </tr>
          
        </table>

      </div>
        
      </div>

		<!--	<div class="row" border="1">

				<table border="1" class = "col-md-2 bg-white offset-md-1">
    				<tr>
      					<td>Matematica</td>
            </tr>
            
  				</table>
    			
  				<table border="1" class = "col-md-2 bg-white offset-md-1">
    				<tr>
      					<td>India licenciatura</td>
   					</tr>
   					<tr>
      					<td>Brazil bacharelato</td>
   					</tr>
   					<tr>
      					<td>Angola mestrado</td>
   					</tr>
  				</table>
			</div> -->



		</div> 
</div>


<div class="row">	<!--Rodape-->
<footer class="fixed-bottom col-lg-12">
	<p id="pp">&copy;Copyright 2019 | SIGA YOUNG | Sobre Nós</p>
</footer>
</div>

</body> 
</html>

<!--

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSite">
		</div>

	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>


<div id="mySidebar" class="sidebar"> 	

		<div id="usuu">
			<p>
        		<span style="font-size: 250%">
					<i class="fas fa-user"></i>
				</span>
				Ricardo Mazivila
			</p><hr>
		</div>
