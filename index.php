<?php

    session_start();

    $title = "Accueil";
    
    $state1 = 30; // nos interfaces
    $state2 = 15; // leurs interfaces
    $state3 = 0; // documentation
    $state4 = 0; // lancement du site
    $state5 = 0; // insertion de nouvelles données

?>


<!DOCTYPE html>
<html>

<?php

    include('add-ons/include/header.php');

?>


<body>

    <div class="wrapper">

        <?php

            include('add-ons/include/menu.php');
        
        ?>

        <!-- Page Content  -->
        <div id="content">

        <?php

            include('add-ons/include/navbar.php');
        
        ?>
            <br/>
            
            <div class="container">
                
                
                <div class="row">
                
                    <div class="col-md-12">
                    
                        <h1 class="text-center">Bienvenue sur notre site</h1>
                        
                    </div>
                
                </div>
                
                <br/>
                
                <div class="row">
                    
                    <div class="col-md-12 text-center">
                
                        Nous sommes deux camarades d'enfance adorateurs de jeux de rôles à la <abbr title="Dungeon and Dragons">D & D</abbr> depuis de nombreuses années.
                        
                        <br/>
                        <br/>
                        
                        Étant nous même joueurs et/ou <abbr title="Maitre du jeu">MJ</abbr> nous avons dû affrontés de nombreuses fois la création de nos personnages avec d'autres membres (ce qui n'est pas la partie la plus passionante pour tout le monde&nbsp;--').
                        
                        <br/>
                        <br/>
                        
                        Cette étape fastidieuse couplé à des mates peu motivé par cette tâche nous a apportés une idée ! <br><i style='font-size:1.2em;'>'pourquoi ne pas avoir un soft qui nous permet de générer nos personnages'</i><br/>
                        Idée basique, enfin celà doit déjà exister . . . 
                        
                        <br/>
                        <br/>
                        
                        Bon je pense que vous comprenez donc pourquoi ce site est la  ^^
                        
                        <br/>
                        <br/>
                        
                        Vous pourrez retrouver à court/moyen/long/(jamais) terme les différentes fonctionnalités que nous souhaitons implémenter.

                    
                    </div>
                    
                </div>
                
                <br/>
                <br/>
                
                
                <div class="row">


                    <div class="col-md-7 offset-md-2">

                        <h3>
                            <u>Nos objectifs: </u>
                        </h3>
                        
                        <dl class="offset-md-1">
                            <br/>
                            <dt>Constituer notre interface  <i class="d-none fas fa-check"></i></dt>
                                <dd>
                                    Tout ce qui nous permettra d'ajouter de la donnée et nos jeux de test. <br/>
                            
                                <?php 
									if($state1 > 0)
									{
										?>
									<div class="progress" style="text-align: center;">
											<span style="left: 45%; position: absolute;">Etat d'avancement : <?php echo $state1; ?>%</span>
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $state1; ?>" aria-valuemin="0" aria-valuemax="100" style=" width: <?php echo $state1; ?>%;">
											   
											</div>
										</div>
										<?php
									}
								?>
                                </dd>
                            
                            <dt>Constituer votre interface  <i class="d-none fas fa-check"></i></dt>
                                <dd>
									Vos formulaires de créations.
                                
                                <?php 
									if($state2 > 0)
									{
										?>
									<div class="progress" style="text-align: center;">
											<span style="left: 45%; position: absolute;">Etat d'avancement : <?php echo $state2; ?>%</span>
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $state2; ?>" aria-valuemin="0" aria-valuemax="100" style=" width: <?php echo $state2; ?>%;">
											   
											</div>
										</div>
										<?php
									}
								?>
									
									
								</dd>
                                
                                
                            
                            <dt>Création d'un Wiki  <i class="d-none fas fa-check"></i></dt>
                                <dd>Indication sur le fonctionnement des JDR, du site et nos sources.
                                
                                <?php 
									if($state3 > 0)
									{
										?>
										<div class="progress" style="text-align: center;">
											<span style="left: 45%; position: absolute;">Etat d'avancement : <?php echo $state3; ?>%</span>
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $state3; ?>" aria-valuemin="0" aria-valuemax="100" style=" width: <?php echo $state3; ?>%;">
											   
											</div>
										</div>
										<?php
									}
								?>
									
									
								</dd>
                            
                            <dt>Release du site  <i class="d-none fas fa-check"></i></dt>
                                <dd>
									Première annonce, le site sera prêt à être utilisé !
                                <?php 
									if($state4 > 0)
									{
										?>
										<div class="progress" style="text-align: center;">
											<span style="left: 45%; position: absolute;">Etat d'avancement : <?php echo $state4; ?>%</span>
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $state4; ?>" aria-valuemin="0" aria-valuemax="100" style=" width: <?php echo $state4; ?>%;">
											   
											</div>
										</div>
										<?php
									}
								?>
									
								</dd>
                            
                            <dt>Insertion de nouvelles données  <i class="d-none fas fa-check"></i></dt>
                                <dd>On remplie notre base de données pour vous donner encore plus de choix. <br/>
                                Cela nous demande beaucoup de temps en recherche et peut-être des ajustements sur le site.
                                
                                <?php 
									if($state5 > 0)
									{
										?>
										<div class="progress" style="text-align: center;">
											<span style="left: 45%; position: absolute;">Etat d'avancement : <?php echo $state5; ?>%</span>
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $state5; ?>" aria-valuemin="0" aria-valuemax="100" style=" width: <?php echo $state5; ?>%;">
											   
											</div>
										</div>
										<?php
									}
								?>
									
									
								</dd>
                        </dl>

                    </div>

                </div>
                
            </div>
            
            
        </div>
    </div>

    <div class="overlay"></div>

    <?php

        include('add-ons/include/footer.php');

    ?>

    
</body>

</html>
