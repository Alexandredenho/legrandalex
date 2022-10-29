<?php
    session_start();
    require_once('database/connexion.php');

    $sql = 'SELECT * FROM articles';
    $data = $db->prepare($sql);
    $data->execute();

    # recuperation de l'expression pour mettre dans $articles
    $articles = $data->fetchAll(PDO::FETCH_ASSOC );
    

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>
     <div class = "container">
         <div class="row">
             <section class="mt-5">

             <?php
                if($_SESSION['message']){
            ?>
            <div class="alert">
                <p class="alert alert-success">
                <?php
                   echo $_SESSION['message'];
                   $_SESSION['message'] = ""; 
                    ?>
                </p>
            </div>

            <?php
                }
             ?>

                 <h1>Liste des articles </h1>
                 <a href="create.php" class= "btn btn-primary">ajouter un article</a>
                 <table class = "table mt-3">
                     <thead>
                         <th>ID</th> 
                         <th>Nom</th>
                         <th>Prix</th>
                         <th>Stock</th>
                         <th>Actions </th>
                     </thead>
                     <tbody>
                         
                     <?php
                            foreach($articles as $article){  ?>
                         <tr>
                             <td> <?= $article['id']?></td>
                             <td> <?= $article['nom']?></td>
                             <td> <?= $article['prix']?></td>
                             <td> <?= $article['stock']?></td>
                             <td>
                                 <a href="vision.php?id= <?= $article['id']?>" class="text-blue">Voir</a>
                                 <a href="edition.php?id= <?= $article['id']?>" class= text-success>Editer</a>
                                 <a href="supression.php?id= <?= $article['id']?>" class="text-danger">Suprimer</a>
                             </td>
                         </tr>
                     <?php }  ?>

                     </tbody>
                 </table>
             </section>
         </div>
     </div>
</body>
</html> 