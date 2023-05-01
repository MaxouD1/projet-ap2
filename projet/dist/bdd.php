<?php
function connectBdd() {
    $dsn = 'mysql:dbname=projet_remboursement;host=127.0.0.1';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    return $dbh;
}

function getConnexion($login, $mdp) {
    $bdd = connectBdd();
    $req = $bdd->prepare("SELECT *  FROM user where mail = :mail and mdp = :mdp");
    $req->execute(array(  ":mail" => $login, ":mdp" => $mdp  ));
    return $req->fetch();
}


function getUserByLogin($login) {
    $bdd = connectBdd();
    $req = $bdd->prepare("SELECT *  FROM user where mail = :mail");
    $req->execute(array(  ":mail" => $login ));
    return $req->fetch();
}


function  updateProfil($idUser, $repasMidi, $nuitee, $km, $date)
{
    $bdd = connectBdd();
    $req = $bdd->prepare("UPDATE frais_forfait SET  repas_midi = :repas_midi, nuitee = :nuitee ,km = :km
                     , date = :date WHERE fk_user = :id_user
                         ");
    $req->execute(array( ":id_user" => $idUser , ":repas_midi" => $repasMidi, ":nuitee" => $nuitee
    , ":km" => $km, ":date" => $date, ) );
    return $req->errorInfo();
}


function getFraisForfaitById($idUser) {
    $bdd = connectBdd();
    $req = $bdd->prepare("SELECT *  FROM frais_forfait where fk_user = :fk_user");
    $req->execute(array(  ":fk_user" => $idUser ));
    return $req->fetch();
}

function insertFraisHorsForfait($idUser, $libelle, $montant, $date) {
    $bdd = connectBdd();
    $req = $bdd->prepare("INSERT INTO frais_hors_forfait ( libelle, montant, date_hors_forfait, fk_utilisateur) 
                        VALUES ( :libelle , :montant, :date, :idUser) ");
    $req->execute(array( ":idUser" => $idUser , ":libelle" => $libelle , ":montant" => $montant, ":date" => $date));
}


function getFraisHorsForfaitById($idUser) {
    $bdd = connectBdd();
    $req = $bdd->prepare("SELECT *  FROM frais_hors_forfait where fk_utilisateur = :fk_user");
    $req->execute(array(  ":fk_user" => $idUser ));
    return $req->fetchAll();
}

function getFraisAll() {
    $bdd = connectBdd();
    $req = $bdd->prepare("SELECT nom,prenom,verification,libelle, montant, date_hors_forfait, repas_midi,nuitee,km,date,verif,id_frais,id_frais2  FROM user INNER JOIN frais_hors_forfait on fk_utilisateur = id_user INNER JOIN 
    frais_forfait on fk_user = id_user");
    $req->execute(array());
    return $req->fetchAll();
}


function  updateVerifForfait($idFrais, $verif)
{
    $bdd = connectBdd();
    $req = $bdd->prepare("UPDATE frais_forfait SET  verification = :verif WHERE id_frais = :id_frais");
    $req->execute(array( ":id_frais" => $idFrais , ":verif" => $verif) );
    return $req->errorInfo();
}

function  updateVerifHorsForfait($idFrais, $verif)
{
    $bdd = connectBdd();
    $req = $bdd->prepare("UPDATE frais_hors_forfait SET  verif= :verif WHERE id_frais2 = :id_frais");
    $req->execute(array( ":id_frais" => $idFrais , ":verif" => $verif) );
    return $req->errorInfo();
}




