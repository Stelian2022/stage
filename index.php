<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Formulaire taches</title>
</head>

<body>

</body>

</html>
<?php

//METHODE A

// Ouvrir le fichier CSV en mode lecture
$fichier = fopen('Formulaire.csv', 'r');

//  Lire les 10 premières lignes du fichier CSV et les stocker dans un tableau
$lignes = array();
$lignes = array();
for ($i = 0; $i < 5 && ($ligne = fgetcsv($fichier, 0, ';')) !== false; $i++) {
    $lignes[] = $ligne;
}

// Fermer le fichier CSV
fclose($fichier);

// Trier les lignes par date en utilisant la fonction de comparaison

usort($lignes, function ($a, $b) {
    return strtotime($a[2]) - strtotime($b[2]);
    //Pour mettre en évidence les différents niveaux de tri dans le tableau
    //     $a_prio = strtolower($a[1]);
    //     $b_prio = strtolower($b[1]);
    //     if ($a_prio == 'important') {

    //         return -1;
    //     } elseif ($b_prio == 'important') {
    //         return 1;
    //     } else {
    //         return strcmp($a_prio, $b_prio);
    //     }
});

// Afficher le tableau HTML trié par date
echo '<table>';
echo '<thead>';
echo '<tr><th>Tache</th><th>Contenue</th><th>Date</th></tr>';
echo '</thead>';
echo '<tbody>';
foreach ($lignes as $ligne) {
    echo '<tr>';
    foreach ($ligne as $colonne) {
        echo '<td>' . $colonne . '</td>';
    }
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

// // Envoyer l'email avec le tableau HTML en tant que contenu
// $destinataire = 'exemple@gmail.com';
// $sujet = 'Tableau HTML des 3 premières lignes du fichier CSV';
// $headers = 'From: monadresse@mail.com' . "\r\n";
// $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
// $message = '<html><body><p>Voici le tableau HTML des 10 premières lignes du fichier CSV :</p>' . $table_html . '</body></html>';
// mail($destinataire, $sujet, $message, $headers);
