<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banque";


$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connexion échouée: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $destination = $_POST['destination'];
    $objet = $_POST['objet'];
    $moyen_transport = $_POST['moyen_transport'];
    $date_depart = $_POST['date_depart'];
    $duree_previsionnelle = $_POST['duree_previsionnelle'];
    $materiels = $_POST['materiels'];
    $frais = $_POST['frais'];

    
    $sql = "INSERT INTO Transport (destination, objet, moyen_transport, date_depart, duree_previsionnelle, materiels, frais)
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssiss", $destination, $objet, $moyen_transport, $date_depart, $duree_previsionnelle, $materiels, $frais);

    
    if ($stmt->execute() === TRUE) {
        echo "Enregistrement réussi.";
    } else {
        echo "Erreur lors de l'enregistrement: " . $con->error;
    }

    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Formulaire de Transport</title>
</head>
<body>
    <h2>Formulaire de Transport</h2>
    <form action="traitement_formulaire.php" method="POST">
        <div>
            <label for="destination">Destination :</label>
            <input type="text" name="destination" id="destination" required>
        </div>
        <div>
            <label for="objet">Objet :</label>
            <input type="text" name="objet" id="objet" required>
        </div>
        <div>
            <label for="moyen_transport">Moyen de Transport :</label>
            <select name="moyen_transport" id="moyen_transport" required>
                <option value="voiture">Voiture</option>
                <option value="train">Train</option>
                <option value="avion">Avion</option>
                <option value="bateau">Bateau</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div>
            <label for="date_depart">Date de Départ :</label>
            <input type="date" name="date_depart" id="date_depart" required>
        </div>
        <div>
            <label for="duree_previsionnelle">Durée Prévisionnelle (en jours) :</label>
            <input type="number" name="duree_previsionnelle" id="duree_previsionnelle" required>
        </div>
        <div>
            <label for="materiels">Liste des Matériels à Transporter :</label>
            <textarea name="materiels" id="materiels" rows="4" required></textarea>
        </div>
        <div>
            <label for="frais">Frais :</label>
            <input type="radio" name="frais" id="frais_oui" value="oui" required>
            <label for="frais_oui">Oui</label>
            <input type="radio" name="frais" id="frais_non" value="non" required>
            <label for="frais_non">Non</label>
        </div>
        <div>
            <input type="submit" value="Soumettre">
        </div>
    </form>
</body>
</html>
