<?php

    require_once('../connect.php');
    require_once('../add-ons/include/secure.php');

    $q_select_feat = $bdd->prepare('SELECT * FROM Feat ORDER BY FeatType, Feat ASC');
	
    $title = "Don";

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

				<div class="container">

					<div class="form-row">
						
						<div class="form-group col-md-12">

							<label for="select-character-feat">Dons</label>
							<div class="input-group mb-3">

								<div class="input-group-prepend">

									<label class="input-group-text" id="addFeat"><i class="fas fa-plus-circle" style="cursor: pointer;"></i></label>

								</div>

								<select id="select-character-feat" class="form-control">
									<option value selected></option>
									<?php

										$q_select_feat->execute();
										$type;


										while($data_feat = $q_select_feat->fetch())
										{
											echo "<option value='" .$data_feat['ID_Feat']. "-" .$data_feat['FeatType']. "'>" .$data_feat['Feat']. "</option>";
										}

										$q_select_feat->closeCursor();


									?>
								</select>
								
							</div>

						</div>
						
					</div>
					
					<div class="form-row">
						
						<div class="form-group col-md-12">
						
							<div id="displayedDataFeat"></div>
						
						</div>
						
					</div>
					

					<!-- Modal -->
					<div class="modal fade" id="createFeat" tabindex="-1" role="dialog" aria-labelledby="createFeatModal" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title">Créer votre dons</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
							  
							<form>
							  
								<div class="form-row">
								
									<div class="form-group col-md-6">
									
										<label for="inputID">Identifiant</label>
										<input type="text" class="form-control" id="inputID" name="inputID" maxlength="5" required autofocus/>
									
									</div>
									
									<div class="form-group col-md-6">
									
										<label for="inputFeatType">Type de don</label>
										<select class="form-control" id="inputFeatType" name="inputFeatType">
											<option value selected></option>
											<option value="GENERAL">GENERAL</option>
											<option value="CREATION">CREATION</option>
											<option value="METAMAGIC">METAMAGIC</option>
										
										</select>
									
									</div>
										
								</div>
								
								<div class="form-row">
								
									<div class="form-group col-md-4">
									
										<label for="inputFeatLevel">Niveau</label>
										<input type="number" name="inputFeatLevel" id="inputFeatLevel" class="form-control" min="1" max="30" required />
									
									</div>
									
									<div class="form-group col-md-8">
									
										<label for="inputFeat">Dons</label>
										<input type="text" id="inputFeat" class="form-control" required />
									
									</div>
									
								</div>
								
								<div class="form-row">
									
									<div class="form-group col-md-12">
										<label for="inputDescription">Description</label>
										<textarea id="inputDescription" class="form-control" rows="3" required></textarea>
									
									</div>
								
									<div class="form-group col-md-4">
									
										<label for="inputWT">Warrior Taken</label><br/>
										<select id="inputWT" class="form-control" required>
											<option value="" selected></option>
											<option value="0">Faux</option>
											<option value="1">Vrai</option>
										</select>
									
									</div>
									
									<div class="form-group col-md-4">
									
										<label for="inputMTC">Cumulatif</label>
										<select id="inputMTC" class="form-control" required>
											<option value="" selected></option>
											<option value="0">Faux</option>
											<option value="1">Vrai</option>
										</select>
									
									</div>
									
									<div class="form-group col-md-4">
									
										<label for="inputMTNC">Non cumulatif</label>
										<select id="inputMTNC" class="form-control" required>
											<option value="" selected></option>
											<option value="0">Faux</option>
											<option value="1">Vrai</option>
										</select>
									</div>
										
								</div>

														  
							</form>
							
						  </div>
							
						<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
						<button type="button" class="btn btn-success" id="createButton" onClick='$("#createFeat").modal("hide");'>Créer</button>
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
            
            $("#select-character-feat").change(function() {
				$.ajax({
					url: "/add-ons/listFeat.php",
					type: 'POST',
					data: "ID_Feat=" + $("#select-character-feat").val().split("-")[0] +
						  "&FeatType=" + $("#select-character-feat").val().split("-")[1],
					success: function (data) {
						console.log($("#inputFeatType").val());
						console.log("Data: " + data);
						$("#displayedDataFeat").html(data);
					},
					error: function() {
						console.log("erreur");
					}
				});
			});
			
			$("#addFeat").click(function() {
				$("#createFeat").modal();
			});
			
			$("#inputFeatType").change(function(){
				$.ajax({
					url: '/add-ons/reloadMaxIDFeat.php',
					type: 'POST',
					dataType: 'html',
					data: "featType=" + $("#inputFeatType").val(),
					success: function(data){
						console.log(data);
						
						$("#inputID").val(data);
						
					}
					
				});
			});
            
            
        });
        
        $("#createButton").click(function(){
				featID = $("#inputID").val();
				featType = $("#inputFeatType").val();
				featLevel = $("#inputFeatLevel").val();
				featLabel = $("#inputFeat").val();
				featDesc = $("#inputDescription").val();
				featWT = $("#inputWT").val();
				featMTC = $("#inputMTC").val();
				featMTNC = $("#inputMTNC").val();
				
				$.ajax({
					url: '/add-ons/createFeat.php',
					type: 'POST',
					dataType: 'text',
					data: "id= " + featID +
						  "&type=" + featType +
						  "&level=" + featLevel +
						  "&label=" + featLabel +
						  "&description=" + featDesc +
						  "&wt=" + featWT +
						  "&mtc=" + featMTC +
						  "&mtnc=" + featMTNC,
					success : function(data) {
						console.log(data);
					},
					error: function(){
					}
				});
			});
		
        
        
            
			//~ $.ajax({
				//~ url: "/add-ons/reloadFeat.php",
				//~ type: 'POST',
				//~ data: "ID_Classe=" + selector.val(),
				//~ success: function (data) {
					//~ $("#listSkills").html(data);
				//~ }
			//~ });
		
		
		
        
        
		
    </script>
    
</html>
