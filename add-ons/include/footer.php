    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form_login">
                    <div class="modal-header">
                        <h5 class="modal-title">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-row">

                                <div class="form-group col-md-8">
                                    <div class="form-row col-md-12">
                                        <div class="form-group">
                                            <label for="inputUsername">Identifiant</label>
                                            <input type="text" id="inputUsername" class="form-control" placeholder="Identifiant" required/>
                                            <div id="invalid-feedback-user" class="invalid-feedback">
                                              Renseigné votre identifiant !
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword">Mot de passe</label>
                                            <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required/>
                                            <div id="invalid-feedback-pass" class="invalid-feedback">
                                              Renseigné votre mot de passe !
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <img src="/img/favicon.png" class="img-fluid" height=150px/>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success" id="btn_connect" onClick='$("#createClass").modal("hide");'>Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <!-- Boostrap tooltup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.js" integrity="sha256-VEkfzHCH2sMUViL3c3U1E8Z6xJiEZbGiCVs9rhSe1VQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper-utils.js" integrity="sha256-erEUdqPnXTEo8zl7fbFuIioBpMrR4qPYEbYCFx4tH1o=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.js" integrity="sha256-awnyktR66d3+Hym/H0vYBQ1GkO06rFGkzKQcBj7npVE=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js" integrity="sha256-pIMaS2f8G+v5lrvwhxHoQEvBVaflgapC50mRtM/sWZM=" crossorigin="anonymous"></script>
   
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js" integrity="sha256-MrUaGbgAJYr1e+J4/O6kEZIqB5yOGZN5R+oobyC6h4A=" crossorigin="anonymous"></script>


    <script type="text/javascript">
        
        $(document).ready(function () {
            
            /*************** SIDEBAR *************/
            
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            
            /***********************************************************/
            
           $("#btn_connect").click(function() {
                let password = $("#inputPassword").val();
                let username = $("#inputUsername").val();
               
               
                $('#inputUsername').removeClass('is-invalid');
                $('#invalid-feedback-user').hide();  

                $('#inputPassword').removeClass('is-invalid');
                $('#invalid-feedback-pass').hide();
               
               if(username.length < 1)
                {
                    $('#inputUsername').addClass('is-invalid');
                    $('#invalid-feedback-user').show();
                    return;
                }

               if(password.length < 1)
                {
                    $('#inputPassword').addClass('is-invalid');
                    $('#invalid-feedback-pass').show();
                    return;
                }

                    $.ajax({
                        url: '/add-ons/login.php',
                        type: 'POST',
                        data: 'user=' + username + '&pass=' + password,
                        success: function(data){
                            
                            $('#form_login')[0].reset();
                            window.location = '/admin/';
                            console.log(data);
                        },
                        error: function(data){
                            console.error(data);
                        }
                    });
/*                }
                else
                {
                    console.info("Champs vide !");
                }*/
           });
    });

    

    </script>