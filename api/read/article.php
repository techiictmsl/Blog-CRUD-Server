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

    // print_r($result);

    if ($result) {
        $alldata['status'] = "200";
        $alldata['message'] = "All OK";
        $alldata['article'] = $result;
        $suggestion = array(
            'article_id' => '2021ovY09vSI02165056JZR',
            'small_body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consecte' );
        $alldata['suggestions'] = array($suggestion, $suggestion, $suggestion, $suggestion, $suggestion );
        // print_r($alldata);
        echo json_encode($alldata);
    }
    else {
        // print_r(array("status" => "400", "message" => "Bad Request"));
        echo json_encode(array("status" => "400", "message" => "Bad Request"));
    }

?>