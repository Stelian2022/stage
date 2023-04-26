<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['csvfile']) && $_FILES['csvfile']['error'] == UPLOAD_ERR_OK) {
        // Open the uploaded CSV file
        $fichier = fopen($_FILES['csvfile']['tmp_name'], 'r');

        // Read the contents of the CSV file and store them in an array
        $lignes = array();
        while (($ligne = fgetcsv($fichier, 0, ';')) !== false) {
            $lignes[] = $ligne;
        }

        // Close the CSV file
        fclose($fichier);

        // Sort and display the array as before
        // ...
    } else {
        echo 'Error uploading file.';
    }
}

// Afficher le tableau HTML trié par date
echo '<table>';
echo '<thead>';
echo '<tr><th>Tache</th><th>Contenue</th><th>Date</th></tr>';
echo '</thead>';
echo '<tbody>';
// foreach ($lignes as $ligne) {
//     echo '<tr>';
//     foreach ($ligne as $colonne) {
//         echo '<td>' . $colonne . '</td>';
//     }
//     echo '</tr>';
// }
//envoyer le tableau trié par importance et coloré
foreach ($lignes as $ligne) {
    $prio = strtolower($ligne[1]);
    if ($prio == 'important') {
        echo '<tr style="background-color: red">';
    } elseif ($prio == 'moyen') {
        echo '<tr style="background-color: yellow">';
    } else {
        echo '<tr>';
    }
    foreach ($ligne as $colonne) {
        echo '<td>' . $colonne . '</td>';
    }
    echo '</tr>';
}
    
echo '</tbody>';
echo '</table>';

// // Envoyer l'email avec le tableau HTML en tant que contenu
// $destinataire = 'exemple@gmail.com';
// $sujet = 'Tableau HTML des 5 premières lignes du fichier CSV';
// $headers = 'From: monadresse@mail.com' . "\r\n";
// $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
// $message = '<html><body><p>Voici le tableau HTML des 5 premières lignes du fichier CSV :</p>' . $table_html . '</body></html>';
// mail($destinataire, $sujet, $message, $headers);
