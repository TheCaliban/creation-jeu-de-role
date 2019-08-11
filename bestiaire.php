<?php 

    session_start();
    require_once('connect.php');								

    $title = "Bestiaire";
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
                
                <div class="col-md-12">
                
                    Bestiaire !
                
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
