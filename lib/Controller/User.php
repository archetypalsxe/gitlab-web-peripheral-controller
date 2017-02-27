<?php

namespace Controller;

use \AccountKit\Controller as AccountKitConnection;
use \AccountKit\Models\User as AccountKitUserModel;
use \Database\User as UserDatabase;

/**
 * Class for managing and controlling users
 */
class User
{
    /**
     * Handle the post fields that the user has submitted
     *
     * @param string[] $parameters
     */
    public function handleUserLoginPost($parameters)
    {
        if(empty($parameters['code'])) {
            // @TODO Should use a router controller to route back to the
            // login page
            return;
        }

        $connection = new AccountKitConnection();
        $user = $connection->getUserInformation($parameters['code']);

        if(!($user instanceof AccountKitUserModel)) {
            return;
        }

        $this->getUserFromAccountKitModel($user);
    }

    /**
     * Validate that the access token and user ID in the session are still
     * valid
     */
    public function validateAccessToken()
    {
        $connection = new AccountKitConnection();
        $user = $connection->revalidateToken($_SESSION['accessToken']);
        return $user;
    }

    /**
     * Takes in an AccountKit user model. If the user is an existing user,
     * retrieves the user model for it, if it's a new user, creates a user
     * model
     *
     * @param AccountKitUserModel
     * @return @TODO
     */
    protected function getUserFromAccountKitModel(AccountKitUserModel $user)
    {
        $database = new UserDatabase();
        $data = $database->getUserData($user->getUserId());
        if(empty($data)) {
            $this->requestUsersName($user);
        } else {
            $this->updateUserLogin($user, $data);
        }
    }

    /**
     * Redirect the user somewhere so that they can enter their name
     *
     * @param AccountKitUserModel $user
     */
    protected function requestUsersName(AccountKitUserModel $user)
    {
        $_SESSION['userId'] = $user->getUserId();
        $_SESSION['accessToken'] = $user->getAccessToken();
        header('Location:getUserName.php');
    }

    /**
     * Create a new user in the database with the provided model
     *
     * @param AccountKitUserModel $user
     * @return bool Whether or not we were successful
     * @TODO
     */
    protected function createNewUser(AccountKitUserModel $user)
    {
        $database = new UserDatabase();
    }

    /**
     * Update in the database that the user has logged in
     *
     * @param AccountKitUserModel $user
     * @param string[] $data
     * @TODO
     */
    protected function updateUserLogin(AccountKitUserModel $user, $data)
    {
    }
}
