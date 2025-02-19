<?php

include_once "../connection.php";
include_once "../../components/card.php";
if (isset($_GET["title"]) || isset($_GET["type"])) {
    $query = "SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE 1=1"; 
    $params = [];
    $types = "";

    if (!empty($_GET["title"])) {
        $query .= " AND (name LIKE ? OR name_eng LIKE ?)";
        $searchTerm = "%" . $_GET["title"] . "%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "ss";
    }
    if (isset($_GET["type"])) {
        $query .= " AND type = ?";
        $params[] = $_GET["type"];
        $types .= "s";
    }

    // FOR LIMIT
    $query .= "";

    $stmt = $conn->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $htmlContent = '';

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $htmlContent .= card($data, $image_starter);
        }
    }

    echo json_encode(["length" => $result->num_rows, "data" => $htmlContent]);
} else {
    echo json_encode(["length" => 0, "data" => ""]);
}
?>