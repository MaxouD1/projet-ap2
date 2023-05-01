<?php
session_start();
require_once "bdd.php";
if (!empty($_POST['repasMidi']))
{
   $r = updateProfil($_SESSION['id_user'], $_POST['repasMidi'], $_POST['nuitee'],
        $_POST['km'], $_POST['date']);
}

if (!empty($_POST['libelle'])){
   insertFraisHorsForfait($_SESSION['id_user'], $_POST['libelle'],$_POST['montant'],$_POST['date2']);
}

$user = getUserByLogin($_SESSION['mail']);
$fraisForfait = getFraisForfaitById($_SESSION['id_user']);
$fraisHorsForfait = getFraisHorsForfaitById($_SESSION['id_user']);


?>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Profile</title>

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
   </head>
   <body  style="min-height:90vh;">
      <div id="app">
         <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
               <a class="navbar-brand" href="#">
               Navbar
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">
                  </ul>
                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="deco.php">Déconnexion</a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <main class="py-4">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-4">
                     <h4 class="pb-2">
                        Information du profil
                     </h4>
                     <span class="text-justify mb-3" style="padding-top:-3px;">Mettez à jour votre profil ici<br></span>
                  </div>
                  <div class="col-lg-8 text-center pt-2">
                     <div class="card py-4 mb-5 mt-md-3 bg-white rounded " style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                        <form method ="POST" action="">
                            <div class="form-group px-3">

                              <label for="displayName" class="col-12 text-left pl-0">Name</label>
                              <input type="text" class="col-md-8 form-control" value ="<?php echo $user['nom']." ".$user['prenom'];?>" >

                              <label for="email" class="pt-3 col-12 text-left pl-0">Email</label>
                              <input type="email" class="col-md-8 form-control"  value="<?php echo $user['mail'];?>">

                            </div>
                            <div class="form-group row mb-0 mr-4">
                                <div class="col-md-8 offset-md-4 text-right">
                                 </div>
                            </div>
                        </form>

                     </div>
                  </div>
               </div>
               <div class="border-bottom border-grey"></div>
               <div class="row justify-content-center pt-5">
                  <div class="col-lg-4">
                     <h4 class="pb-2">
                     Vos frais forfaitaires</h4>
                     <span class="text-justify" style="padding-top:-3px;">Ici vous pourrez retrouver vos frais forfaitaires</span>
                  </div>
                  <div class="col-lg-8 text-center pt-2">
                     <div class="card py-4 mb-5 mt-md-3 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                        <form method="POST" action="">
                            <div class="form-group px-3">

                              <label for="repasmidi" class="col-12 text-left pl-0">Nombre de repas du midi</label>
                              <input type="input" id= "repasMidi" name="repasMidi" class="col-md-8 form-control" value="
                              <?php echo $fraisForfait['repas_midi']?>">

                              <label for="nuitee" class="pt-3 col-12 text-left pl-0">Nombre de nuitées</label>
                              <input type="input" id= "nuitee" name="nuitee" class="col-md-8 form-control"  value="
                              <?php echo $fraisForfait['nuitee']?>">

                              <label for="km" class="pt-3 col-12 text-left pl-0">Kilométrage</label>
                              <input type="input" id= "km" name="km"class="col-md-8 form-control"  value="
                              <?php echo $fraisForfait['km']?>">

                              <label for="date" class="pt-3 col-12 text-left pl-0">Date (Y-m-d)</label>
                              <input type="input" id= "date" name="date" class="col-md-8 form-control"value="
                              <?php echo $fraisForfait['date'];?>">

                              
                              <label for="verif" class="pt-3 col-12 text-left pl-0">Vérifié (veuillez à ne pas changer la valeur)</label>
                              <input type="input" id= "verif" class="col-md-8 form-control"value="
                              <?php echo $fraisForfait['verification'];?>">

                            </div>
                            <div class="form-group row mb-0 mr-4">
                                <div class="col-md-8 offset-md-4 text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="border-bottom border-grey"></div>
               <div class="row justify-content-center pt-5">
                  <div class="col-lg-4">
                     <h4 class="pb-2">
                     Vos frais hors forfait</h4>
                     <span class="text-justify" style="padding-top:-3px;">Ici vous pourrez retrouver vos frais hors forfait</span>
                  </div>
                  <div class="col-lg-8 pt-0">
                     <div class="card py-4 mb-5 mt-md-3 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                        <form method="POST" action ="">
                        <div class="form-group px-3">

                           <h5 class="pt-3 col-12 text-left pl-0">Vos frais hors forfait</h5>
                           <ul>
                           <?php 
                           foreach ($fraisHorsForfait as $f)
                               echo "<li>".$f['libelle']." - Montant : ".$f['montant']." - Date : ".$f['date_hors_forfait']." - Vérifié : ".$f['verif']."
            
                               </li>";
               
      
                              ?>
                           </ul>
                           <h5 class="pt-3 col-12 text-left pl-0">Ajouter des frais hors forfait</h5>
                           <label for="repasmidi" class="col-12 text-left pl-0">Libellé</label>
                              <input type="input" id= "libelle" name="libelle" class="col-md-8 form-control" placeholder="---">

                              <label for="nuitee" class="pt-3 col-12 text-left pl-0">Montant</label>
                              <input type="input" id= "montant" name="montant" class="col-md-8 form-control" placeholder="---">

                              <label for="km" class="pt-3 col-12 text-left pl-0">Date (Y-m-d)</label>
                              <input type="input" id= "date2" name="date2"class="col-md-8 form-control" placeholder="---">

                        </div>
                           <div class="form-group row mb-0 mr-4">
                                <div class="col-md-8 offset-md-4 text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
      <footer id="sticky-footer" class="flex-shrink-0 py-4 text-dark-50">
      </footer>
   </body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
