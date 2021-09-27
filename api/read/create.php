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

    $article = array(
        'title' => 'testing korbo na to kibhabe bujhbo thik ki na?2',
        'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consectetur neque vitae leo dignissim fringilla. Proin ligula arcu, posuere eget augue in, pretium laoreet tortor. Vivamus at lorem facilisis arcu tincidunt scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In eget fringilla purus. Sed nibh mauris, mattis id turpis eu, molestie consequat mi. Sed lacinia mi at tortor volutpat, non elementum dolor sodales. Integer vitae dui volutpat, rhoncus mi sed, tempus lacus. Aenean eget mi vitae ex interdum facilisis. Quisque nec lectus varius, dignissim enim eget, rutrum lorem. In hac habitasse platea dictumst. Vivamus et mauris ac sapien porta commodo. Nunc quis vulputate turpis, id gravida dolor.Phasellus ultricies magna urna, quis convallis lorem dictum eu. Vestibulum tempor porttitor mauris id bibendum. Quisque tempor, eros sed eleifend fringilla, libero lectus elementum purus, nec rutrum nisl magna a libero. Nam sem odio, porttitor sit amet nibh vitae, faucibus imperdiet tortor. In viverra erat ac magna iaculis, ut fermentum ex venenatis. Quisque quis mattis magna. Etiam sem felis, tempor at lorem eget, finibus congue tellus. Quisque rutrum ornare nunc, elementum hendrerit lacus viverra ut. Pellentesque commodo elit ut neque elementum, id lacinia ante suscipit.Donec ac lorem ligula. Morbi hendrerit vehicula sagittis. Curabitur aliquet at orci id facilisis. Vivamus aliquet ac felis nec interdum. Donec consequat justo sed massa laoreet interdum. Nam lobortis fringilla enim non ullamcorper. Donec sit amet convallis ligula. Vestibulum ut leo imperdiet, ultricies dolor sit amet, porta dolor. Vestibulum vel commodo mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed congue malesuada iaculis. Aliquam venenatis varius massa, et tempor tellus varius eget. Fusce hendrerit ac velit tincidunt pellentesque.Curabitur purus leo, dignissim quis ultricies vitae, efficitur in dolor. Nunc sed tortor condimentum, lobortis neque non, rutrum mi. Phasellus blandit, nisi sed mollis pulvinar, nisl justo vehicula ex, sit amet porttitor dui ligula sed nisl. Cras laoreet orci ut pretium imperdiet. Nunc id laoreet mauris, et bibendum est. Duis vitae blandit orci, in cursus elit. Suspendisse potenti. Aliquam libero eros, interdum mollis posuere sed, lobortis semper ipsum. Etiam tristique arcu eu cursus aliquet. Proin euismod, lorem id mollis dignissim, quam velit hendrerit odio, dictum lobortis quam arcu non tortor. In aliquet vitae erat ac maximus. Aenean leo purus, consectetur ac blandit non, venenatis id urna. Vivamus sit amet nisl neque. Quisque placerat turpis nec tellus gravida, sed sollicitudin risus consequat. Aenean vestibulum lacus vehicula facilisis hendrerit.Nam eget gravida arcu. Fusce pretium ultricies elit, a luctus tortor ullamcorper efficitur. Nam sagittis nunc sit amet venenatis malesuada. Quisque viverra laoreet vehicula. Integer ipsum urna, tincidunt in efficitur a, tempus id purus. Suspendisse potenti. Aliquam erat volutpat. Sed commodo lectus a sapien vulputate dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nec sapien erat. Aliquam molestie mi sit amet pharetra egestas. Praesent pharetra turpis erat, id blandit tortor vestibulum quis. Nunc posuere, leo non cursus blandit, augue ex viverra nisl, eu facilisis diam orci sed odio. Integer aliquam, mauris eget finibus tempus, libero risus efficitur nulla, vitae euismod magna risus in augue.',
        'auth_name' => 'Debjit Dasgupta',
        'Auth_designation' => 'Co-head',
        'write_date' =>  date("Y-m-d H:i:s"),
        'domain' =>  'Tech, Software',
        'sub_domain' =>  'CPU, Cache, Parallel Processing',
        'status' => 0,
        'views' => 0,
        'likes' => 0,
        'image_count' => 0,
        'image_link' => "",
        'user_id' => 'abc0123',
        'article_id' => 'abc0123 '.date("Y-m-d H:i:s"),
        'facebook_link' => '',
        'twitter_link' => '',
        'linkedin_link' => ''
    );

    // 4th Server Call
    $s4res = sendS4($article);
    print_r($s4res);

    function sendS4($data)
    {
        $url = "http://localhost:8000/submit_unpublished_article?article=".urlencode( json_encode($data) );
        $ch = curl_init();
        $payload = json_encode($data);
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }


?>