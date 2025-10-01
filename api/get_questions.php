<?php
/**
 * API Endpoint: Get Quiz Questions
 * Returns questions from MySQL database in JSON format
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Database connection
include_once '../includes/db_connection.php';

global $wpdb;

// Get limit parameter (default 20)
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build query
$sql = "SELECT * FROM quiz_questions";
if (!empty($category)) {
    $sql .= $wpdb->prepare(" WHERE category = %s", $category);
}
$sql .= $wpdb->prepare(" ORDER BY RAND() LIMIT %d", $limit);

$results = $wpdb->get_results($sql);

$questions = [];
if ($results) {
    foreach ($results as $row) {
        $questions[] = [
            'id' => (int)$row->id,
            'question' => $row->question_text,
            'image' => $row->image_path,
            'options' => [
                $row->option_a,
                $row->option_b,
                $row->option_c,
                $row->option_d
            ],
            'correct' => (int)$row->correct_answer,
            'category' => $row->category,
            'explanation' => $row->explanation
        ];
    }
}

echo json_encode($questions, JSON_UNESCAPED_UNICODE);
?>


