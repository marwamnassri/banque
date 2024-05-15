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
    if (isset($_POST['valider'])) {
    
        $id = $_POST['id'];
        $sql = "UPDATE Transport SET valide = 1 WHERE id = $id";
        if (mysqli_query($con, $sql)) {
            echo "Enregistrement validé avec succès.";
        } else {
            echo "Erreur lors de la validation de l'enregistrement: " . mysqli_error($con);
        }
    } elseif (isset($_POST['supprimer'])) {
    
        $id = $_POST['id'];
        $sql = "DELETE FROM Transport WHERE id = $id";
        if (mysqli_query($con, $sql)) {
            echo "Enregistrement supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'enregistrement: " . mysqli_error($con);
        }
    }
}


$sql = "SELECT * FROM Transport";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index2.css">

    <title>Liste des Enregistrements</title>
</head>
<body>
    <h2>Liste des Enregistrements</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Destination</th>
            <th>Objet</th>
            <th>Moyen de Transport</th>
            <th>Date de Départ</th>
            <th>Durée Prévisionnelle</th>
            <th>Matériels</th>
            <th>Frais</th>
            <th>Action</th>
        </tr>
        <?php
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['destination']."</td>";
            echo "<td>".$row['objet']."</td>";
            echo "<td>".$row['moyen_transport']."</td>";
            echo "<td>".$row['date_depart']."</td>";
            echo "<td>".$row['duree_previsionnelle']."</td>";
            echo "<td>".$row['materiels']."</td>";
            echo "<td>".$row['frais']."</td>";
            echo "<td>";
            
            echo "<form method='post'>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "<input type='submit' name='valider' value='Valider'>";
            echo "<input type='submit' name='supprimer' value='Supprimer'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
     
   
</body>
</html>
