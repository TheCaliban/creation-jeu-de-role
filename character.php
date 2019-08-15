<?php 

    session_start();
    require_once('connect.php');
    const MAXCLASS = 5;

    $q_select_race            = $bdd->prepare('SELECT ID_Race, Race FROM Race ORDER BY Race');
    $q_select_class           = $bdd->prepare('SELECT ID_Classe, Classe FROM Class ORDER BY Classe');
    $q_select_prestige_class  = $bdd->prepare('SELECT ID_ClasseP, ClasseP FROM PrestigeClass ORDER BY ClasseP');

    $q_select_class->execute();
    $arr_id_class = [];
    $arr_class = [];

    while($data_select_class = $q_select_class->fetch())
    {
        array_push($arr_id_class, $data_select_class['ID_Classe']);
        array_push($arr_class, $data_select_class['Classe']);
    }							
								

    $q_select_class->closeCursor();

    $title = "Création de personnage";
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
						
			<div class="container-fluid" style="width:80%;">
				
				
				<div class="form-row">
				
					<div class="form-group col-md-12">
					
						<label for="inputName">Nom de votre personnage</label>
						<input type="text" class="form-control" id="inputName" name="inputName" aria-describedby="inputNameHelp" placeholder="Nom du personnage" required />
											
					</div>
				
				
				</div>

				<div class="form-row">
								
					<div class="form-group col-md-12">
						
						<label for="select-character-race">Race</label>
						<select class="form-control" id="select-character-race" required>
							<option value="IGN" selected>Aucune</option>
							<?php
							
							 
								$q_select_race->execute();

								while($data_select_race = $q_select_race->fetch())
								{
									echo '<option value="' .$data_select_race['ID_Race']. '">' .$data_select_race['Race']. '</option>';
								}
							
							
								$q_select_race->closeCursor();
							
							?>
						</select>
						<small id="inputRaceHelp" class="form-text text-muted"></small>

					</div>
					
				</div>
				
				<br/>
                
                

                
                <div id="global_content"> <!-- Parent to append -->
								
                    <div class="form-row" id="select-character-1">

                        <!-- Gestion de la classe -->
                        <div class="form-group col-md-3">

                            <label for="select-character-class">Classe</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend" id="add">


                                    <label class="input-group-text"><i class="fas fa-plus-circle" style="cursor: pointer;"></i></label>

                                </div>

                                <select class="form-control" id="select-character-class" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
                                    <option value="IGN" selected>Aucune</option>
                                    <?php

                                        for($i = 0; $i < min(sizeof($arr_class), sizeof($arr_id_class)); $i++)
                                        {
                                            echo '<option value="' .$arr_id_class[$i]. '">' .$arr_class[$i]. '</option>';
                                        }

                                    ?>
                                </select>    

                            </div>

                        </div>

                        <!-- Gestion du niveau -->


                        <div class="form-group col-md-2">

                            <label for="select-character-level-class">Niveau</label>
                            <input type="number" name="select-character-level-class" id="select-character-level-class" class="form-control" min="1" max="30" maxlength="2" value="1" required />

                        </div>


                        <!-- Gestion de la classe de prestige -->


                        <div class="form-group offset-md-2 col-md-3">

                            <label for="select-character-prestige-class">Classe de prestige</label>
                            <select class="form-control" id="select-character-prestige-class" required>
                                <option value="-1" selected>Aucune</option>
                                <?php

                                    $q_select_prestige_class->execute();


                                    while($data_select_prestige_class = $q_select_prestige_class->fetch())
                                    {
                                        echo '<option value="' .$data_select_prestige_class['ID_ClasseP']. '">' .$data_select_prestige_class['ClasseP']. '</option>';
                                    }


                                    $q_select_race->closeCursor();

                                ?>

                            </select>

                        </div>


                        <!-- Gestion niveau de la classe de prestige -->


                        <div class="form-group col-md-2">

                            <label for="select-character-level-prestige-class">Niveau</label>
                            <select class="form-control" id="select-character-level-prestige-class">
                                <option value selected>0</option>

                            </select>

                        </div>

                    </div>
                    
                </div>
                
                
                
                <!-- FIN Formulaire principal -->
                
                
                <?php
                
                    for($i = 2; $i <= MAXCLASS; $i++)
                    {

                            echo "<div class='form-row' id='select-character-$i' style='display: none;'>

                                <div class='form-group col-md-3'>

                                    <label for='select-character-$i-class'>Classe</label>
                                    <div class='input-group mb-3'>

                                        <div class='input-group-prepend'>


                                            <label class='input-group-text'><i class='fas fa-plus-circle' style='cursor: pointer;'></i></label>

                                        </div>

                                        <select name='select-character-class[]' class='form-control' id='select-character-$i-class'>
                                            <option value selected>Aucune</option>";

                                                for($j = 0; $j < min(sizeof($arr_class), sizeof($arr_id_class)); $j++)
                                                {
                                                    echo '<option value="' .$arr_id_class[$j]. '">' .$arr_class[$j]. '</option>';
                                                }

                                        echo "</select>    

                                    </div>

                                </div>

                                <div class='form-group col-md-2'>

                                    <label for='select-character-$i-level-class'>Niveau</label>
                                    <input type='number' name='select-character-$i-level-class' id='select-character-$i-level-class' class='form-control' min='1' max='30' maxlength='2' value='1' required />

                                </div>				


                            </div>";


                    }
                
                ?>
                
                <hr>
                
                <div class="form-row">
                
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-force">Force</label>
                        <select name="select-character-stat-force" class="form-control select-character-stat" id="select-character-stat-force">
                            <option value selected></option>
                        </select>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-dexterite">Dextérité</label>
                        <select name="select-character-stat-dexterite" class="form-control select-character-stat" id="select-character-stat-dexterite">
                            <option value selected></option>
                        </select>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-constitution">Constitution</label>
                        <select name="select-character-stat-constitution" class="form-control select-character-stat" id="select-character-stat-constitution">
                            <option value selected></option>
                        </select>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-intelligence">Intelligence</label>
                        <select name="select-character-stat-intelligence" class="form-control select-character-stat" id="select-character-stat-intelligence">
                            <option value selected></option>
                        </select>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-sagesse">Sagesse</label>
                        <select name="select-character-stat-sagesse" class="form-control select-character-stat" id="select-character-stat-sagesse">
                            <option value selected></option>
                        </select>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-charisme">Charisme</label>
                        <select name="select-character-stat-charisme" class="form-control select-character-stat" id="select-character-stat-charisme">
                            <option value selected></option>
                        </select>
                            
                    </div>
                    
                    <button type="button" class="btn btn-default" id="generate_button">Générer</button>
                
                </div>

                
                <hr>
                
                <div class="form-row" style="color: red;">
                
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-force">Bonus de Force</label>
                        <span name="select-character-stat-force-race" class="form-control-plaintext select-character-stat-race" id="select-character-stat-force-race" ></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-dexterite-race">Bonus de Dextérité</label>
                        <span name="select-character-stat-dexterite-race" class="form-control-plaintext select-character-stat-race" id="select-character-stat-dexterite-race" ></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-constitution-race">Bonus de Constitution</label>
                        <span name="select-character-stat-constitution-race" class="form-control-plaintext select-character-stat-race" id="select-character-stat-constitution-race" ></span>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-intelligence-race">Bonus de Intelligence</label>
                        <span name="select-character-stat-intelligence-race" class="form-control-plaintext select-character-stat-race" id="select-character-stat-intelligence-race"></span>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-sagesse-race">Bonus de Sagesse</label>
                        <span name="select-character-stat-sagesse-race" class="form-control-plaintext select-character-stat-race" id="select-character-stat-sagesse-race"></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-stat-charisme">Bonus de Charisme</label>
                        <span class="form-control-plaintext select-character-stat-race" id="select-character-stat-charisme-race"></span>
                        
                    </div>
                
                </div>
                
                <br/>
                
                <hr/>
                
                <div class="form-row">
                
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-force">Force</label>
                        <span name="select-character-force" class="form-control-plaintext select-character-stat-race" id="select-character-force" ></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-dexterite">Dextérité</label>
                        <span name="select-character-dexterite" class="form-control-plaintext select-character-stat-race" id="select-character-dexterite" ></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-constitution">Constitution</label>
                        <span name="select-character-constitution" class="form-control-plaintext select-character-race" id="select-character-constitution" ></span>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-intelligence">Intelligence</label>
                        <span name="select-character-intelligence" class="form-control-plaintext select-character-race" id="select-character-intelligence"></span>

                    </div>

                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-sagesse-race">Sagesse</label>
                        <span name="select-character-sagesse" class="form-control-plaintext select-character-race" id="select-character-sagesse"></span>

                    </div>
                    
                    <div class="form-group col-md-2 col-6">
                        <label for="select-character-charisme">Charisme</label>
                        <span name="select-character-charisme" class="form-control-plaintext select-character-race" id="select-character-charisme"></span>
                        
                    </div>
                
                </div>
                
                <br/>
                
                <hr/>
            
                <div class="form-row">
            
                        herbert
                    
                </div>
																
			</div> <!-- container -->
				
		</div>
			
	</div>
		

    <div class="overlay"></div>

    <?php

        include('add-ons/include/footer.php');

    ?>


    <script type="text/javascript">
        
        $(document).ready(function () {
            
            var old_value;
            var i = 1;
            var arr_stat_label = {FOR: 0, DEX: 0, CON: 0, INT: 0, SAG: 0, CHA: 0};
            
            // Affichage classe conseillé pour race

            $("#select-character-race").on("change", function() {
                
                let value = $(this).val();

                $.ajax({
                    url: "/add-ons/ajax_index.php",
                    type: 'POST',
                    data: "id_character=" + value + "&predilection",
                    success: function (data) {
                        $("#inputRaceHelp").html(data);
                        reloadStatRace();
                    }
                });
            });
            
            // Affichage level classe de prestige
            
            $("#select-character-prestige-class").on("change", function() {
                $.ajax({
                    url: "/add-ons/ajax_index.php",
                    type: 'POST',
                    data: "id=" + $("#select-character-prestige-class").val() + "&level",
                    success: function (data) {
                        $("#select-character-level-prestige-class").html(data);
                        console.info('Ajax prestige class ok');
                    },
                    error: function() {
                        console.log("erreur");
                    }
                });

            });
            
            // Ajout classe
            
            $("#add").click(function(){
                if(i < 5)
                {
                    i++;
                    $("#global_content").append('<div class="form-row" id="select-character-' + i + '"><div class="form-group col-md-3"><label for="select-character-class">Classe</label><div class="input-group mb-3"><div class="input-group-prepend" id="add"><label class="input-group-text"><i class="fas fa-minus-circle button_remove" id="' + i + '" style="cursor: pointer;"></i></label></div><select class="form-control" id="select-character-class"><option value selected>Aucune</option><?php for($i = 0; $i < min(sizeof($arr_class), sizeof($arr_id_class)); $i++){       echo '<option value="' .$arr_id_class[$i]. '">' .$arr_class[$i]. '</option>';}?></select></div></div><!-- Gestion du niveau --><div class="form-group col-md-2"><label for="select-character-level-class">Niveau</label><input type="number" name="select-character-level-class" id="select-character-level-class" class="form-control" min="1" max="30" maxlength="2" value="1" required /></div></div>');
                }

            });
            
            // Supression classe
            
            $(document).on('click', '.button_remove', function(){
                var button_id = $(this).attr("id");
                $("#select-character-" + button_id).remove();
                i--;
            });
            
            // Generation des stats
            
            $("#generate_button").on("click", function(){
                
                var arr_stat;
                var i;
                
                for(var stat_label in arr_stat_label)
                {
                    

                    arr_stat = [];
                    for(i = 0; i < 4; i++)
                    {
                        arr_stat[i] = Math.floor(Math.random() * 6 + 1);
                    }
                    
                    arr_stat.sort();
//                    console.log(arr_stat);
                    arr_stat_label[stat_label] = arr_stat[3] + arr_stat[2] + arr_stat[1];
                }
                
//                console.log(arr_stat_label.force, arr_stat_label.dexterite, arr_stat_label.constitution, arr_stat_label.intelligence, arr_stat_label.sagesse, arr_stat_label.charisme);
                
                reloadDisplaying();

            });
            
            
            $(document).on("focus", ".select-character-stat", function() {
                old_value = $(this).val();
            }).on("change", ".select-character-stat",function() {
                var new_value = $(this).val();
                
                
                var tmp = arr_stat_label[old_value];
                
                arr_stat_label[old_value] = arr_stat_label[new_value];
                arr_stat_label[new_value] = tmp;
                
                reloadDisplaying();
            });
            
            
            $("#select-character-class").change(function(data) {
                
                reloadStatRace();
                
                $.ajax({
                    url: "/add-ons/ajax_index.php",
                    type: 'POST',
                    dataType: 'json',
                    data : 'id=' + $("#select-character-class").val() + "&skill",
                    success: function(data) {
                        var tmp = '';
                        
                        console.log(data);
                        data.forEach(function(elem) {
                           tmp += elem + '<br/>'; 
                        });
                        
                        if(tmp === '') { $('#select-character-class').removeAttr("data-original-title"); }
                        
                        $('#select-character-class').tooltip({html: true, animation: true}).attr('data-original-title', tmp);
                                                              
                        $('#select-character-class').tooltip('update');
                        console.info('Ajax tooltip ok');
                    },
                    error: function(data) {
                        console.error(data);
                        console.error("Erreur tooltips ajax");
                    }
                });
            
            });  
            
            
            function reloadDisplaying()
            {
                
                $("select.select-character-stat").html( '<option value="FOR">' + arr_stat_label.FOR + '</option>' +
                                                        '<option value="DEX">' + arr_stat_label.DEX + '</option>' +
                                                        '<option value="CON">' + arr_stat_label.CON + '</option>' + 
                                                        '<option value="INT">' + arr_stat_label.INT + '</option>' +
                                                        '<option value="SAG">' + arr_stat_label.SAG + '</option>' +
                                                        '<option value="CHA">' + arr_stat_label.CHA + '</option>');
                
                $("#select-character-stat-force").val("FOR");
                $("#select-character-stat-dexterite").val("DEX");
                $("#select-character-stat-constitution").val("CON");
                $("#select-character-stat-intelligence").val("INT");
                $("#select-character-stat-sagesse").val("SAG");
                $("#select-character-stat-charisme").val("CHA");
                
                reloadStatRace();

            }
            
            function reloadStatRace()
            {
                
                if($("#select-character-race").val() != "IGN" && arr_stat_label.FOR != 0 && $("#select-character-class").val() != "IGN")
                {

                    $.ajax({
                        url: '/add-ons/ajax_index.php',
                        type: 'POST',
                        dataType: 'json',
                        data: 'id=' + $("#select-character-race").val(),
                        success: function(data) {
                            $("#select-character-stat-force-race").text(arr_stat_label.FOR + " + (" + data[0] + ")");
                            $("#select-character-stat-dexterite-race").text(arr_stat_label.DEX + " + (" + data[1] + ")");
                            $("#select-character-stat-constitution-race").text(arr_stat_label.CON + " + (" + data[2] + ")");
                            $("#select-character-stat-intelligence-race").text(arr_stat_label.INT + " + (" + data[3] + ")");
                            $("#select-character-stat-sagesse-race").text(arr_stat_label.SAG + " + (" + data[4] + ")");
                            $("#select-character-stat-charisme-race").text(arr_stat_label.CHA + " + (" + data[5] + ")");
                            
                            $("#select-character-force").text((parseInt(arr_stat_label.FOR) + parseInt(data[0])));
                            $("#select-character-dexterite").text((parseInt(arr_stat_label.DEX) + parseInt(data[1])));
                            $("#select-character-constitution").text((parseInt(arr_stat_label.CON) + parseInt(data[2])));
                            $("#select-character-intelligence").text((parseInt(arr_stat_label.INT) + parseInt(data[3])));
                            $("#select-character-sagesse").text((parseInt(arr_stat_label.SAG) + parseInt(data[4])));
                            $("#select-character-charisme").text((parseInt(arr_stat_label.CHA) + parseInt(data[5])));
                        },
                        error: function(data){
                            console.log("erreur");
                        }
                    });

                }
            }
            
            
    });

    

    </script>
    
</body>

</html>
