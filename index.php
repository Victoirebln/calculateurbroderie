<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de prix</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
    <div class="title-container">
        <h2>Calculateur de prix</h2>
    </div>
    <div class="container">
        <form method="post">
            <label for="hauteur">Hauteur de l'écusson (cm) :</label>
            <input type="number" name="hauteur" id="hauteur" required><br><br>
            <label for="largeur">Largeur de l'écusson (cm) :</label>
            <input type="number" name="largeur" id="largeur" required><br><br>
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" required><br><br>
            <label for="ship_to">Ship to :</label>
            <select name="ship_to" id="ship_to">
                <option value="Belgique">Belgique</option>
                <option value="France">France</option>
                <option value="Italie">Italie</option>
                <option value="Luxembourg">Luxembourg</option>
                <!-- Autres options de livraison peuvent être ajoutées ici -->
            </select><br><br>
            <input type="submit" value="Calculer">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["hauteur"]) && isset($_POST["largeur"]) && isset($_POST["quantite"]) && isset($_POST["ship_to"])) {
            $hauteur = $_POST["hauteur"];
            $largeur = $_POST["largeur"];
            $quantite = $_POST["quantite"];
            $ship_to = $_POST["ship_to"];

            // Calcul de la dimension de l'écusson
            $dimension_ecusson = $hauteur + $largeur;

            // Tableau des prix en fonction des dimensions
            $prix_ecusson = array(
                array(2.20, 1.62, 1.42, 1.15, 0.96, 0.81, 0.68),
                array(2.60, 1.80, 1.54, 1.25, 1.10, 0.97, 0.85),
                array(3.33, 2.27, 2.00, 1.71, 1.49, 1.25, 1.14),
                array(3.99, 2.92, 2.43, 1.96, 1.78, 1.48, 1.27),
                array(4.66, 3.63, 3.05, 2.48, 2.38, 2.01, 1.63),
                array(5.17, 4.03, 3.38, 2.75, 2.44, 2.06, 1.67),
                array(5.86, 4.44, 3.84, 3.11, 2.50, 2.11, 1.69),
                array(7.85, 6.12, 5.15, 4.16, 2.96, 2.49, 2.14),
                array(9.69, 7.56, 6.35, 5.14, 3.40, 2.87, 2.50),
                array(11.45, 8.93, 7.49, 6.07, 3.98, 3.35, 2.93)
            );

            // Trouver la catégorie de dimension
            $categorie_dimension = '';
            if ($dimension_ecusson <= 8) {
                $categorie_dimension = '1 à 8 cm';
            } elseif ($dimension_ecusson <= 13) {
                $categorie_dimension = '8,1 à 13 cm';
            } elseif ($dimension_ecusson <= 15) {
                $categorie_dimension = '13,1 à 15 cm';
            } elseif ($dimension_ecusson <= 18) {
                $categorie_dimension = '15,1 à 18 cm';
            } elseif ($dimension_ecusson <= 21) {
                $categorie_dimension = '18,1 à 21 cm';
            } elseif ($dimension_ecusson <= 23) {
                $categorie_dimension = '21,1 à 23 cm';
            } elseif ($dimension_ecusson <= 25) {
                $categorie_dimension = '23,1 à 25 cm';
            } elseif ($dimension_ecusson <= 28) {
                $categorie_dimension = '25,1 à 28 cm';
            } elseif ($dimension_ecusson <= 30) {
                $categorie_dimension = '28,1 à 30 cm';
            } elseif ($dimension_ecusson <= 33) {
                $categorie_dimension = '30,1 à 33 cm';
            }

            // Trouver le prix en fonction de la catégorie de dimension et de la quantité
            $prix_unitaire = 0;
            switch ($categorie_dimension) {
                case '1 à 8 cm':
                    if (isset($prix_ecusson[0][$quantite])) {
                        $prix_unitaire = $prix_ecusson[0][$quantite];
                    }
                    break;
                case '8,1 à 13 cm':
                    if (isset($prix_ecusson[1][$quantite])) {
                        $prix_unitaire = $prix_ecusson[1][$quantite];
                    }
                    break;
                case '13,1 à 15 cm':
                    if (isset($prix_ecusson[2][$quantite])) {
                        $prix_unitaire = $prix_ecusson[2][$quantite];
                    }
                    break;
                case '15,1 à 18 cm':
                    if (isset($prix_ecusson[3][$quantite])) {
                        $prix_unitaire = $prix_ecusson[3][$quantite];
                    }
                    break;
                case '18,1 à 21 cm':
                    if (isset($prix_ecusson[4][$quantite])) {
                        $prix_unitaire = $prix_ecusson[4][$quantite];
                    }
                    break;
                case '21,1 à 23 cm':
                    if (isset($prix_ecusson[5][$quantite])) {
                        $prix_unitaire = $prix_ecusson[5][$quantite];
                    }
                    break;
                case '23,1 à 25 cm':
                    if (isset($prix_ecusson[6][$quantite])) {
                        $prix_unitaire = $prix_ecusson[6][$quantite];
                    }
                    break;
                case '25,1 à 28 cm':
                    if (isset($prix_ecusson[7][$quantite])) {
                        $prix_unitaire = $prix_ecusson[7][$quantite];
                    }
                    break;
                case '28,1 à 30 cm':
                    if (isset($prix_ecusson[8][$quantite])) {
                        $prix_unitaire = $prix_ecusson[8][$quantite];
                    }
                    break;
                case '30,1 à 33 cm':
                    if (isset($prix_ecusson[9][$quantite])) {
                        $prix_unitaire = $prix_ecusson[9][$quantite];
                    }
                    break;
            }

            // Calcul du prix total
            $prix_total = $prix_unitaire * $quantite;

            // Frais de port en fonction du pays de livraison
            $frais_port = 0;
            switch ($ship_to) {
                case 'France':
                    $frais_port = 5;
                    break;
                case 'Italie':
                    $frais_port = 10;
                    break;
                case 'Luxembourg':
                    $frais_port = 10;
                    break;
                case 'Belgique':
                    $frais_port = 10;
                    break;
                // Ajouter d'autres cas pour d'autres pays si nécessaire
            }

            // Calcul du prix total avec frais de port
            $prix_total += $frais_port;

            // Affichage du résultat
            if ($prix_unitaire > 0 && $prix_total > 0) {
                echo '<div class="result-container">';
                echo "<h3>Résultat :</h3>";
                echo "<h3>Dimensions de l'écusson : $dimension_ecusson cm<br></h3>";
                echo "<h3>Quantité : $quantite<br></h3>";
                echo "<h3>Prix unitaire : $prix_unitaire €<br></h3>";
                echo "<h3>Frais de port : $frais_port €<br></h3>";
                echo "<h3>Prix total : $prix_total €<br></h3>";
                echo '</div>';
            } else {
                echo "Erreur : impossible de calculer le prix.";
            }
        } else {
            echo "Veuillez remplir tous les champs du formulaire.";
        }
    }
    ?>


</body>

</html>