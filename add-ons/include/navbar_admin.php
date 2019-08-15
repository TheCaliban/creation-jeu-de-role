<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Navbar + title + bdd access -->
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-dark">
            <i class="fas fa-align-left"></i>
        </button>

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" ><!--data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"-->
            <!--<i class="fas fa-align-justify"></i>-->
            <a class="nav-link" href="../phpmyadmin/" target="_blank"><i class="fas fa-user"></i></a>
        </button>

        <span class="navbar-text ml-3">
            <?php echo $title; ?></span>
        </span>

        <div class="collapse navbar-collapse">
            
            <ul class="nav navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php"><i class="fas fa-times-circle"></i></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="../phpmyadmin/" target="_blank"><i class="fas fa-user"></i>&nbsp; Base de données</a>
                </li>
                
            </ul>
            
        </div>

    </div>

</nav>
