<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Panel.php';

class PanelRepository extends Repository
{

    public function getAllPanels(): array
    {
        $result = [];
        $statement = $this->database->connect()->prepare('
            SELECT * FROM panels ORDER BY id
        ');
        $statement->execute();
        $allPanels = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allPanels as $panel)
        {
            $result[] = new Panel(
                $panel['title'],
                $panel['url']
            );
        }
        return $result;
    }

    public function getPanelByData(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.panels WHERE LOWER(title) LIKE :search
        ');
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}