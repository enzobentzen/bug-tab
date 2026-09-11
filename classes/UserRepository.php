<?php


class UserRepository {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        
        $this->pdo = $pdo;
    }

    public function create(
        string $name,
        string $email,
        string $password
    ): void {
        $hash = password_hash($password, PASSWORD_BCRYPT); //para proteger a senha do usuario

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hash
        ]);
    }

    public function findByEmail(string $email): ?array
    {
       $stmt =$this->pdo->prepare("SELECT * FROM users WHERE email = :email");

       $stmt->execute([':email' =>$email]);

       $user =$stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            return null;
        }

        return $user;
    }
}