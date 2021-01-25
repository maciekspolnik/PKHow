<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Video.php';

class VideoRepository extends Repository
{
    public function  getVideos(): array
    {
        $result = [];
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.videos
        ');
        $statement->execute();
        $videos = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($videos as $video)
        {
            $result[] = new Video(
                $video['title'],
                $video['description'],
                $video['url'],
                $video['image']
            );
        }
        return $result;
    }

    public function getVideoByTitle(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.videos WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $statement->bindParam(':search',$searchString,PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addVideo(Video $video): void
    {
    $date = new DateTime();
    $statement = $this->database->connect()->prepare('
        INSERT INTO videos (title, description, image, url) 
        VALUES(?,?,?,?)
    ');
    $statement->execute([
        $video->getTitle(),
        $video->getDescription(),
        $video->getImage(),
        $video->getUrl()
    ]);
    }
    public function getRole(int $ID)
    {

        $statement = $this->database->connect()->prepare('
            SELECT role FROM public.users u JOIN public.role r ON u.id = r.id_user WHERE u.id =:id
        ');
        $statement->bindParam(':id',$ID,PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['role'];
    }
}
