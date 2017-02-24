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
    }
}
