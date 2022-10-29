<?php
    session_start();
    require_once('database/connexion.php');
    #empty pour verifier que le champ est ou  pas vide
    if(!empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['stock'])){
      # ce code sera valide 
       # c'est pour controler les injections sql
       # s'assurer que l'utilisateur n'entre pas n'importe quoi dans notre application
      $nom = strip_tags($_POST['nom']);
      $prix = strip_tags($_POST['prix']);
      $stock = strip_tags($_POST['stock']); 

      $sql = 'INSERT INTO articles(nom,prix,stock) VALUES (:nom, :prix, :stock)';

      $article = $db->prepare($sql);

      $article->bindValue(':nom',$nom,PDO::PARAM_STR); # param_str parce qu'on recupère des valeurs en string param_int pour les entiers
      $article->bindValue(':prix',$prix,PDO::PARAM_STR);
      $article->bindValue(':stock',$stock,PDO::PARAM_STR);

      $article->execute();

      $_SESSION['message'] = "votre article a bien été enrégistré dans la base de données";
      # pour rediriger la page sur index
      header('Location: index.php');
    
    
    }else{
        $_SESSION['message'] = "vous devez remplir tous les champs";

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Creation</title>
</head>
<body>
    <main class="container mt-5">
        <div class="col-md-12">
            <h1>Création de l'article</h1>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" class="form-control">

                    </div>

                    <div class="form-group mt-3" >
                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="index.php" class="btn btn-danger">Retour</a>

                    </div>

                </form>
            </div>

        </div>
    </main>
    
</body>
</html>