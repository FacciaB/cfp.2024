<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupero i dati dal form
    $docente = $_POST['docente'] ?? '';
    $materia = $_POST['materia'] ?? '';
    $classe = $_POST['classe'] ?? '';
    $orario_inizio = $_POST['orario_inizio'] ?? '';
    $orario_fine = $_POST['orario_fine'] ?? '';
    $data = $_POST['data'] ?? '';

    // Verifico che tutti i campi siano compilati
    if (!$docente || !$materia || !$classe || !$orario_inizio || !$orario_fine || !$data) {
        echo "Tutti i campi sono obbligatori!";
        exit;
    }

    // File JSON specifico per il docente
    $filename = "attivita_$docente.json";

    // Carico le attività esistenti
    $attivita = [];
    if (file_exists($filename)) {
        $attivita = json_decode(file_get_contents($filename), true) ?? [];
    }

    // Aggiungo la nuova attività
    $attivita[] = [
        'data' => $data,
        'materia' => $materia,
        'classe' => $classe,
        'orario_inizio' => $orario_inizio,
        'orario_fine' => $orario_fine,
    ];

    // Salvo le attività nel file JSON
    file_put_contents($filename, json_encode($attivita, JSON_PRETTY_PRINT));

    echo "Attività salvata correttamente per il docente $docente.";
}
?>
