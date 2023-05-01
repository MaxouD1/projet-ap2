<?php
session_start();
require_once "bdd.php";

$allFrais = getFraisAll();
$user = getUserByLogin($_SESSION['mail']);

if(isset($_POST["verifForfait"])){
   updateVerifForfait($_POST['verifForfait'],$_POST['verifForfait2']);
}

if(isset($_POST["verifHorsForfait"])){
   updateVerifHorsForfait($_POST['verifHorsForfait'],$_POST['verifHorsForfait2']);
}
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
                     Tous les frais en cours</h4>
                     <span class="text-justify" style="padding-top:-3px;">Ici vous pourrez retrouver les frais en cours</span>
                  </div>
                  <div class="col-lg-8 text-center pt-2">
                     <div class="card py-4 mb-5 mt-md-3 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                        <form method="POST" action="">
                            <div class="form-group px-3">
                           <h5>Tous les frais forfaitaires</h5>
                           <ul>
                           <?php 
                           foreach ($allFrais as $f)
                               echo "<li>".$f['nom']." ".$f['prenom']." - ID : ".$f['id_frais']." - Repas du midi : ".$f['repas_midi']." - Nuitee : ".$f['nuitee']." - Date : ".$f['date']." - Verificiation : ".
                               $f['verification']."
            
                               </li>";
               
      
                              ?>
                           </ul>
                           <h5>Tous les frais hors forfait</h5>
                           <ul>
                           <?php 
                           foreach ($allFrais as $f)
                           echo "<li>".$f['nom']." ".$f['prenom']." - ID : ".$f['id_frais2']." ".$f['libelle']." - Montant : ".$f['montant']." - Date : ".$f['date_hors_forfait']." - Vérifié : ".$f['verif']."
            
                           </li>" ;
               
      
                              ?>
                           </ul>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="border-bottom border-grey"></div>
               <div class="row justify-content-center pt-5">
                  <div class="col-lg-4">
                     <h4 class="pb-2">
                     Vérifier un frais</h4>
                     <span class="text-justify" style="padding-top:-3px;">Ici vous pourrez vérifier un frais </span>
                  </div>
                  <div class="col-lg-8 pt-0">
                     <div class="card py-4 mb-5 mt-md-3 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                        <form method="POST" action ="">
                        <div class="form-group px-3">
                        <h5>Vérifier un frais forfaitaire</h5>
                        <label for ="verifForfait">Donnez l'ID du frais</label>
                        <input type ="input" id="verifForfait" name ="verifForfait" placeholde="---">
                        <br>
                        <label for ="verifForfait2">Vérifier le forfait ?(oui/non)</label>
                        <input type ="input" id="verifForfait2" name ="verifForfait2" placeholde="---">
                        <br>
                        <br>
                        <h5>Vérifier un frais hors forfait</h5>
                        <label for ="verifHorsForfait">Donnez l'ID du frais</label>
                        <input type ="input" id="verifHorsForfait" name ="verifHorsForfait" placeholde="---">
                        <br>
                        <label for ="verifForfait2">Vérifier le forfait ?(oui/non)</label>
                        <input type ="input" id="verifHorsForfait2" name ="verifHorsForfait2" placeholde="---">
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
            </div>
         </main>
      </div>
      <footer id="sticky-footer" class="flex-shrink-0 py-4 text-dark-50">
      </footer>
   </body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
