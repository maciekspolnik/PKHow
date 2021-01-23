<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Video.php';

class VideoRepository extends Repository
{
    public function  getVideo(int $id): ?Video
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.videos WHERE id = :id
        ');
        $statement->bindParam(':id',$id,PDO::PARAM_INT);
        $statement->execute();

        $video = $statement->fetch(PDO::FETCH_ASSOC);

        if($video == false){
            return null;
        }
        return new video(
            $video['title'],
            $video['description'],
            $video['image'],
            $video['url']
        );
    }

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
        INSERT INTO videos (title, description, created_at, id_assigned_by,image,url) 
        VALUES(?,?,?,?,?,?)
    ');
    $assignedById = 1;
    $statement->execute([
        $video->getTitle(),
        $video->getDescription(),
        $date->format('Y-m-d'),
        $assignedById,
        $video->getImage(),
        $video->getUrl()
    ]);
    }
}