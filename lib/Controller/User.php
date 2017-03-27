<?php

namespace Controller;

use \AccountKit\Controller as AccountKitConnection;
use \AccountKit\Models\User as AccountKitUserModel;
use \Database\User as UserDatabase;
use \Exception;

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
     * Save the new user that was provided through the form
     *
     * @param string[] $parameters
     * @return bool Whether we saved the name or not
     * @throws Exception
     */
    public function saveNewUser($parameters)
    {
        $facebookId = $_SESSION['facebookId'];
        if(empty($facebookId)) {
            throw new Exception("User does not have a valid user ID");
        }
        if(empty($parameters['name'])) {
            throw new Exception("User does not have a valid name");
        }
        $connection = new UserDatabase();
		if($saveSuccessful =
			$connection->saveNewUser($facebookId, $parameters['name'])
		) {
			$data = $connection->getUserData($facebookId);
			if(!empty($data)) {
				$this->updateUserLogin($data);
			}
		}
		return $saveSuccessful;
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
     * Checks to see whether or not the logged in user can scan
     *
     * @return bool
     */
    public function canUserScan()
    {
        $userPermissions = $this->getUserPermissions();
        return
            !empty($canScan = $userPermissions[UserDatabase::CAN_SCAN]) &&
            $canScan;
    }

    /**
     * Returns what the logged in user is able to do
     *
     * @return string[]
     */
    protected function getUserPermissions()
    {
        $database = new UserDatabase();
        return $database->getUserPermissions($_SESSION['userId']);
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
        $_SESSION['facebookId'] = $user->getUserId();
        $_SESSION['accessToken'] = $user->getAccessToken();
        if(empty($data)) {
            $this->requestUsersName();
        } else {
            $this->updateUserLogin($data);
			header('Location:index.php');
        }
    }

    /**
     * Redirect the user somewhere so that they can enter their name
     */
    protected function requestUsersName($user)
    {
        header('Location:getUserName.php');
    }

    /**
     * Update in the database that the user has logged in
     *
     * @param string[] $data
     * @TODO
     */
    protected function updateUserLogin($data)
    {
        $_SESSION['userId'] = $data[0]['userId'];
    }
}
