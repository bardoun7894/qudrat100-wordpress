<?php
/**
 * API Endpoint: Get Quiz Questions
 * Returns questions from MySQL database in JSON format
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Database connection
$conn = include '../includes/db_connection.php';

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get limit parameter (default 20)
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build query
$sql = "SELECT * FROM quiz_questions";
if (!empty($category)) {
    $sql .= " WHERE category = ?";
}
$sql .= " ORDER BY RAND() LIMIT ?";

$stmt = $conn->prepare($sql);

if (!empty($category)) {
    $stmt->bind_param("si", $category, $limit);
} else {
    $stmt->bind_param("i", $limit);
}

$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = [
        'id' => (int)$row['id'],
        'question' => $row['question_text'],
        'image' => $row['image_path'],
        'options' => [
            $row['option_a'],
            $row['option_b'],
            $row['option_c'],
            $row['option_d']
        ],
        'correct' => (int)$row['correct_answer'],
        'category' => $row['category'],
        'explanation' => $row['explanation']
    ];
}

$stmt->close();
$conn->close();

echo json_encode($questions, JSON_UNESCAPED_UNICODE);
?>

