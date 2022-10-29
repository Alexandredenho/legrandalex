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
            
            $id = strip_tags($_GET['id']);
                
            $sql = 'DELETE FROM articles WHERE id=:id'; 
               
            $data = $db->prepare($sql);
               
            $data->bindValue(':id', $id, PDO::PARAM_INT);  
            $data->execute();
    
            header('Location: index.php');
            $_SESSION['message'] = "Votre article a bien été suprimé";

            

           

        }else{
            header('Location: index.php');
            $_SESSION['message'] = "article non trouvé ";

        }




    }else{
        header('Location: index.php');
        $_SESSION['message'] = "Désolé ! Vous n'avez pas droit d'y accéder";
    }
   
?>

