 <nav class="navbar navbar-dark bg-dark justify-content-between">
         
    <div class="navbar-brand">
        <button type="button" id="sidebarCollapse" class="btn btn-dark ">
            <i class="fas fa-align-left"></i>
        </button>

        <span class="navbar-text ml-3">
            <?php echo $title; ?></span>
        </span>
    </div>

    <div class="form-inline navbar-text">

        <ul class="nav justify-content-end">

            <?php

            if(!isset($_SESSION['login']) ||  $_SESSION['user'] == '')
            {

                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#loginModal" style="cursor: pointer;"><i class="fas fa-user"></i>&nbsp; Admin</a>
                </li>

                <?php

            }
            else
            {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php"><i class="fas fa-times-circle"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../phpmyadmin/" target="_blank"><i class="fas fa-user"></i>&nbsp; Base de données</a>
                </li>

                <?php
            }


            ?>

        </ul>
    </div>

 </nav>

