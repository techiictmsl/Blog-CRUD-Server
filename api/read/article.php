<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../vendor/autoload.php';
    include_once '../../config/Database.php';
    include_once '../../models/Read.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $post = new Read($db);

    $articleId = $_GET['id'];

    $result = $post->readArticle($articleId);

    if ($result) {
        // Call 4th Server for suggestion
        $s4res = readS4($_GET['id']);

        $alldata['status'] = "200";
        $alldata['message'] = "All OK";
        $alldata['article'] = $result;
        $alldata['suggestions'] = $s4res->res1;
        $alldata['same_author'] = $s4res->res2;
        
        echo json_encode($alldata);
    }
    else {
        echo json_encode(array("status" => "400", "message" => "Bad Request"));
    }

    function readS4($art_id)
    {
        $url = "http://localhost:8000/Suggestions?article_id=".urlencode($art_id);
        $ch = curl_init();
        
        $payload = array("article_id" => $art_id );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);
        
        return json_decode($res);
    }

?>