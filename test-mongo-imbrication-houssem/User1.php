<?php


class User implements MongoDB\BSON\Serializable, MongoDB\BSON\Unserializable
{
    private $_id;
    private $first_name;
    private $last_name;
    private $age;
    private $classe;

    public function bsonSerialize()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'classe' => $this->classe
        ];
    }

    function bsonUnserialize(array $map)
    {
        foreach ($map as $k => $value) {
            if ($k == "classe") {
                foreach ($map["classe"] as $classe) {
                    $c = new Classe();
                    $c->set_id($classe->_id);
                    $c->setNom($classe->nom);
                    $this->classe[] = $c;
                }
            } else {
                $this->$k = $value;
            }
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



    /**
     * Get the value of classe
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set the value of classe
     *
     * @return  self
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }
}
