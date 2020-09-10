<?php
// Vérification si des données ont été postés
$isPosted = count($_POST) > 0;
// Récupération du fichier quizz
$fileQuizz = "quizz.json";
// Lecture et transformation du json en tableau
$contentQuizz = json_decode(file_get_contents($fileQuizz),true);
// compteur question
$numeroQuestion = 0 ;
// mise à zéro du compteur de bonne réponses
$rightReply = 0;

// si des données ont été postés
if($isPosted){
    // recup des post
    foreach($_POST as $rq){
        // comparaison au fichier avec deux chiffres 
        //(**) respectivement (numéroQuestion,numéro bonne réponse)
        //  si réponse post correspond a une bonne réponse du json incrément de la variable $rightReply
        foreach($contentQuizz as $item){
            if($item['rightReply'] == $rq){
                $rightReply++;
            }
        }
    }
    //echo "Vous avez $rightReply bonne(s) réponse(s)";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/css/style.css">
    <title>quizz</title>
</head>
<body>
    <?php if($isPosted) : ?>
        <p>Vous avez <?= $rightReply ?> bonne(s) réponse(s)</p>
        <button class="btn btn-warning"><a href="http://localhost:8000/quizz.php">Retour au quizz</a></button>
    <?php else : ?>
    <div class="container-fluid">
        <div class="container">
            <h1 class="text-center jumbotron my-5">TP Quizz PHP</h1>
            <form method="post">
                <div class="container bg-light border border-info">
                    <?php foreach($contentQuizz as $item): ?>
                    <?php 
                    $numeroQuestion++;
                    $countReply = 1;
                    ?>
                    <div class="container border border-dark my-3 py-2">
                        <div class="row">
                            <p class="font-weight-bold ml-3"><?= $item['question'] ?></p>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p class="badge badge-primary"><?= $numeroQuestion ?></p>
                            </div>
                                <div class="col-9">
                                    <?php foreach($item['reponses'] as $tabReply): ?>
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="radio" 
                                            name="rq<?= $numeroQuestion ?>" 
                                            value="<?= $numeroQuestion ?><?= $countReply ?>" 
                                            id="<?= $tabReply ?>"
                                        >
                                        <label class="form-check-label" for="<?= $tabReply ?>">
                                            <?= $tabReply ?>
                                        </label>
                                    </div>
                                    <?php $countReply++; ?>
                                    <?php endforeach ?>
                                </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <div class="row justify-content-center my-3">
                        <button type="submit" class="btn btn-primary">Valider les réponses</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif ?>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>