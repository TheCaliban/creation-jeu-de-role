        $(document).ready(function () {
            
            var old_value;
            var i = 1;
            var arr_stat_label = {FOR: 0, DEX: 0, CON: 0, INT: 0, SAG: 0, CHA: 0};

            // Affichage classe conseillé pour race

            $("#select-character-race").on("change", function() {
                
                let value = $(this).val();

                $.ajax({
                    url: "/add-ons/helpRace.php",
                    type: 'POST',
                    data: "id_character=" + value,
                    success: function (data) {
                        $("#inputRaceHelp").html(data);
                        reloadStatRace();
                    }
                });
            });
            
            // Affichage level classe de prestige
            
            $("#select-character-prestige-class").on("change", function() {
                $.ajax({
                    url: "/add-ons/levelClass.php",
                    type: 'POST',
                    data: "id=" + $("#select-character-prestige-class").val(),
                    success: function (data) {
                        $("#select-character-level-prestige-class").html(data);
                        },
                    failed: function(){
                        console.log("erreur");
                    }
                });
            });
            
            // Ajout classe
            
            $("#add").click(function(){
                if(i < 5)
                {
                    i++;
                    $("#global_content").append('<div class="form-row" id="select-character-' + i + '"><div class="form-group col-md-3"><label for="select-character-class">Classe</label><div class="input-group mb-3"><div class="input-group-prepend" id="add"><label class="input-group-text"><i class="fas fa-minus-circle button_remove" id="' + i + '" style="cursor: pointer;"></i></label></div><select class="form-control" id="select-character-class"><option value selected>Aucune</option><?php for($i = 0; $i < min(sizeof($arr_class), sizeof($arr_id_class)); $i++){       echo utf8_encode('<option value="' .$arr_id_class[$i]. '">' .$arr_class[$i]. '</option>');}?></select></div></div><!-- Gestion du niveau --><div class="form-group col-md-2"><label for="select-character-level-class">Niveau</label><input type="number" name="select-character-level-class" id="select-character-level-class" class="form-control" min="1" max="30" maxlength="2" value="1" required /></div></div>');
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
            
            
            $("#select-character-class").change(function(data){
                reloadStatRace();
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
                        url: '/add-ons/statRace.php',
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