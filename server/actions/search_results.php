<?php

include_once "../connection.php";
include_once "../../components/search_card.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE 1=1";
    $params = [];
    $types = "";

    // Title Search
    if (!empty($_GET["title"])) {
        $query .= " AND (name LIKE ? OR name_eng LIKE ?)";
        $searchTerm = "%" . $_GET["title"] . "%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "ss";
    }

    // Type (Multiple values support)
    if (isset($_GET["type"]) && $_GET["type"] !== "") {
        $typesArray = explode(",", $_GET["type"]); // Expecting comma-separated values
        $placeholders = implode(",", array_fill(0, count($typesArray), "?"));
        $query .= " AND type IN ($placeholders)";
        foreach ($typesArray as $type) {
            $params[] = $type;
            $types .= "s";
        }
    }
    

    // Genres (Multiple values support)
    if (!empty($_GET["genres"])) {
        $genresArray = explode(",", $_GET["genres"]); // Expecting comma-separated values
        $placeholders = implode(",", array_fill(0, count($genresArray), "?"));
        $query .= " AND genres IN ($placeholders)";
        foreach ($genresArray as $genre) {
            $params[] = $genre;
            $types .= "s";
        }
    }

    // Year range
    if (!empty($_GET["year_from"]) && !empty($_GET["year_to"])) {
        $query .= " AND year BETWEEN ? AND ?";
        $params[] = $_GET["year_from"];
        $params[] = $_GET["year_to"];
        $types .= "ss";
    } elseif (!empty($_GET["year_from"])) {
        $query .= " AND year >= ?";
        $params[] = $_GET["year_from"];
        $types .= "s";
    } elseif (!empty($_GET["year_to"])) {
        $query .= " AND year <= ?";
        $params[] = $_GET["year_to"];
        $types .= "s";
    }

    // IMDb Rating range
    if (!empty($_GET["imdb_from"]) && !empty($_GET["imdb_to"])) {
        $query .= " AND imdb BETWEEN ? AND ?";
        $params[] = $_GET["imdb_from"];
        $params[] = $_GET["imdb_to"];
        $types .= "ss";
    } elseif (!empty($_GET["imdb_from"])) {
        $query .= " AND imdb >= ?";
        $params[] = $_GET["imdb_from"];
        $types .= "s";
    } elseif (!empty($_GET["imdb_to"])) {
        $query .= " AND imdb <= ?";
        $params[] = $_GET["imdb_to"];
        $types .= "s";
    }

    // Sorting by year
    $year_sort_order = "DESC"; // Default sorting: descending (to_down)
    if (!empty($_GET["years"])) {
        if ($_GET["years"] === "to_up") {
            $year_sort_order = "ASC";
        } elseif ($_GET["years"] === "to_down") {
            $year_sort_order = "DESC";
        }
    }
    $query .= " ORDER BY year $year_sort_order";

    // Prepare and execute query
    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $htmlContent = '';
    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $htmlContent .= search_card($data, $image_starter);
        }
    }

    echo json_encode(["length" => $result->num_rows, "data" => $htmlContent]);
} else {
    echo json_encode(["length" => 0, "data" => ""]);
}

?>