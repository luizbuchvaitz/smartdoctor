            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-left">
                        <br>
                        <li>
                            <?php if (strlen(trim($cdpara)) < 14) {?>
                                <span class="m-r-sm text-muted welcome-message fa fa-home"> <?php echo formatar($cdpara,"cpf")." - ".$depara;?></span>
                            <?php }?>
                            <?php if (strlen(trim($cdpara)) > 11) {?>
                                <span class="m-r-sm text-muted welcome-message fa fa-home"> <?php echo formatar($cdpara,"cnpj")." - ".$depara;?></span>
                            <?php }?>
                            <!--&nbsp;-->
                            <!--span><?php echo "Nível de Acesso: ".$cdnive."-".$denive ;?></span-->
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bem-Vindo,
                            <?php print $deusua; ?>
         </span>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                    
                </nav>
            </div>
