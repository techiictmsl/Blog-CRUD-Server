<?php 

  /**
 * @OA\Info(title="IIC Blog Rest API MySql", version="0.1")
 */

  class Read {
    // DB stuff
    private $conn;
    private $table = 'approvedarticles';

    // Read Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    /**
     * @OA\Get(
     *     path="/iic-blog-mysql/api/read/article.php",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article ID",
     *          in="query",
     *          @OA\Schema (
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function readArticle($artid)
    {
      $query = "SELECT * FROM approvedarticles WHERE article_id='2021Emd0970Z02165054pLs';";

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();

      return $result;
    }
    
  }

 ?>