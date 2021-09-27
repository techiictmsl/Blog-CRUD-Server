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
        $query = "SELECT * FROM approved_articles WHERE article_id='".$artid."';";
        $query_domain = "SELECT domain FROM domain_filter WHERE article_id='".$artid."';";
        $query_sub_domain = "SELECT sub_domain FROM subdom_filter WHERE article_id='".$artid."';";
      
        $article = $this->getQueryResult($query);
        $i = 0;
        foreach ($this->getQueryResult($query_domain) as $row) {
            $article[0]['domains'][$i++] = $row['domain'];
        }
        $i = 0;
        foreach ($this->getQueryResult($query_sub_domain) as $row) {
            $article[0]['sub_domains'][$i++] = $row['sub_domain'];
        }

        return $article;
    }

    public function getQueryResult($query)
    {
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }
    
  }

 ?>