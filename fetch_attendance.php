<?php
header("Content-Type: application/json");
require_once "db_connect.php";

$subject_id = $_GET["subject_id"] ?? null;
$section_id = $_GET["section_id"] ?? null;

if (!$subject_id || !$section_id) {
    echo json_encode(["error" => "Subject ID and Section ID are required."]);
    exit;
}

$query = "
    SELECT a.attendance_id, a.jntu_no, s.name, a.status 
    FROM attendance a
    JOIN students s ON a.jntu_no = s.jntu_no
    WHERE a.subject_id = ? AND s.section_id = ?
    ORDER BY a.date DESC, a.time DESC;
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $subject_id, $section_id);
$stmt->execute();
$result = $stmt->get_result();

$attendance_data = [];
while ($row = $result->fetch_assoc()) {
    $attendance_data[] = $row;
}

echo json_encode(["attendance" => $attendance_data]);
?>
