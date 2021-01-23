<?php
// Account class
class Account
{
	/* Class properties (variables) */
	
	/* The ID of the logged in account (or NULL if there is no logged in account) */
	private $id;
	
	/* The name of the logged in account (or NULL if there is no logged in account) */
	private $name;

	/* TRUE if the user is authenticated, FALSE otherwise */
    private $authenticated;
    
    private $dog_layer_code;
    private $cat_layer_code;
    private $fish_layer_code;
	
	
	/* Public class methods (functions) */
	
	/* Constructor */
	public function __construct()
	{
		/* Initialize the $id and $name variables to NULL */
		$this->id = NULL;
		$this->name = NULL;
		$this->authenticated = FALSE;
	}
	
	/* Destructor */
	public function __destruct()
	{
		
    }

    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    /* Add a new account to the system and return its ID (the account_id column of the accounts table) */
    public function addAccount(string $username, string $passwd, string $name): int
    {
        /* Global $pdo object */
        global $pdo;
        
        /* Trim the strings to remove extra spaces */
        $username = trim($username);
        $passwd = trim($passwd);
        $name = trim($name);

        /* Check if the user name is valid. If not, throw an exception */
        if (!$this->isNameValid($name))
        {
            throw new Exception('Invalid user name');
        }
        
        /* Check if the password is valid. If not, throw an exception */
        if (!$this->isPasswdValid($passwd))
        {
            throw new Exception('Invalid password');
        }
        
        /* Check if an account having the same name already exists. If it does, throw an exception */
        if (!is_null($this->getIdFromName($username)))
        {
            throw new Exception('Username not available');
        }
        
        /* Finally, add the new account */
        /* Create encoding for photo layers */

        $numbers = range(0, 14);
        shuffle($numbers);
        $dog_layer1 = pow(10, $numbers[0]);
        $dog_layer2 = pow(10, $numbers[1]);
        $dog_layer3 = pow(10, $numbers[2]);

        $dog_layer = $dog_layer1 + $dog_layer2 + $dog_layer3;
        $this->dog_layer_code = array($numbers[0], $numbers[1], $numbers[2]);

        $numbers = range(0, 14);
        shuffle($numbers);
        $cat_layer1 = pow(10, $numbers[0]);
        $cat_layer2 = pow(10, $numbers[1]);
        $cat_layer3 = pow(10, $numbers[2]);

        $cat_layer = $cat_layer1 + $cat_layer2 + $cat_layer3;
        $this->cat_layer_code = array($numbers[0], $numbers[1], $numbers[2]);

        $numbers = range(0, 14);
        shuffle($numbers);
        $fish_layer1 = pow(10, $numbers[0]);
        $fish_layer2 = pow(10, $numbers[1]);
        $fish_layer3 = pow(10, $numbers[2]);

        $fish_layer = $fish_layer1 + $fish_layer2 + $fish_layer3;
        $this->fish_layer_code = array($numbers[0], $numbers[1], $numbers[2]);
        
        
        /* Insert query template */
        $query = 'INSERT INTO accounts (`username`, `password`, `dog_layer`, `cat_layer`, `fish_layer`, `name`) VALUES (:username, :passwd, :dog_layer, :cat_layer, :fish_layer, :name)';
        
        /* Password hash */
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        
        /* Values array for PDO */
        $values = array(':username' => $username, ':passwd' => $hash, ':name' => $name, ':dog_layer' => $dog_layer, ':cat_layer' => $cat_layer, ':fish_layer' => $fish_layer);
        
        /* Execute the query */
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
        /* If there is a PDO exception, throw a standard exception */
        throw new Exception('Database query error');
        }
        
        /* Return the new ID */
        return $pdo->lastInsertId();
    }

    public function getLayerCodes(){
        return array($this->dog_layer_code, $this->cat_layer_code, $this->fish_layer_code);
    }

    /* A sanitization check for the account username */
    public function isNameValid(string $name): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;
        
        /* Example check: the length must be between 8 and 16 chars */
        $len = mb_strlen($name);
        
        if (($len < 5) || ($len > 16))
        {
            $valid = FALSE;
        }
        
        /* You can add more checks here */
        
        return $valid;
    }

    /* A sanitization check for the account password */
    public function isPasswdValid(string $passwd): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;
        
        /* Example check: the length must be between 8 and 16 chars */
        $len = mb_strlen($passwd);
        
        if (($len < 8) || ($len > 32))
        {
            $valid = FALSE;
        }
        
        /* You can add more checks here */
        
        return $valid;
    }

    /* Returns the account id having $name as name, or NULL if it's not found */
    public function getIdFromName(string $name): ?int
    {
        /* Global $pdo object */
        global $pdo;
        
        /* Since this method is public, we check $name again here */
        if (!$this->isNameValid($name))
        {
            throw new Exception('Invalid user name');
        }
        
        /* Initialize the return value. If no account is found, return NULL */
        $id = NULL;
        
        /* Search the ID on the database */
        $query = 'SELECT account_id FROM accounts WHERE (username = :name)';
        $values = array(':name' => $name);
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
        /* If there is a PDO exception, throw a standard exception */
        throw new Exception('Database query error');
        }
        
        $row = $res->fetch(PDO::FETCH_ASSOC);
        
        /* There is a result: get its ID */
        if (is_array($row))
        {
            $id = intval($row['account_id'], 10);
        }
        
        return $id;
    }

    /* Login with username and password */
    public function login(string $name, string $passwd, string $dog_layer, string $cat_layer, string $fish_layer): bool
    {
        /* Global $pdo object */
        global $pdo;

        
        /* Trim the strings to remove extra spaces */
        $name = trim($name);
        $passwd = trim($passwd);
        
        /* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isNameValid($name))
        {
            return FALSE;
        }
        
        /* Check if the password is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isPasswdValid($passwd))
        {
            return FALSE;
        }
        
        /* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
        $query = 'SELECT * FROM accounts WHERE (username = :name) AND (account_enabled = 1)';
        
        /* Values array for PDO */
        $values = array(':name' => $name);
        
        /* Execute the query */
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
        /* If there is a PDO exception, throw a standard exception */
        throw new Exception('Database query error');
        }
        
        $row = $res->fetch(PDO::FETCH_ASSOC);
        
        /* If there is a result, we must check if the password matches using password_verify() */
        if (is_array($row))
        {
            if (password_verify($passwd, $row['password']))
            {
                if ($row['dog_layer'] == $dog_layer && $row['cat_layer'] == $cat_layer  && $row['fish_layer'] == $fish_layer) {
                    /* Authentication succeeded. Set the class properties (id and name) */
                    $this->id = intval($row['account_id'], 10);
                    $this->name = $name;
                    $this->authenticated = TRUE;
                    
                    /* Register the current Sessions on the database */
                    $this->registerLoginSession();
                    
                    /* Finally, Return TRUE */
                    return TRUE;
                }
            }
        }
        
        /* If we are here, it means the authentication failed: return FALSE */
        return FALSE;
    }

    /* Saves the current Session ID with the account ID */
    private function registerLoginSession()
    {
        /* Global $pdo object */
        global $pdo;
        
        /* Check that a Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* 	Use a REPLACE statement to:
                - insert a new row with the session id, if it doesn't exist, or...
                - update the row having the session id, if it does exist.
            */
            $query = 'REPLACE INTO account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
            $values = array(':sid' => session_id(), ':accountId' => $this->id);
            
            /* Execute the query */
            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
            }
        }
    }

    /* Login using Sessions */
    public function sessionLogin(): bool
    {
        /* Global $pdo object */
        global $pdo;
        
        /* Check that the Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* 
                Query template to look for the current session ID on the account_sessions table.
                The query also make sure the Session is not older than 7 days
            */
            $query = 
            
            'SELECT * FROM account_sessions, accounts WHERE (account_sessions.session_id = :sid) ' . 
            'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
            'AND (accounts.account_enabled = 1)';
            
            /* Values array for PDO */
            $values = array(':sid' => session_id());
            
            /* Execute the query */
            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
            }
            
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            if (is_array($row))
            {
                /* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
                $this->id = intval($row['account_id'], 10);
                $this->name = $row['username'];
                $this->authenticated = TRUE;
                
                return TRUE;
            }
        }
        
        /* If we are here, the authentication failed */
        return FALSE;
    }

    /* Logout the current user */
    public function logout()
    {
        /* Global $pdo object */
        global $pdo;	
        
        /* If there is no logged in user, do nothing */
        if (is_null($this->id))
        {
            return;
        }
        
        /* Reset the account-related properties */
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;
        
        /* If there is an open Session, remove it from the account_sessions table */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* Delete query */
            $query = 'DELETE FROM account_sessions WHERE (session_id = :sid)';
            
            /* Values array for PDO */
            $values = array(':sid' => session_id());
            
            /* Execute the query */
            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
            }
        }
    }

    /* "Getter" function for the $authenticated variable
    Returns TRUE if the remote user is authenticated */
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

}

?>