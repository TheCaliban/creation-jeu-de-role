<?php

    require_once('../connect.php');
    require_once('../add-ons/include/secure.php');

    $q_select_class_race = $bdd->prepare('SELECT ID_Classe, Classe FROM Class');

    $title = "Race";

?>

<!DOCTYPE html>


<html>

    <?php

        include('../add-ons/include/header.php');

    ?>
    
    <body>        
        
        
    <div class="wrapper">
        
        <?php
            
            include('../add-ons/include/menu.php');
        
        ?>

        <!-- Page Content  -->
        <div id="content">
				
            <?php

                include('../add-ons/include/navbar.php');

            ?>
            
            <br/>


            <div class="container-fluid">
                
                <div class="row">
                
                    <div class="col-md-6">
                    
                        <div class="row col-md-12">

                            <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createRace" aria-expanded="false" aria-controls="createRace">
                                Créer votre race
                            </button>
                            
                        </div>
                    
                    </div>
                
                </div>
                                
                <div class="row">

                    <div class="col-md-12">
                        
                        <div class="row">

                            <div class="collapse col-md-12" id="createRace">
                                
                                <br/>

                                <form id="createRaceForm">

                                    <div class="form-row">

                                        <div class="form-group col-md-6">

                                            <label for="inputID">Identifiant race</label>
                                            <input type="text" name="inputID" id="inputID" class="form-control" maxlength="5" required/>

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label for="inputRace">Libellé race</label>
                                            <input type="text" name="inputRace" id="inputRace" class="form-control" maxlength="255" required/>

                                        </div>


                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-2">

                                            <label for="strenght">Bonus de force</label>
                                            <input type="number" name="strenght" id="strenght" class="form-control" required/>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="dexterity">Bonus de dextérité</label>
                                            <input type="number" name="dexterity" id="dexterity" class="form-control" required/>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="constitution">Bonus de constitution</label>
                                            <input type="number" name="constitution" id="constitution" class="form-control" required/>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="intelligence">Bonus d'intelligence</label>
                                            <input type="number" name="intelligence" id="intelligence" class="form-control" required/>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="wisdom">Bonus de sagesse</label>
                                            <input type="number" name="wisdom" id="wisdom" class="form-control" required/>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="charisma">Bonus de charisme</label>
                                            <input type="number" name="charisma" id="charisma" class="form-control" required/>

                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group col-md-3">

                                            <label for="level">Ajustement de niveau</label>
                                            <input type="number" name="level" id="level" min="0" max="100" class="form-control" required />            

                                        </div>

                                        <div class="form-group col-md-4 offset-md-1">

                                            <label for="inputClass">Classe de prédilection</label>
                                            <select name="inputClass" class="form-control" id="inputClass" required>
                                                <option value="none">Aucune</option>

                                                <?php

                                                    $q_select_class_race->execute();

                                                    while($data_class_race = $q_select_class_race->fetch())
                                                    {
                                                        echo '<option value="' .$data_class_race['ID_Classe']. '">' .$data_class_race['Classe']. '</option>';
                                                    }

                                                ?>

                                            </select>        

                                        </div>

                                        <div class="form-group col-md-3 offset-md-1">

                                            <label for="inputSize">Taille</label>
                                            <select class="form-control" id="inputSize" name="inputSize">
                                                <option value="M">M</option>
                                                <option value="P">P</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-12 text-right">

                                            <button type="button" class="btn btn-success" id="createButton">Créer</button>
                                            <button type="reset" class="btn btn-danger" id="resetButton">Reset</button>

                                        </div>

                                    </div>

                                </form>

                            </div>
                            
                        </div>

                    </div>


                </div>
                
                <hr>
                
                <div class="row">
                    
                    <div class="col-md-12">
                        
                        <table class="table table-dark text-center">
                        
                            <thead>
                                <tr>
                                    <th>Identifiant race</th>
                                    <th>Nom de la race</th>
                                    <th>Force</th>
                                    <th>Dextérité</th>
                                    <th>Constitution</th>
                                    <th>Intelligence</th>
                                    <th>Sagesse</th>
                                    <th>Charisme</th>
                                    <th>Ajustement de niveau</th>
                                    <th>Classe de prédilection</th>
                                    <th>Taille</th>
                                    <th>Del. ?</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                
                                <?php


                                    $q_select_race = $bdd->prepare('SELECT ID_Race, Race, StrenghtAdjustement AS SA, DexterityAdjustement AS DA, ConstitutionAdjustement AS CA, IntelligenceAdjustement AS IA, WisdomAdjustement AS WA, CharismaAdjustement AS ChA, LevelAdjustement AS LA, ID_Classe_Predilection AS IDCP, Size FROM Race');

                                    $q_select_race->execute();

                                    while($data_race = $q_select_race->fetch())
                                    {

                                        echo "<tr>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-id'>" .$data_race['ID_Race']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-race'>" .$data_race['Race']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-sa' class='edit'>" .$data_race['SA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-da' class='edit'>" .$data_race['DA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-ca' class='edit' >" .$data_race['CA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-ia' class='edit'>" .$data_race['IA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-wa' class='edit'>" .$data_race['WA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-cha' class='edit'>" .$data_race['ChA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-la' class='edit'>" .$data_race['LA']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-idcp'>" .$data_race['IDCP']. "</td>".
                                                             "<td><span id='" .$data_race['ID_Race']. "-size' class='edit'>" .$data_race['Size']. "</td>".
                                                             "<td><button type='button' class='delete close mr-3' id='" .$data_race['ID_Race']. "' aria-label='Close'><i class='fas fa-times' aria-hidden='true' style='color: red;'></i></button></td>".
                                                         "</tr>";
                                    }

                                    $q_select_race->closeCursor();


                                ?>  


                            </tbody>
                        
                        </table>
                        
                    </div>
                    
                </div>
                
            </div>

        </div>
			
    </div>
        

    <div class="overlay"></div>

    
        
    
    </body>

    <?php

        include('../add-ons/include/footer.php');

    ?>


    <script type="text/javascript">
        

        $("#alertSuccess").hide();

        
        $(document).ready(function () {
       
            $(".delete").on('click', function(){
                var id = $(this).attr("id");
                
                console.info("delete");

                $.ajax({
                    url: '/add-ons/deleteRace.php',
                    type: 'POST',
                    data: "id=" + id,
                    success: function(data){
                        loadAlert("Votre ligne a bien été supprimé");                        
                    },
                    error: function(data){
                        console.error("Erreur ajax delete button");
                        console.log(data);
                        
                        location.reload();
                    },
                    complete: function(){
                        reloadTable();
                    }
                    
                });
                
                console.info("delete complete");
            });

            
            
            $("#createButton").on('click', function(){
                
                let idRace, race, strenght, dexterity, constitution, intelligence, wisdom, charisma, classe, level, size;
                
                idRace = $("#inputID").val();
                race = $("#inputRace").val();
                strenght = $("#strenght").val();
                dexterity = $("#dexterity").val();
                constitution = $("#constitution").val();
                intelligence = $("#intelligence").val();
                wisdom = $("#wisdom").val();
                charisma = $("#charisma").val();
                level = $("#level").val();
                classe = $("#inputClass").val();
                size = $("#inputSize").val();
                
                console.info("create button");
                
                if(idRace != "" && race != "" && strenght != "")
                {
                    $.ajax({
                        url: '/add-ons/createRace.php',
                        type: 'POST',
                        data: 'idRace=' + idRace.toUpperCase() +
                              '&race=' + race +
                              '&strenght=' + strenght +
                              '&dexterity=' + dexterity +
                              '&constitution=' + constitution +
                              '&intelligence=' + intelligence +
                              '&wisdom=' + wisdom +
                              '&charisma=' + charisma +
                              '&level=' + level +
                              '&classe=' + classe +
                              '&size=' + size,
                        success: function(data) {
                            
                            $("#createRaceForm")[0].reset();
                            $("#inputID").removeClass("is-invalid");
                            $("#inputRace").removeClass("is-invalid"); 
                            
                            loadAlert();
                        },
                        error: function(data){
                            console.error('Erreur ajax create button');
                            console.log(data);
                        },
                        complete: function(){
                            reloadTable();
                        }
                    });
                }
                else
                {
                    $("#inputID").addClass("is-invalid");
                    $("#inputRace").addClass("is-invalid");
                }
                
                console.info("create button complete");

            });
            
            function reloadTable()
            { 
                var tmp = "";
                
                console.info("Reload table");
                
                $.ajax({
                    url: "/add-ons/reloadTableRace.php",
                    dataType: 'json',
                    success: function(data){
                        data.forEach(function(subArray){

                            id = subArray.id;
                            idcp = (subArray.classe == "none") ? "" : subArray.classe;

                            tmp += "<tr>" +
                                     "<td><span id='" + id + "-id'>"  + id + "</td>" +
                                     "<td><span id='" + id + "-race'>" + subArray.race + "</td>" +
                                     "<td><span id='" + id + "-sa' class='edit'>" + subArray.strenght + "</td>" +
                                     "<td><span id='" + id + "-da' class='edit'>" + subArray.dexterity + "</td>" +
                                     "<td><span id='" + id + "-ca' class='edit' >" + subArray.constitution + "</td>" +
                                     "<td><span id='" + id + "-ia' class='edit'>" + subArray.intelligence + "</td>" +
                                     "<td><span id='" + id + "-wa' class='edit'>" + subArray.wisdom + "</td>" +
                                     "<td><span id='" + id + "-cha' class='edit'>" + subArray.charisma + "</td>" +
                                     "<td><span id='" + id + "-la' class='edit'>" + subArray.level + "</td>" +
                                     "<td><span id='" + id + "-idcp'>" + idcp + "</td>" +
                                     "<td><span id='" + id + "-size' class='edit'>" + subArray.size + "</td>" +
                                     "<td><button type='button' class='delete close mr-3' id='" + id + "' aria-label='Close'><i class='fas fa-times' aria-hidden='true' style='color: red;'></i></button></td>" +
                                 "</tr>"
                        });
                        
						//~ if($("#checkbox-edit").is(":checked"))
						//~ {
							//~ $("#checkbox-edit").attr('checked', false);
						//~ }

                    },
                    error: function(data) {
                        console.error("Erreur ajax reload");
                        console.log(data);
                    },
                    complete: function() {
                        $("tbody").html(tmp);
                    }
                });

                console.info("Reload table complete");

            }
				
			//~ var value_cell, new_value_cell;
			//~ var id_cell, new_id_cell;
			//~ 
			//~ console.info("Reload data");
//~ 
			//~ $('.edit').on("focus", function() {
//~ 
				//~ value_cell = $(this).text();
				//~ id_cell = $(this).attr('id');
//~ 
			//~ }).focusout(function() {
//~ 
				//~ new_value_cell = $(this).text();
				//~ console.log(new_value_cell, value_cell);
//~ 
				//~ if(value_cell != new_value_cell)
				//~ {
					//~ var id_race = id_cell.split('-')[0];
//~ 
					//~ $.ajax({
						//~ url: "/add-ons/updateRace.php",
						//~ type: 'POST',
						//~ data: "ID_Race=" + id_race + "&Race=" + $("#" + id_race + "-race").text() + "&SA=" + $("#" + id_race + "-sa").text() + "&DA=" + $("#" + id_race + "-da").text() + "&CA=" + $("#" + id_race + "-ca").text() + "&IA=" + $("#" + id_race + "-ia").text()  + "&WA=" + $("#" + id_race + "-wa").text() + "&ChA=" + $("#" + id_race + "-cha").text() + "&LA=" + $("#" + id_race + "-la").text() + "&IDCP=" + $("#" + id_race + "-idcp").text() + "&Size=" + $("#" + id_race + "-size").text(),
						//~ success: function (data) {
							//~ reloadTable();
//~ 
						//~ },
						//~ error: function(data) {
							//~ console.error("Erreur ajax reload data");
							//~ console.log(data);
						//~ }
					//~ });
//~ 
				//~ }
			//~ });
			//~ 
			//~ console.info("Reload data complete");

            function loadAlert(text = "Votre saisie s'est bien déroulé ^^")
            {
                $("#alertSuccess").html(text);

                $("#alertSuccess").fadeTo(2000, 500).slideUp(500, function(){
                    $("#alertSuccess").slideUp(500);
                });
            }
                        
        });
        

            
        
    </script>
    
</html>
