<?php
declare(strict_types=1);
namespace Alura\MVC\Repository;

use Alura\MVC\Entity\Video;
use PDO;

class VideoRepository{
    public function __construct(
        private PDO $pdo,){
    }

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (url, titulo) VALUES (?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url); 
        $statement->bindValue(2, $video->titulo);
        if ($statement->execute()) {
            $id = $this->pdo->lastInsertId();
            $video->setId(intval($id));

            return true;
        } else {
            return false;
        }
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id); 

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update(Video $video): bool
    {
        $sql = 'UPDATE videos SET url = :url, titulo = :titulo WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        
        $statement->bindValue('url', $video->url); 
        $statement->bindValue('titulo', $video->titulo); 
        $statement->bindValue('id', $video->id); 

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // public function all(): array
    // {
    //     $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);
    //     return array_map(
    //         function (array $videoData){
    //             $video = new Video($videoData['url'], $videoData['titulo']);
    //             $video->setId($videoData['id']);
    //             return $video;
    //         }, 
    //         $videoList
    //     );
    // }
    
    /**
     * @return Video[]
     */
    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, \PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateVideo($statement->fetch(\PDO::FETCH_ASSOC));
    }

    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['titulo']);
        $video->setId($videoData['id']);

        return $video;
    }
}