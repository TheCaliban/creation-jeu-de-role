<?php 

    session_start();
    require_once('connect.php');

    $title = "Inventaire";
    
    $q_select_armor = $bdd->prepare('SELECT ID_Armor, ArmorType, Armor, Price, ArmorBonus, Weight FROM Armor');
    $q_select_count_armor = $bdd->prepare('SELECT COUNT(*) FROM Armor');
    $q_select_weapon = $bdd->prepare('SELECT Weapon, DamageP, DamageM, Price, CriticalThreshold, CriticalMultiplier, IFNULL(WeaponRange, "Corps à corps"), Weight FROM Weapon');
    $q_select_count_weapon = $bdd->prepare('SELECT COUNT(*) FROM Weapon');

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
                
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a data-toggle="tab" href="#race" class="nav-link">Race</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#class" class="nav-link">Classe</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#weapon" class="nav-link">Arme</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#armor" class="nav-link">Armure</a></li>
                </ul>
                
                <br/>

                <div class="tab-content">
                    
                    
                    <div class="tab-pane fade active show">
                        
                        Ici vous pourrez trouver tout ce que notre armurerie contient ^^
                        
                    </div>
                    
                    <div id="race" class="tab-pane fade">

                    </div>
                    
                    <div id="class" class="tab-pane fade">
                        
                        <div class="container col-md-12"></div>
                        
                    </div>
                    
                    <div id="weapon" class="tab-pane fade">
                        
                        <div class="container col-md-12">
                            
                            <br/>
                            
                            <div class="row">
                            
                                <h2>Nos Armes</h2>
                            
                            </div>
                            
                            <br/>
                            <br/>
                            
                            <?php
                                
                                $q_select_weapon->execute();
                                $q_select_count_weapon->execute();
                                $compteur = 0;
                                
                                while($q_data_weapon = $q_select_weapon->fetch())
                                {
                                    if($compteur == 0) { echo '<small>Il y a ' .$q_select_count_weapon->fetch()[0]. ' résultats</small>'; $q_select_count_weapon->closeCursor();}
                                    
                                    echo ($compteur % 3 == 0) ? '<div class="row">' : '';
                                    
                                    ?>
                                        
                                        <div class="card col-md-4">

                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $q_data_weapon['Weapon']; ?></h5>
                                                <p class="card-text">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Prix (PO)</div>
                                                                <div class="col-md-3"><?php echo $q_data_weapon['Price'];?></div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Dégâts</div>
                                                                <div class="col-md-3"><?php echo $q_data_weapon['DamageP'];?></div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Poids</div>
                                                                <div class="col-md-3"><?php echo $q_data_weapon['Weight'];?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </div>
                                        </div>
                            
                                    <?php
                                    
                                    echo ($compteur % 3 == 2) ? '</div><br/>' : '';
                                    $compteur++;
                                }
                            
                                if($compteur%3 < 2)
                                {
                                    echo '</div><br/>';
                                }
                            
                                $q_select_weapon->closeCursor();
                                
                                    
                            
                            ?>
                        
                        </div>                        

                    </div>
                    
                    <div id="armor" class="tab-pane fade">

                        <div class="container col-md-12">
                            
                            <br/>
                            
                            <div class="row">
                            
                                <h2>Nos Armures</h2>
                            
                            </div>
                            
                            <br/>
                            <br/>
                            
                            <?php
                                
                                $q_select_armor->execute();
                                $q_select_count_armor->execute();
                            
                                $compteur = 0;
                                
                                while($q_data_armor = $q_select_armor->fetch())
                                {
                                    if($compteur == 0) { echo '<small>Il y a ' .$q_select_count_armor->fetch()[0]. ' résultats</small>'; $q_select_count_armor->closeCursor(); }
                                    
                                    echo ($compteur % 3 == 0) ? '<div class="row">' : '';
                                    
                                    ?>
                                        
                                        <div class="card col-md-4">
                                            
<!--
                                            <img class="card-img-top" src="" alt="">
-->
                                            
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $q_data_armor['Armor']; ?></h5>
                                                <p class="card-text">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Prix (PO)</div>
                                                                <div class="col-md-3"><?php echo $q_data_armor['Price'];?></div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Bonus d'armure </div>
                                                                <div class="col-md-3"><?php echo $q_data_armor['ArmorBonus'];?></div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-9">Poids </div>
                                                                <div class="col-md-3"><?php echo $q_data_armor['Weight'];?></div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item container">
                                                            <div class="row">
                                                                <div class="col-md-8">Type d'armure</div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                        switch($q_data_armor['ArmorType'])
                                                                        {
                                                                            case 'LIGHT':
                                                                                echo 'Légère';
                                                                                break;
                                                                            case 'MEDIUM':
                                                                                echo 'Mixte';
                                                                                break;
                                                                            case 'HEAVY':
                                                                                echo 'Lourde';
                                                                                break;
                                                                            default:
                                                                                echo $q_data_armor['ArmorType'];
                                                                                break;
                                                                        }
                                                                        
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </div>
                                        </div>
                            
                                    <?php
                                    
                                    echo ($compteur % 3 == 2) ? '</div><br/>' : '';
                                    $compteur++;
                                }
                            
                                $q_select_armor->closeCursor();
                            
                            ?>
                        
                        </div>                        
                    
                    </div>
                    
                </div>
                
			</div> <!-- container -->
				
		</div>
			
	</div>
		

    <div class="overlay"></div>

    <?php

        include('add-ons/include/footer.php');

    ?>

    
</body>

</html>
