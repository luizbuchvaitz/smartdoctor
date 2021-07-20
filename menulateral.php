        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="foto" width="80" height="80" class="img-circle" src="<?php echo $defoto; ?>" />
                                 </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $deusua; ?></strong>
                                 </span> <span class="text-muted text-xs block"><?php echo $detipo; ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="meusdados.php">Alterar Meus Dados</a></li>
                                <li><a href="minhasenha.php">Alterar Minha Senha</a></li>
                                <li class="divider"></li>
                                <li><a href="index.html">Sair</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i><span class="nav-label">Menu Principal</span></a>
                    </li>
                    <?php if ($cdtipo == 'A'){?>
                        <li>
                            <a href="index.php"><i class="fa fa-edit"></i><span class="nav-label">Administração</span><span class="caret"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <?php if (count(Acesso("1.1",$cdnive))>0){?>
                                    <li><a href="usuarios.php">Usuários</a></li>
                                <?php }?>
                                
                                <?php if (count(Acesso("1.2",$cdnive))>0){?>
                                    <li><a href="parametros.php">Parâmetros</a></li>
                                <?php }?>
                                
                                

                                <!-- Registra em um log, todos acessos e alterações feitas no sistema-->
                                <?php if (count(Acesso("1.5",$cdnive))>0){?>
                                <!--    <li><a href="log.php">Histórico de Ações</a></li>-->
                                <?php }?>


                            </ul>
                        </li>
                    <?php }?>

                    <?php if (count(Acesso("2.7",$cdnive))>0){?>
                        <li>
                            <?php if ($cdtipo == 'A' or $cdtipo == 'F' or $cdtipo == 'M'){?>
                                <a href="agenda.php?filtro=null&chave=null"><i class="fa fa-calendar"></i><span class="nav-label">Agenda</span></a>
                            <?php }?>
                            <?php if ($cdtipo == 'P'){?>
                                <a href="agenda.php"><i class="fa fa-calendar"></i><span class="nav-label">Minhas Consultas</span></a>
                            <?php }?>    
                        </li>
                    <?php }?>

                    <!-- Da permissão para "A" - Administrador, "F" - Funcionário e "M" - Médico Visualizar lista de planos-->
                    <?php if ($cdtipo == 'A' or $cdtipo == 'F' or $cdtipo == 'M'){?>
                        <li>
                            <a href="planos.php"><i class="fa fa-hospital-o"></i><span class="nav-label">Planos de Saúde</span></a>
                        </li>
                    <?php }?>
                    <!-- Da permissão para "A" - Administrador e "F" - Funcionário Visualizar lista de médicos-->
                    <?php if ($cdtipo == 'A' or $cdtipo == 'F'){?>
                        <li>
                            <a href="medicos.php"><i class="fa fa-user-md"></i><span class="nav-label">Médicos</span></a>
                        </li>
                    <?php }?>

                    <!-- Da permissão para "A" - Administrador, "F" - Funcionário e "M" - Médico" Visualizar lista de pacientes-->
                    <?php if ($cdtipo == 'A' or $cdtipo == 'F' or $cdtipo == 'M'){?>
                        <li>
                            <a href="pacientes.php"><i class="fa fa-male"></i><span class="nav-label">Pacientes</span></a>
                        </li>
                    <?php }?>

                    <!-- Da permissão para "A" - Administrador "M" - Médico" Visualizar lista de prontuários-->
                    <?php if ($cdtipo == 'A' or $cdtipo == 'M'){?>
                        <li>
                            <a href="prontuario.php"><i class="fa fa-edit"></i><span class="nav-label">Prontuário</span></a>
                        </li>
                    <?php }?>

                    <!-- Da permissão somente para "A" - Administrador" Visualizar lista de contas-->
                </ul>
            </div>
        </nav>
