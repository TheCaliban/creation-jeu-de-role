<?php

    require_once('../connect.php');
    require_once('../add-ons/include/secure.php');

    $q_select_char = $bdd->prepare('SELECT ClasseP, ID_ClasseP FROM PrestigeClass'); // WHERE ID_ClasseP IN (SELECT DISTINCT ID_Classe FROM SkillToPrestigeClass)
    
    $title = "Classe de prestige";

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
                                                echo "<option value='" .$data_char['ID_ClasseP']. "'>" .$data_char['ClasseP']. "</option>";
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

            </div>            
			
        </div>
				
    </div>
        
    <!-- Modal -->
    <div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassModal" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Créer votre classe de prestige</h5>
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

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-success" id="buttonCreate" onClick='$("#createClass").modal("hide");'>Créer</button>

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
            
        
            $("#select-character").on("change", function(){
                loadSkills($("#select-character"));

            });

            $("#addClasse").click(function() {
                $("#createClass").modal();
            });
            
            $("#buttonCreate").on("click", function() {
                $.ajax({
                    url: "/add-ons/ajax_prestige.php",
                    type: 'POST',
                    data: "id=" 	 + $("#inputID").val() + 
                          "&classe=" + $("#inputClasse").val(),
                    success: function (data) {
                                console.log(data);
                        },
                    failed: function(){
                        console.log("erreur");
                    }
                });
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
				url: "/add-ons/ajax_prestige.php",
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
				url: "/add-ons/ajax_prestige.php",
				type: 'POST',
				data: "id_character=" + selector.val(),
				success: function (data) {
					$("#right_side").html(data);
				}
			});
            
			$.ajax({
				url: "/add-ons/ajax_prestige.php",
				type: 'POST',
				data: "ID_Classe=" + selector.val(),
				success: function (data) {
					$("#listSkills").html(data);
				}
			});
        }
		
    </script>
    
</html>
