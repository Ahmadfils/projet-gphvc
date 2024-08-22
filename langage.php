<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Actualisation de page avec paramètre GET</title>
</head>
<body>
    <form id="myForm">
        <label for="mySelect">Choisissez un élément :</label>
        <select id="mySelect" name="element">
            <option value="1">Élément 1</option>
            <option value="2">Élément 2</option>
            <option value="3">Élément 3</option>
        </select>
    </form>

    <script>
        
        document.getElementById('mySelect').addEventListener('change', function() {
            var selectedValue = this.value;
            // Redirigez avec le paramètre GET
            window.location.href = window.location.pathname + '?element=' + selectedValue;
        });
    </script>
</body>
</html>
<?php
if (isset($_GET['element'])) {
    $element = $_GET['element'];
    // Traitez la valeur récupérée ici
    echo "Vous avez choisi l'élément : " . htmlspecialchars($element);
}
?>
