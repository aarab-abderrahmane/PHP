<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "insurance_db";

$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

mysqli_select_db($conn, $dbname);

$sql_dossier = "CREATE TABLE IF NOT EXISTS Dossier (
    numdossier INT PRIMARY KEY,
    datedepot DATE,
    montant_remboursement DECIMAL(10,2),
    date_traitement DATE,
    lien_maladie INT,
    matricule VARCHAR(50),
    num_maladie INT,
    total_dossier DECIMAL(10,2)
)";

$sql_assure = "CREATE TABLE IF NOT EXISTS Assure (
    matricule VARCHAR(50) PRIMARY KEY,
    nom_ass VARCHAR(100),
    prenom_ass VARCHAR(100),
    date_naissance DATE,
    nb_enfant INT,
    situation_familiale VARCHAR(50),
    num_entreprise INT,
    total_remb DECIMAL(10,2),
    date_deces DATE NULL,
    mot_depasse VARCHAR(100)
)";

$sql_maladie = "CREATE TABLE IF NOT EXISTS Maladie (
    num_maladie INT PRIMARY KEY,
    designation_maladie VARCHAR(100)
)";

$sql_entreprise = "CREATE TABLE IF NOT EXISTS Entreprise (
    num_entreprise INT PRIMARY KEY,
    nom_entreprise VARCHAR(100),
    adresse VARCHAR(200),
    telephone VARCHAR(20),
    nombre_employe INT,
    email VARCHAR(100)
)";

$sql_rubrique = "CREATE TABLE IF NOT EXISTS Rubrique (
    numrubrique INT PRIMARY KEY,
    nom_rubrique VARCHAR(100),
    numdossier INT,
    montant_rubrique DECIMAL(10,2)
)";

$tables = array($sql_dossier, $sql_assure, $sql_maladie, $sql_entreprise, $sql_rubrique);
foreach ($tables as $table_query) {
    if (mysqli_query($conn, $table_query)) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
}

$sql_sample_data = "
    -- Insert sample maladies
    INSERT IGNORE INTO Maladie (num_maladie, designation_maladie) VALUES 
    (1, 'Grippe'), 
    (2, 'Diabète'), 
    (3, 'Hypertension');
    
    -- Insert sample entreprises
    INSERT IGNORE INTO Entreprise (num_entreprise, nom_entreprise, adresse, telephone, nombre_employe, email) VALUES 
    (1, 'ACME Corp', '123 Business Ave', '555-1234', 100, 'contact@acme.com'),
    (2, 'Tech Solutions', '456 Tech Blvd', '555-5678', 50, 'info@techsolutions.com');
    
    -- Insert sample assurés
    INSERT IGNORE INTO Assure (matricule, nom_ass, prenom_ass, date_naissance, nb_enfant, situation_familiale, num_entreprise, total_remb, mot_depasse) VALUES 
    ('A001', 'Dupont', 'Jean', '1980-05-15', 2, 'Marié', 1, 0, 'password123'),
    ('A002', 'Martin', 'Sophie', '1975-10-22', 1, 'Mariée', 1, 0, 'password123'),
    ('A003', 'Petit', 'Marc', '1990-03-08', 0, 'Célibataire', 2, 0, 'password123');
";

$sql_statements = explode(';', $sql_sample_data);
foreach ($sql_statements as $sql) {
    if (trim($sql) != '') {
        if (mysqli_query($conn, $sql)) {
            echo "Sample data inserted successfully<br>";
        } else {
            echo "Error inserting sample data: " . mysqli_error($conn) . "<br>";
        }
    }
}

echo "Database setup completed successfully!";
mysqli_close($conn);
?>