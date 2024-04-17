<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=hugo_portfolio', 'hugo', 'plop');
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $realisation = $_POST['realisation'];
    $competence = $_POST['competence'];

    try {
        $insertQuery = $dbh->prepare("INSERT INTO real_comp (realisations_id, competences_id) VALUES (:realisation, :competence)");
        $insertQuery->execute(array(':realisation' => $realisation, ':competence' => $competence));
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }
}

try {
    $selectQuery = $dbh->prepare("SELECT competences.titre AS titre_competences, realisations.lib AS realisation, competences.lib AS lib_competence FROM real_comp 
                                    INNER JOIN realisations ON real_comp.realisations_id = realisations.id 
                                    INNER JOIN competences ON real_comp.competences_id = competences.id");

    $selectQuery->execute();
    $data = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
}

$html = '';
foreach ($data as $row) {
    $html .= '<tr>';
    $html .= '<td>' . $row['titre_competences'] . '</td>';
    $html .= '<td>' . $row['lib_competence'] . '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<th>' . $row['realisation'] . '</th>';
    $html .= '</tr>';

}

echo $html;
?>
