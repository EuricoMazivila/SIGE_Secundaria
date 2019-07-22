<div class="row container">

    <div class="area">

    </div>
    <nav class="main-menu">
      <!--Sidebar -->
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

        </li>
        <li class="has-subnav">
          <a href="#">
            <i class="fa fa-money-bill-alt fa-2x"></i>
            <span class="nav-text">
              Pagamentos
            </span>
          </a>

        </li>
        <li class="has-subnav">
          <a href="#">
            <i class="fa fa-users fa-2x"></i>
            <span class="nav-text">
              Funcionários
            </span>
          </a>

        </li>
        <li>
          <a href="#">
            <i class="fa fa-chart-bar fa-2x"></i>
            <span class="nav-text">
              Estatísticas
            </span>
          </a>

          <ul>
            <li>
              <a href="#">
                <i class="fa fa-puzzle-piece fa-2x"></i>
                <span class="nav-text">
                  Gerais
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-user-friends fa-2x"></i>
                <span class="nav-text">
                  Funcionários
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-pencil-alt fa-2x"></i>
                <span class="nav-text">
                  Alunos
                </span>
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-desktop fa-2x"></i>
            <span class="nav-text">
              Gestão
            </span>
          </a>

          <ul>
            <li>
              <a href="#">
                <i class="fa fa-edit fa-2x"></i>
                <span class="nav-text">
                  Matricula
                </span>
              </a>

              <ul>
                <li><a href="Disciplina.php">
                    <i class="fa fa-female fa-2x"></i>
                    <span class="nav-text">Marcar matricula</span></a></li>
              </ul>
            </li>

            <li>
              <a href="Disciplina.php">
                <i class="fa fa-plus-square fa-2x"></i>
                <span class="nav-text">
                  Disciplinas
                </span>
              </a>
            </li>

            <li>
              <a href="Disciplina.php">
                <i class="fa fa-anchor fa-2x"></i>
                <span class="nav-text">
                  Classe
                </span>
              </a>
            </li>
            <li>
              <a href="Disciplina.php">
                <i class="fa fa-anchor fa-2x"></i>
                <span class="nav-text">
                  Turmas
                </span>
              </a>
            </li>
          </ul>

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
              Logout
              <form action="../DAO/processamento.php" method="post">
                             <input type="submit" name='fecharSecao'>
                           </form> 
            </span>
          </a>
        </li>
      </ul>
    </nav>
  </div>