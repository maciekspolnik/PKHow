<?php

require_once __DIR__.'/../repository/UserRepository.php';

class AppController{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet():bool
    {
        return $this->request === 'GET';
    }
    protected function isPost():bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'.$template.'.php';
        $output = "File not found";

        if(file_exists($templatePath))
        {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function setCookie($id, $token)
    {
        $userRepository = new UserRepository();
        $userRepository->setCookie($id, $token);

        setcookie('user_token', $token, time() + 3600, '/');
    }

    protected function unsetCookie($token): string
    {
        $userRepository = new UserRepository();

        try {
            setcookie('user_token', null, -1, '/');
        } catch (Exception $e) {
            return ('Error while setting cookie: ' . $e->getMessage());}
        return $userRepository->unsetCookie($token);
    }

    protected function getCurrentUserID(): int
    {
        $userRepository = new UserRepository();

        if (isset($_COOKIE['user_token'])) {
            return $userRepository->cookieCheck($_COOKIE['user_token']);}
        return 0;
    }

    protected function cookieCheck(): int
    {
        $userID=$this->getCurrentUserID();
        if($userID!=0){
            return $userID;}
        return 0;
    }
}