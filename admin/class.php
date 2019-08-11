<?php

    require_once('../connect.php');
    require_once('../add-ons/include/secure.php');

    $q_select_char = $bdd->prepare('SELECT Classe, ID_Classe FROM Class'); //  WHERE ID_Classe IN (SELECT DISTINCT ID_Classe FROM SkillToClass)

    $title = "Classe";

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

            <div class="container-fluid">

                <form>

                    <div class="form-row col-md-12">
                        
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <label for="select-character">Classe</label>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">

                                        <label class="input-group-text" id="addClasse"><i class="fas fa-plus-circle" style="cursor: pointer;"></i></label>

                                    </div>

                                    <select id="select-character" class="form-control">

                                        <?php

                                            $q_select_char->execute();


                                            while($data_char = $q_select_char->fetch())
                                            {
                                                echo "<option value='" .$data_char['ID_Classe']. "'>" .$data_char['Classe']. "</option>";
                                            }

                                            $q_select_char->closeCursor();


                                        ?>
                                    </select>

                                </div>
                            </div>
                            
                            <div class="form-row">
                            
                                <div class="form-group col-md-12 offset-md-1">                            

                                    <div id="listSkills"></div>

                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group offset-md-1 col-md-7" id="right_side">
                            
                        
                        </div>
                        
                    
                        
                    </div>

                </form>
                

                <!-- Modal -->
                <div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassModal" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Créer votre classe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          
                        <form>
                          
                            <div class="form-row">
                            
                                <div class="form-group col-md-6">
                                
                                    <label for="inputID">Identifiant</label>
                                    <input type="text" class="form-control" id="inputID" name="inputID" maxlength="5" placeholder="(Ex: BARB)" required autofocus/>
                                
                                </div>
                                
                                <div class="form-group col-md-6">
                                
                                    <label for="inputClasse">Classe</label>
                                    <input type="text" class="form-control" id="inputClasse" name="inputClasse" maxlength="255" placeholder="Barbare" required/>
                                
                                </div>
                                    
                            </div>
                            
                            <div class="form-row">
                            
                                <div class="form-group col-md-4">
                                
                                    <label for="inputSavRef">Sauv. Réflexe</label>
                                    <select id="inputSavRef" class="form-control" required>
                                        <option value="1">Fort</option>
                                        <option value="0">Faible</option>
                                    </select>
                                
                                </div>
                                
                                <div class="form-group col-md-4">
                                
                                    <label for="inputSavVig">Sauv. Vigueur</label>
                                    <select id="inputSavVig" class="form-control" required>
                                        <option value="1">Fort</option>
                                        <option value="0">Faible</option>
                                    </select>
                                
                                </div>
                                
                                <div class="form-group col-md-4">
                                
                                    <label for="inputSavVol">Sauv. Volonté</label>
                                    <select id="inputSavVol" class="form-control" required>
                                        <option value="1">Fort</option>
                                        <option value="0">Faible</option>
                                    </select>                                
                                </div>
                            
                            </div>
                            
                            <div class="form-row">
                            
                                <div class="form-group col-md-4">
                                
                                    <label for="inputDV">Dé de Vie</label>
                                    <select id="inputDV" class="form-control" required>
										<option value="" selected></option>
                                        <option value="4">D4</option>
                                        <option value="6">D6</option>
                                        <option value="8">D8</option>
                                        <option value="10">D10</option>
                                        <option value="12">D12</option>
                                    </select>
                                
                                </div>
                                
                                <div class="form-group col-md-4">
                                
                                    <label for="inputModAtk">Modif. Attaque</label>
									<select id="inputModAtk" class="form-control" required>
										<option value="" selected></option>
                                        <option value="0">Faible</option>
                                        <option value="1">Moyen</option>
                                        <option value="2">Fort</option>   
                                    </select>
                                
                                </div>
                                
                                <div class="form-group col-md-4">
                                
                                    <label for="inputSkillPoint">Pts. Compétence</label>
                                    <input type="text" class="form-control" id="inputSkillPoint" name="inputSkillPoint" required/>
                                
                                </div>
                                    
                            </div>

                                                      
                        </form>
                        
                      </div>
                        
                    <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
			        <button type="button" class="btn btn-success" id="buttonCreate" onClick='$("#createClass").modal("hide");'>Créer</button>
			      </div>
                    </div>
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
	
        $(document).ready(function () {
            
            loadSkills($("#select-character"));
            
		
            $("#buttonCreate").on("click", function() {
                $.ajax({
                    url: "/add-ons/createClass.php",
                    type: 'POST',
                    data: "id=" 	 + $("#inputID").val() + 
                          "&classe=" + $("#inputClasse").val() +
                          "&savRef=" + $("#inputSavRef").val() +
                          "&savVol=" + $("#inputSavVol").val() +
                          "&savVig=" + $("#inputSavVig").val() +
                          "&dv=" 	 + $("#inputDV").val() +
                          "&modAtq=" + $("#inputModAtk").val() +
                          "&ptsSkills=" + $("#inputSkillPoint").val(),
                    success: function (data) {
                                console.log(data);
                        },
                    failed: function(){
                        console.log("erreur");
                    }
                });
            });
            
            $("#select-character").on("change", function(){
                loadSkills($("#select-character"));

            });

            $("#addClasse").click(function() {
                $("#createClass").modal();
            });   
            
        });
        
        
		function getCheckedCheckbox()
		{
			let chkArray = [];
			
			$(".checkbox_list:checked").each(function() {
				chkArray.push($(this).val());
			});
			
			var jsonString = JSON.stringify(chkArray);
			
			$.ajax({
				url: "/add-ons/addSkills.php",
				type: 'POST',
				data: {data : jsonString , id_classe : $("#select-character").val()},
				success: function (data) {
					
					$("#listSkills").html(data);
				}
			});

		}
        
        function loadSkills(selector)
        {
            $.ajax({
				url: "/add-ons/skillToClass.php",
				type: 'POST',
				data: "id_character=" + selector.val(),
				success: function (data) {
					$("#right_side").html(data);
				}
			});
            
			$.ajax({
				url: "/add-ons/reloadListSkill.php",
				type: 'POST',
				data: "ID_Classe=" + selector.val(),
				success: function (data) {
					$("#listSkills").html(data);
				}
			});
        }

    </script>
    
</html>
