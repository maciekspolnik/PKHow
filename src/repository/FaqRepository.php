<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/FAQ.php';

class FaqRepository extends Repository
{
    public function getAllFAQ(): array
    {
        $result = [];
        $statement = $this->database->connect()->prepare('
            SELECT * FROM all_faqs
        ');
        $statement->execute();
        $allFaq = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allFaq as $faq) {
            $result[] = new FAQ(
                $faq['question'],
                $faq['answer']
            );
        }
        return $result;
    }

    public function getFAQByData(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.faq WHERE LOWER(question) LIKE :search OR LOWER(answer) LIKE :search
        ');
        $statement->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}