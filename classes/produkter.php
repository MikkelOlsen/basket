<?php

class Produkter{
    private $db = null;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function insert(string $navn, int $pris) : array
    {
        return $this->db->query("INSERT INTO `produkter`( `navn`, `pris`) VALUES (:navn, :pris)", [':navn' => $navn, ':pris' => $pris]);
    }

    public function getAll() : array
    {
        return $this->db->toList("SELECT * FROM `produkter`");
    }

    public function getOne(int $id) : stdClass
    {
        return $this->db->single("SELECT * FROM `produkter` WHERE id = :id", [':id' => $id]);
    }

    public function deleteOne(int $id) : array
    {
        return $this->db->query("DELETE FROM `produkter` WHERE id = :id", [':id' => $id]);
    }
    
    public function update(string $navn, int $pris, int $id) : array
    {
        return $this->db->query("UPDATE `produkter` SET `navn` = :navn, `pris` = :pris WHERE `id` = :id", [':navn' => $navn, ':pris' => $pris, ':id' => $id]);
    }
    
	public function OrdreListe(string $navn, string $adresse, int $pris) : array
	{
		return $this->db->query("INSERT INTO `ordreliste`( `navn`, `adresse`, `pris`) VALUES (:navn, :adresse, :pris)", [':navn' => $navn, ':adresse' => $adresse, ':pris' => $pris]);
	}
}