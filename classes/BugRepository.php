<?php

class BugRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
       $this->pdo =$pdo;
    }

    public function create(
        string $title,
        string $description,
        string $language,
        string $category,
        string $difficulty,
        string $cause,
        string $solution,
        string $lesson
    ): void {

       $stmt = $this->pdo->prepare(
            "INSERT INTO bugs
            (title, description, language, category, difficulty, cause, solution, lesson)
            VALUES
            (:title, :description, :language, :category, :difficulty, :cause, :solution, :lesson)"
        );

       $stmt->execute([
            ':title' =>$title,
            ':description' =>$description,
            ':language' =>$language,
            ':category' =>$category,
            ':difficulty' =>$difficulty,
            ':cause' =>$cause,
            ':solution' =>$solution,
            ':lesson' =>$lesson
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM bugs"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findByID(int $id): ?array
    {
       $stmt =$this->pdo->prepare("SELECT * FROM bugs WHERE id = :id");

       $stmt->execute([':id' =>$id]);

       $bug =$stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$bug) {
            return null;
        }

        return $bug;
    }

    public function update(
        int $id,
        string $title,
        string $description,
        string $language,
        string $category,
        string $difficulty,
        string $cause,
        string $solution,
        string $lesson
    ): void {

       $stmt =$this->pdo->prepare(
            "UPDATE bugs SET
            title = :title,
            description = :description,
            language = :language,
            category = :category,
            difficulty = :difficulty,
            cause = :cause,
            solution = :solution,
            lesson = :lesson
            WHERE id = :id"
        );

       $stmt->execute([
            ':id' =>$id,
            ':title' =>$title,
            ':description' =>$description,
            ':language' =>$language,
            ':category' =>$category,
            ':difficulty' =>$difficulty,
            ':cause' =>$cause,
            ':solution' =>$solution,
            ':lesson' =>$lesson
        ]);
    }

    public function delete(int $id): bool
    {
       $stmt =$this->pdo->prepare(
            "DELETE FROM bugs WHERE id = :id"
        );

       $stmt->execute([
            ':id' =>$id
        ]);

        return$stmt->rowCount() > 0;
    }
}