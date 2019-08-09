<?php
class User implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    private $_id;
    private $first_name;
    private $last_name;
    private $age;


    public function bsonSerialize()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age
        ];
    }

    function bsonUnserialize(array $map)
    {
        foreach ($map as $k => $value) {
            $this->$k = $value;
        }
    }
    /**
     * Set the value of first_name
     *
     * @return  self
     */
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of first_name
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }
}



require "vendor/autoload.php";


// se connecter au serveur de la base de données
$client = new MongoDB\Client("mongodb://51.15.217.149:27718");

// si la base de données n'existe pas il va la créer
// si la collection (équivalent à table en SQL) n'existe pas il va la créer
$collection = $client->shop->user;



// $user = new User();
// $user->setFirst_name("Test");
// $user->setLast_name("Test Last name");
// $user->setAge(11);

//  $collection->insertOne($user);


$result = $collection->findOne(["first_name" => "Test"]);
echo $result['first_name'] . PHP_EOL;
$result_string = MongoDB\BSON\fromPHP($result);

$user = MongoDB\BSON\toPHP($result_string, ['root' => "User"]);
//var_dump($user);
echo $user->getFirst_name() . PHP_EOL;
