<?php
    session_start();
    require_once('database/connexion.php');

    if($_GET['id'] && !empty($_GET['id'])){

        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM articles WHERE id= :id';

        $data = $db->prepare($sql);

        $data->bindValue(':id',$id,PDO::PARAM_INT);

        $data->execute();

        $article = $data->fetch();

        if(!$article){
            header('Location: index.php');
            $_SESSION['message'] = "article non trouvé ";}




    }else{
        header('Location: index.php');
        $_SESSION['message'] = "Désolé ! Vous n'avez pas droit d'y accéder";
    }
   
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Article  <?= $article['nom']?></title>
</head>
<body>
    <main class="container">
        <div class="col-md-12 mt-5">
            <h1>Article n° <?= $article['id']?> <?= $article['nom']?> </h1>
        <p>Prix : <?= $article['prix']?></p>
        <p>Stock : <?= $article['stock']?></p>
        <a href="index.php" class="btn btn-danger">Retour</a>
        </div>
    </main>
</body>

</html>