<?php



class Connexion
{
    private $pdo;

    public function __construct()
    {
        
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function __destruct()
    {
        //écrase le contenu du $pdo
        $this->pdo = null;

        // 2ème méthode
        // unset($this->pdo) écrase complètement la variable $pdo 
    }

    public function querySQL($request, $execute_params)
    {
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($execute_params);
      
        // c'est pour récupérer le dernier id si les données ont étés ajoutées
        return $this->pdo->lastInsertId();

    }

    
    //getOne("SELECT * FROM product WHERE id=?", [20], "Product")
    public function getOne($request, $execute_params, $class)
    {
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($execute_params);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);

        return $stmt->fetch();
    }

    //getMany("SELECT * FROM product", "Product")
    public function getMany($request, $class, $execute_params = [])
    {
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($execute_params);

        return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
    }

    /**
     * Get the value of pdo
     */ 
    public function getPdo()
    {
        return $this->pdo;
    }
}
