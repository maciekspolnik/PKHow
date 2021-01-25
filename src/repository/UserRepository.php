<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('
            SELECT u.id as id, email, password, name, surname, phone_number FROM public.users u LEFT JOIN user_details ud on ud.id = u.id_user_details WHERE email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
        return new User(
            $user['id'], $user['email'], $user['password'], $user['name'], $user['surname']
        );
    }

    public function newUser($email, $password, $name, $surname, $phone)
    {
        $PDO = $this->database->connect();
        $PDO->beginTransaction();

        $statement = $PDO->prepare('
            INSERT INTO public.user_details (name,surname,phone_number)
            VALUES(?,?,?)
        ');
        $statement->execute([
            $name,
            $surname,
            $phone
        ]);

        $statement = $PDO->prepare('  
            SELECT MAX(id)
            FROM public.user_details
        ');
        $statement->execute();
        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);
        $newUserDetailID = $userDetails['max'];

        $statement = $PDO->prepare('
            INSERT INTO public.users (email,password,id_user_details)
            VALUES(?,?,?)
        ');
        $outcome = $statement->execute([
            $email,
            $password,
            $newUserDetailID
        ]);

        $PDO->commit();
        return $outcome;
    }

    public function getUserDetailsId(User $user): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname AND phone_number = :phone
        ');
        $statement->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $statement->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function cookieCheck($user_token): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT id_user,token FROM session
        ');
        $statement->execute();

        $cookieInfo = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cookieInfo as $cookie) {
            if ($cookie['token'] == $user_token) {
                return $cookie['id_user'];
            }
        }
        return 0;
    }

    public function setCookie($id, $token)
    {
        $statement = $this->database->connect()->prepare('
        DELETE FROM session WHERE id_user=:id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement = $this->database->connect()->prepare('
            INSERT INTO session (id_user,token,expiration_date)
            VALUES(?,?,?)
        ');

        $time = date("Y-m-d H:i:s", time() + 3600);
        try {
            $statement->execute([
                $id,
                $token,
                $time
            ]);
        } catch (PDOException $e) {
            die("Exception happened while setting cookie. Message: " . $e->getMessage());
        }
    }

    public function unsetCookie($token): string
    {
        try {
            $statement = $this->database->connect()->prepare('
            DELETE FROM session WHERE token=:token
        ');
            $statement->bindParam(':token', $token, PDO::PARAM_STR);
            $statement->execute();
            return ("Wylogowano");
        } catch (PDOException $e) {
            return ("Exception happened while unsetting cookie. Message: " . $e->getMessage());
        }
    }
}