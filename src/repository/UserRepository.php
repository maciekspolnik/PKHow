<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function  getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM users NATURAL JOIN user_details WHERE email = :email
        ');
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }
        return new User(
            $user['id'], $user['email'],$user['password'],$user['name'],$user['surname']
        );
    }
    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname, phone_number)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function newUser($email, $password, $name, $surname, $phone)
    {
        $PDO = $this->database->connect();
        $PDO->beginTransaction();

        $stmt = $PDO->prepare('
            INSERT INTO public.user_details (name,surname,phone_number)
            VALUES(?,?,?)
        ');
        $stmt->execute([
            $name,
            $surname,
            $phone
        ]);

        $stmt = $PDO->prepare('  
            SELECT MAX(id)
            FROM public.user_details
        ');
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        $newUserDetailID = $userDetails['max'];

        $stmt = $PDO->prepare('
            INSERT INTO public.users (email,password,id_user_details)
            VALUES(?,?,?)
        ');
        $outcome = $stmt->execute([
            $email,
            $password,
            $newUserDetailID
        ]);

        $PDO->commit();
        return $outcome;
    }


    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname AND phone_number = :phone
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function cookieCheck($user_token): int
    {

        $stmt = $this->database->connect()->prepare('
            SELECT id_user,token FROM session
        ');
        $currentDate = date("Y-m-d H:i:s");
     //   $stmt->bindParam(':token', $user_token, PDO::PARAM_STR);
    //    $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $stmt->execute();

        $cookieInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cookieInfo as $cookie)
        {  
            if ($cookie['token']==$user_token) {
            return 1;}
        }

        return 0;
    }

    public function setCookie($id, $token)
    {
        //Delete old cookies of this user.
        $stmt = $this->database->connect()->prepare('
        DELETE FROM session WHERE id_user=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO session (id_user,token,expiration_date)
            VALUES(?,?,?)
        ');

        $time = date("Y-m-d H:i:s", time() + 3600);
        try {
            $stmt->execute([
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
            $stmt = $this->database->connect()->prepare('
            DELETE FROM session WHERE token=:token
        ');
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            return ("Wylogowano");
        } catch (PDOException $e) {
            return ("Exception happened while unsetting cookie. Message: " . $e->getMessage());
        }

    }

    private function getUserDetails($userID)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_details LEFT JOIN users ON user_details.id=users.id_user_details WHERE users.id=:id
        ');
        $stmt->bindParam('id', $userID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
