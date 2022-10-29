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

       

        if($article){
            if(!empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['stock'])){

                $nom = strip_tags($_POST['nom']);
                $prix = strip_tags($_POST['prix']);
                $stock = strip_tags($_POST['stock']);
                
                $sql = 'UPDATE articles SET nom=:nom, prix=:prix, stock =:stock WHERE id=:id'; 
               
                $data = $db->prepare($sql);
               
                $data->bindValue(':id', $id,PDO::PARAM_INT);
                $data->bindValue(':nom', $nom,PDO::PARAM_STR);
                $data->bindValue(':prix', $prix,PDO::PARAM_STR);
                $data->bindValue(':stock', $stock,PDO::PARAM_STR);
    
                $data->execute();
    
                header('Location: index.php');
                $_SESSION['message'] = "Votre article a bien été modifié ";

            }

           

        }else{
            header('Location: index.php');
            $_SESSION['message'] = "article non trouvé ";

        }




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
    <title>Edition</title>
</head>
<body>
    <main class="container">
    <div class="col-md-12">
            <h1>Edition de l'article  <?= $article['nom']?></h1>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= $article['nom']?>" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" value="<?= $article['prix']?>" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" value="<?= $article['stock']?>" class="form-control">

                    </div>

                    <div class="form-group mt-3" >
                        <button type="submit" class="btn btn-primary">Editer</button>
                        <a href="index.php" class="btn btn-danger">Retour</a>

                    </div>

                </form>
            </div>

        </div>
    </main>
    
</body>
</html>