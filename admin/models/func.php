<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

//Functions that do not interact with DB
//------------------------------------------------------------------------------
//Retrieve a list of all .php files in models/languages
function getLanguageFiles() {
    $directory = "models/languages/";
    $languages = glob($directory . "*.php");
    //print each file name
    return $languages;
}



//Retrieve a list of all .css files in models/site-templates 
function getTemplateFiles() {
    $directory = "models/site-templates/";
    $languages = glob($directory . "*.css");
    //print each file name
    return $languages;
}

//Retrieve a list of all .php files in root files folder
function getPageFiles() {
    $directory = "";
    $pages = glob($directory . "*.php");
    //print each file name
    foreach ($pages as $page) {
        $row[$page] = $page;
    }
    return $row;
}

//Destroys a session as part of logout
function destroySession($name) {
    if (isset($_SESSION[$name])) {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}

//Generate a unique code
function getUniqueCode($length = "") {
    $code = md5(uniqid(rand(), true));
    if ($length != "")
        return substr($code, 0, $length);
    else
        return $code;
}

//Generate an activation key
function generateActivationToken($gen = null) {
    do {
        $gen = md5(uniqid(mt_rand(), false));
    } while (validateActivationToken($gen));
    return $gen;
}

//@ Thanks to - http://phpsec.org
function generateHash($plainText, $salt = null) {
    if ($salt === null) {
        $salt = substr(md5(uniqid(rand(), true)), 0, 25);
    } else {
        $salt = substr($salt, 0, 25);
    }

    return $salt . sha1($salt . $plainText);
}

//Checks if an email is valid
function isValidEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

//Inputs language strings from selected language.
function lang($key, $markers = NULL) {
    global $lang;
    if ($markers == NULL) {
        $str = $lang[$key];
    } else {
        //Replace any dyamic markers
        $str = $lang[$key];
        $iteration = 1;
        foreach ($markers as $marker) {
            $str = str_replace("%m" . $iteration . "%", $marker, $str);
            $iteration++;
        }
    }
    //Ensure we have something to return
    if ($str == "") {
        return ("No language key found");
    } else {
        return $str;
    }
}

//Checks if a string is within a min and max length
function minMaxRange($min, $max, $what) {
    if (strlen(trim($what)) < $min)
        return true;
    else if (strlen(trim($what)) > $max)
        return true;
    else
        return false;
}

//Replaces hooks with specified text
function replaceDefaultHook($str) {
    global $default_hooks, $default_replace;
    return (str_replace($default_hooks, $default_replace, $str));
}

//Displays error and success messages
function resultBlock($errors, $successes) {
    //Error block
    if (count($errors) > 0) {
        echo "<div id='error' class='alert alert-error'>
		<a href='#' onclick=\"showHide('error');\">[X]</a>
		<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    //Success block
    if (count($successes) > 0) {
        echo "<div id='success' class='alert alert-success'>
		<a href='#' onclick=\"showHide('success');\">[X]</a>
		<ul>";
        foreach ($successes as $success) {
            echo "<li>" . $success . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}

//Completely sanitizes text
function sanitize($str) {
    return strtolower(strip_tags(trim(($str))));
}

//Functions that interact mainly with .users table
//------------------------------------------------------------------------------
//Delete a defined array of users
function TotalEmployee() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		" . $db_table_prefix . "users.id, " . $db_table_prefix . "user_permission_matches.permission_id
		FROM " . $db_table_prefix . "users LEFT JOIN " . $db_table_prefix . "user_permission_matches ON 
		" . $db_table_prefix . "users.id = " . $db_table_prefix . "user_permission_matches.user_id  where " . $db_table_prefix . "user_permission_matches.permission_id = '1'");
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    return $num_returns;
}

function deleteUsers($users) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "users 
		WHERE id = ?");
    $stmt2 = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "user_permission_matches 
		WHERE user_id = ?");
    foreach ($users as $id) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $i++;
    }
    $stmt->close();
    $stmt2->close();
    return $i;
}

//Check if a display name exists in the DB
function displayNameExists($displayname) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "users
		WHERE
		display_name = ?
		LIMIT 1");
    $stmt->bind_param("s", $displayname);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if an email exists in the DB
function emailExists($email) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "users
		WHERE
		email = ?
		LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if a user name and email belong to the same user
function emailUsernameLinked($email, $username) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "users
		WHERE user_name = ?
		AND
		email = ?
		LIMIT 1
		");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Retrieve information for all users
function fetchAllUsers() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		user_name,
		display_name,
		password,
		email,
		activation_token,
		last_activation_request,
		lost_password_request,
		active,
		title,
		sign_up_stamp,
		last_sign_in_stamp
		FROM " . $db_table_prefix . "users");
    $stmt->execute();
    $stmt->bind_result($id, $user, $display, $password, $email, $token, $activationRequest, $passwordRequest, $active, $title, $signUp, $signIn);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'user_name' => $user, 'display_name' => $display, 'password' => $password, 'email' => $email, 'activation_token' => $token, 'last_activation_request' => $activationRequest, 'lost_password_request' => $passwordRequest, 'active' => $active, 'title' => $title, 'sign_up_stamp' => $signUp, 'last_sign_in_stamp' => $signIn);
    }
    $stmt->close();
    return ($row);
}

//Retrieve complete user information by username, token or ID
function fetchUserDetails($username = NULL, $token = NULL, $id = NULL) {
    if ($username != NULL) {
        $column = "user_name";
        $data = $username;
    } elseif ($token != NULL) {
        $column = "activation_token";
        $data = $token;
    } elseif ($id != NULL) {
        $column = "id";
        $data = $id;
    }
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		user_name,
		display_name,
		password,
		email,
		activation_token,
		last_activation_request,
		lost_password_request,
		active,
		title,
		sign_up_stamp,
		last_sign_in_stamp
		FROM " . $db_table_prefix . "users
		WHERE
		$column = ?
		LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result($id, $user, $display, $password, $email, $token, $activationRequest, $passwordRequest, $active, $title, $signUp, $signIn);
    while ($stmt->fetch()) {
        $row = array('id' => $id, 'user_name' => $user, 'display_name' => $display, 'password' => $password, 'email' => $email, 'activation_token' => $token, 'last_activation_request' => $activationRequest, 'lost_password_request' => $passwordRequest, 'active' => $active, 'title' => $title, 'sign_up_stamp' => $signUp, 'last_sign_in_stamp' => $signIn);
    }
    $stmt->close();
    return ($row);
}

//Toggle if lost password request flag on or off
function flagLostPasswordRequest($username, $value) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET lost_password_request = ?
		WHERE
		user_name = ?
		LIMIT 1
		");
    $stmt->bind_param("ss", $value, $username);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Check if a user is logged in
function isUserLoggedIn() {
    global $loggedInUser, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		password
		FROM " . $db_table_prefix . "users
		WHERE
		id = ?
		AND 
		password = ? 
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("is", $loggedInUser->user_id, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("userCakeUser");
            return false;
        }
    }
}

//Change a user from inactive to active
function setUserActive($token) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET active = 1
		WHERE
		activation_token = ?
		LIMIT 1");
    $stmt->bind_param("s", $token);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Change a user's display name
function updateDisplayName($id, $display) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET display_name = ?
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("si", $display, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Update a user's email
function updateEmail($id, $email) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET 
		email = ?
		WHERE
		id = ?");
    $stmt->bind_param("si", $email, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Input new activation token, and update the time of the most recent activation request
function updateLastActivationRequest($new_activation_token, $username, $email) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET activation_token = ?,
		last_activation_request = ?
		WHERE email = ?
		AND
		user_name = ?");
    $stmt->bind_param("ssss", $new_activation_token, time(), $email, $username);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Generate a random password, and new token
function updatePasswordFromToken($pass, $token) {
    global $mysqli, $db_table_prefix;
    $new_activation_token = generateActivationToken();
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET password = ?,
		activation_token = ?
		WHERE
		activation_token = ?");
    $stmt->bind_param("sss", $pass, $new_activation_token, $token);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Update a user's title
function updateTitle($id, $title) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "users
		SET 
		title = ?
		WHERE
		id = ?");
    $stmt->bind_param("si", $title, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Check if a user ID exists in the DB
function userIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "users
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Checks if a username exists in the DB
function usernameExists($username) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "users
		WHERE
		user_name = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if activation token exists in DB
function validateActivationToken($token, $lostpass = NULL) {
    global $mysqli, $db_table_prefix;
    if ($lostpass == NULL) {
        $stmt = $mysqli->prepare("SELECT active
			FROM " . $db_table_prefix . "users
			WHERE active = 0
			AND
			activation_token = ?
			LIMIT 1");
    } else {
        $stmt = $mysqli->prepare("SELECT active
			FROM " . $db_table_prefix . "users
			WHERE active = 1
			AND
			activation_token = ?
			AND
			lost_password_request = 1 
			LIMIT 1");
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Functions that interact mainly with .permissions table
//------------------------------------------------------------------------------
//Create a permission level in DB
function createPermission($permission) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "permissions (
		name
		)
		VALUES (
		?
		)");
    $stmt->bind_param("s", $permission);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Delete a permission level from the DB
function deletePermission($permission) {
    global $mysqli, $db_table_prefix, $errors;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "permissions 
		WHERE id = ?");
    $stmt2 = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "user_permission_matches 
		WHERE permission_id = ?");
    $stmt3 = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "permission_page_matches 
		WHERE permission_id = ?");
    foreach ($permission as $id) {
        if ($id == 1) {
            $errors[] = lang("CANNOT_DELETE_NEWUSERS");
        } elseif ($id == 2) {
            $errors[] = lang("CANNOT_DELETE_ADMIN");
        } else {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $stmt3->bind_param("i", $id);
            $stmt3->execute();
            $i++;
        }
    }
    $stmt->close();
    $stmt2->close();
    $stmt3->close();
    return $i;
}

//Retrieve information for all permission levels
function fetchAllPermissions() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		name
		FROM " . $db_table_prefix . "permissions");
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'name' => $name);
    }
    $stmt->close();
    return ($row);
}

//Retrieve information for a single permission level
function fetchPermissionDetails($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		name
		FROM " . $db_table_prefix . "permissions
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $row = array('id' => $id, 'name' => $name);
    }
    $stmt->close();
    return ($row);
}

//Check if a permission level ID exists in the DB
function permissionIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id
		FROM " . $db_table_prefix . "permissions
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if a permission level name exists in the DB
function permissionNameExists($permission) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id
		FROM " . $db_table_prefix . "permissions
		WHERE
		name = ?
		LIMIT 1");
    $stmt->bind_param("s", $permission);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Change a permission level's name
function updatePermissionName($id, $name) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "permissions
		SET name = ?
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("si", $name, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Functions that interact mainly with .user_permission_matches table
//------------------------------------------------------------------------------
//Match permission level(s) with user(s)
function addPermission($permission, $user) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "user_permission_matches (
		permission_id,
		user_id
		)
		VALUES (
		?,
		?
		)");
    if (is_array($permission)) {
        foreach ($permission as $id) {
            $stmt->bind_param("ii", $id, $user);
            $stmt->execute();
            $i++;
        }
    } elseif (is_array($user)) {
        foreach ($user as $id) {
            $stmt->bind_param("ii", $permission, $id);
            $stmt->execute();
            $i++;
        }
    } else {
        $stmt->bind_param("ii", $permission, $user);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}

//Retrieve information for all user/permission level matches
function fetchAllMatches() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		user_id,
		permission_id
		FROM " . $db_table_prefix . "user_permission_matches");
    $stmt->execute();
    $stmt->bind_result($id, $user, $permission);
    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'user_id' => $user, 'permission_id' => $permission);
    }
    $stmt->close();
    return ($row);
}

//Retrieve list of permission levels a user has
function fetchUserPermissions($user_id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		id,
		permission_id
		FROM " . $db_table_prefix . "user_permission_matches
		WHERE user_id = ?
		");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $permission);
    while ($stmt->fetch()) {
        $row[$permission] = array('id' => $id, 'permission_id' => $permission);
    }
    $stmt->close();
    if (isset($row)) {
        return ($row);
    }
}

//Retrieve list of users who have a permission level
function fetchPermissionUsers($permission_id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id, user_id
		FROM " . $db_table_prefix . "user_permission_matches
		WHERE permission_id = ?
		");
    $stmt->bind_param("i", $permission_id);
    $stmt->execute();
    $stmt->bind_result($id, $user);
    while ($stmt->fetch()) {
        $row[$user] = array('id' => $id, 'user_id' => $user);
    }
    $stmt->close();
    if (isset($row)) {
        return ($row);
    }
}

//Unmatch permission level(s) from user(s)
function removePermission($permission, $user) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "user_permission_matches 
		WHERE permission_id = ?
		AND user_id =?");
    if (is_array($permission)) {
        foreach ($permission as $id) {
            $stmt->bind_param("ii", $id, $user);
            $stmt->execute();
            $i++;
        }
    } elseif (is_array($user)) {
        foreach ($user as $id) {
            $stmt->bind_param("ii", $permission, $id);
            $stmt->execute();
            $i++;
        }
    } else {
        $stmt->bind_param("ii", $permission, $user);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}

//Functions that interact mainly with .configuration table
//------------------------------------------------------------------------------
//Update configuration table
function updateConfig($id, $value) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "configuration
		SET 
		value = ?
		WHERE
		id = ?");
    foreach ($id as $cfg) {
        $stmt->bind_param("si", $value[$cfg], $cfg);
        $stmt->execute();
    }
    $stmt->close();
}

//Functions that interact mainly with .pages table
//------------------------------------------------------------------------------
//Add a page to the DB
function createPages($pages) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "pages (
		page
		)
		VALUES (
		?
		)");
    foreach ($pages as $page) {
        $stmt->bind_param("s", $page);
        $stmt->execute();
    }
    $stmt->close();
}

//Delete a page from the DB
function deletePages($pages) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "pages 
		WHERE id = ?");
    $stmt2 = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "permission_page_matches 
		WHERE page_id = ?");
    foreach ($pages as $id) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
    }
    $stmt->close();
    $stmt2->close();
}

//Fetch information on all pages
function fetchAllPages() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		page,
		private
		FROM " . $db_table_prefix . "pages");
    $stmt->execute();
    $stmt->bind_result($id, $page, $private);
    while ($stmt->fetch()) {
        $row[$page] = array('id' => $id, 'page' => $page, 'private' => $private);
    }
    $stmt->close();
    if (isset($row)) {
        return ($row);
    }
}

//Fetch information for a specific page
function fetchPageDetails($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		page,
		private
		FROM " . $db_table_prefix . "pages
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $page, $private);
    while ($stmt->fetch()) {
        $row = array('id' => $id, 'page' => $page, 'private' => $private);
    }
    $stmt->close();
    return ($row);
}

//Check if a page ID exists
function pageIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT private
		FROM " . $db_table_prefix . "pages
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Toggle private/public setting of a page
function updatePrivate($id, $private) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "pages
		SET 
		private = ?
		WHERE
		id = ?");
    $stmt->bind_param("ii", $private, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Functions that interact mainly with .permission_page_matches table
//------------------------------------------------------------------------------
//Match permission level(s) with page(s)
function addPage($page, $permission) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "permission_page_matches (
		permission_id,
		page_id
		)
		VALUES (
		?,
		?
		)");
    if (is_array($permission)) {
        foreach ($permission as $id) {
            $stmt->bind_param("ii", $id, $page);
            $stmt->execute();
            $i++;
        }
    } elseif (is_array($page)) {
        foreach ($page as $id) {
            $stmt->bind_param("ii", $permission, $id);
            $stmt->execute();
            $i++;
        }
    } else {
        $stmt->bind_param("ii", $permission, $page);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}

//Retrieve list of permission levels that can access a page
function fetchPagePermissions($page_id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		id,
		permission_id
		FROM " . $db_table_prefix . "permission_page_matches
		WHERE page_id = ?
		");
    $stmt->bind_param("i", $page_id);
    $stmt->execute();
    $stmt->bind_result($id, $permission);
    while ($stmt->fetch()) {
        $row[$permission] = array('id' => $id, 'permission_id' => $permission);
    }
    $stmt->close();
    if (isset($row)) {
        return ($row);
    }
}

//Retrieve list of pages that a permission level can access
function fetchPermissionPages($permission_id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		id,
		page_id
		FROM " . $db_table_prefix . "permission_page_matches
		WHERE permission_id = ?
		");
    $stmt->bind_param("i", $permission_id);
    $stmt->execute();
    $stmt->bind_result($id, $page);
    while ($stmt->fetch()) {
        $row[$page] = array('id' => $id, 'permission_id' => $page);
    }
    $stmt->close();
    if (isset($row)) {
        return ($row);
    }
}

//Unmatched permission and page
function removePage($page, $permission) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "permission_page_matches 
		WHERE page_id = ?
		AND permission_id =?");
    if (is_array($page)) {
        foreach ($page as $id) {
            $stmt->bind_param("ii", $id, $permission);
            $stmt->execute();
            $i++;
        }
    } elseif (is_array($permission)) {
        foreach ($permission as $id) {
            $stmt->bind_param("ii", $page, $id);
            $stmt->execute();
            $i++;
        }
    } else {
        $stmt->bind_param("ii", $permission, $user);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}

//Check if a user has access to a page
function securePage($uri) {

    //Separate document name from uri
    $tokens = explode('/', $uri);
    $page = $tokens[sizeof($tokens) - 1];
    global $mysqli, $db_table_prefix, $loggedInUser;
    //retrieve page details
    $stmt = $mysqli->prepare("SELECT 
		id,
		page,
		private
		FROM " . $db_table_prefix . "pages
		WHERE
		page = ?
		LIMIT 1");
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $stmt->bind_result($id, $page, $private);
    while ($stmt->fetch()) {
        $pageDetails = array('id' => $id, 'page' => $page, 'private' => $private);
    }
    $stmt->close();
    //If page does not exist in DB, allow access
    if (empty($pageDetails)) {
        return true;
    }
    //If page is public, allow access
    elseif ($pageDetails['private'] == 0) {
        return true;
    }
    //If user is not logged in, deny access
    elseif (!isUserLoggedIn()) {
        header("Location: index.php");
        return false;
    } else {
        //Retrieve list of permission levels with access to page
        $stmt = $mysqli->prepare("SELECT
			permission_id
			FROM " . $db_table_prefix . "permission_page_matches
			WHERE page_id = ?
			");
        $stmt->bind_param("i", $pageDetails['id']);
        $stmt->execute();
        $stmt->bind_result($permission);
        while ($stmt->fetch()) {
            $pagePermissions[] = $permission;
        }
        $stmt->close();
        //Check if user's permission levels allow access to page
        if ($loggedInUser->checkPermission($pagePermissions)) {
            return true;
        }
        //Grant access if master user
        elseif ($loggedInUser->user_id == $master_account) {
            return true;
        } else {
            header("Location: account.php");
            return false;
        }
    }
}

//Functions that interact mainly with leads table
//------------------------------------------------------------------------------
//Check if a lead ID exists in the DB
function leadIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "leads
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if an email exists in the leads table by email
function leadExists($email) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id
		FROM " . $db_table_prefix . "leads
		WHERE
		email = ?
		LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if an email exists in the leads table by email
function franchiseExists($email) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id
		FROM " . $db_table_prefix . "franchise
		WHERE
		email = ?
		LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if an EFIN exists in the leads table by email
function EFINExists($ssefin) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT id
		FROM " . $db_table_prefix . "franchise
		WHERE
		ssefin = ?
		LIMIT 1");
    $stmt->bind_param("s", $ssefin);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Retrieve information for all leads
function fetchAllLeads() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		fname,
		lname,
		address,
		city_state_zip,
		phone,
		mobile,
		fax,
		tshirt_size,
		email,
		afname,
		alname,
		aemail,
		arelation,
		aphone,
		atshirt_size,
		event_date,
		date, event_type
		FROM " . $db_table_prefix . "leads");
    $stmt->execute();
    $stmt->bind_result(
            $id, $fname, $lname, $address, $city_state_zip, $phone, $mobile, $fax, $tshirt_size, $email, $afname, $alname, $aemail, $arelation, $aphone, $atshirt_size, $event_date, $date, $event_type);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'city_state_zip' => $city_state_zip, 'phone' => $phone, 'mobile' => $mobile, 'fax' => $fax, 'tshirt_size' => $tshirt_size, 'email' => $email, 'afname' => $afname, 'alname' => $alname, 'aemail' => $aemail, 'arelation' => $arelation, 'aphone' => $aphone, 'atshirt_size' => $atshirt_size, 'event_date' => $event_date, 'date' => $date, 'event_type' => $event_type);
    }
    $stmt->close();
    return ($row);
}

//Retrieve total no of lead 
function TotalLead() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id
		FROM " . $db_table_prefix . "leads");
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    return $num_returns;
}

//Retrieve complete lead information 
function fetchLeadDetails($id) {

    $data = $id;

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		fname,
		lname,
		address,
		city_state_zip,
		phone,
		mobile,
		fax,
		tshirt_size,
		email,
		afname,
		alname,
		aemail,
		arelation,
		aphone,
		atshirt_size,
		event_date,
		date, event_type
		FROM " . $db_table_prefix . "leads
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result(
            $id, $fname, $lname, $address, $city_state_zip, $phone, $mobile, $fax, $tshirt_size, $email, $afname, $alname, $aemail, $arelation, $aphone, $atshirt_size, $event_date, $date, $event_type);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'city_state_zip' => $city_state_zip, 'phone' => $phone, 'mobile' => $mobile, 'fax' => $fax, 'tshirt_size' => $tshirt_size, 'email' => $email, 'afname' => $afname, 'alname' => $alname, 'aemail' => $aemail, 'arelation' => $arelation, 'aphone' => $aphone, 'atshirt_size' => $atshirt_size, 'event_date' => $event_date, 'date' => $date, 'event_type' => $event_type);
    }
    $stmt->close();
    return ($row);
}

/// card program data

function cadrProgramDetails($id) {

    $data = $id;

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		card_program_id,
		company_name,
		address,
		city,
		state,
		zip,
		home_phone,
		cell_phone,
		email,
		created_date,
		created_by,
                qty,
                amount,
                fee,
                total

		FROM " . $db_table_prefix . "card_program
		WHERE
		card_program_id = ?
		LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result(
            $card_program_id, $company_name, $address, $city, $state, $zip, $home_phone, $cell_phone, $email, $created_date, $created_by, $qty, $amount, $fee, $total
    );

    while ($stmt->fetch()) {
        $row[] = array('card_program_id' => $card_program_id, 'company_name' => $company_name,
            'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip, 'home_phone' => $home_phone,
            'cell_phone' => $cell_phone, 'email' => $email, 'created_date' => $created_date, 'created_by' => $created_by,
            'qty' => $qty, 'amount' => $amount, 'fee' => $fee, 'total' => $total);
    }
    $stmt->close();
    return ($row);
}

/// card program data

function marketMaterialDetails($id) {

    $data = $id;

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT mm.marketing_materials_id,
        mm.marketing_materials_name,
        mm.marketing_materials_email,
        mm.contact_no,
        mm.shipping_address,
        mm.gift_cup_qty_id,
        cq.gift_cup_name,
        mm.employee_qty_id,
        eq.employee_qty_name,
        mm.shirt_qty_id,
        sq.shirt_tqy_name,
        mm.first_2_shirt,
        s.shirt_size_name AS 's',
        mm.second_2_shirt,
        ss.shirt_size_name  AS 'ss',
        mm.third_2_shirt,
        sss.shirt_size_name AS 'sss',
        mm.fourth_2_shirt,
        ssss.shirt_size_name AS 'ssss',
        mm.fifth_2_shirt,
        sssss.shirt_size_name AS 'sssss',
        mm.balloon_qty_id,
        bq.balloons_button_qty_name,
        mm.banner_qty_id,
        baq.banner_qty_name,
        mm.created_by,
        mm.created_date
        FROM " . $db_table_prefix . "marketing_materials mm
        LEFT JOIN " . $db_table_prefix . "gift_cup_qty cq ON cq.gift_cup_id =  mm.gift_cup_qty_id
        LEFT JOIN " . $db_table_prefix . "employee_qty eq ON eq.employee_qty_id =  mm.employee_qty_id
        LEFT JOIN " . $db_table_prefix . "shirt_qty sq ON sq.shirt_qty_id =  mm.shirt_qty_id
        LEFT JOIN " . $db_table_prefix . "shity_size s ON s.shirt_size_id =  mm.first_2_shirt
        LEFT JOIN " . $db_table_prefix . "shity_size ss ON ss.shirt_size_id =  mm.second_2_shirt
        LEFT JOIN " . $db_table_prefix . "shity_size sss ON sss.shirt_size_id =  mm.third_2_shirt
        LEFT JOIN " . $db_table_prefix . "shity_size ssss ON ssss.shirt_size_id =  mm.fourth_2_shirt
        LEFT JOIN " . $db_table_prefix . "shity_size sssss ON sssss.shirt_size_id =  mm.fifth_2_shirt
        LEFT JOIN " . $db_table_prefix . "balloons_button_qty bq ON bq.balloons_button_qty_id =  mm.balloon_qty_id
        LEFT JOIN " . $db_table_prefix . "banner_qty baq ON baq.banner_qty_id =  mm.banner_qty_id
        WHERE
        mm.marketing_materials_id = ?
        LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result(
            $marketing_materials_id,$marketing_materials_name, $marketing_materials_email, $contact_no, $shipping_address, $gift_cup_qty_id, $gift_cup_name, $employee_qty_id, $employee_qty_name, $shirt_qty_id, $shirt_tqy_name, $first_2_shirt, $s, $second_2_shirt, $ss, $third_2_shirt, $sss, $fourth_2_shirt, $ssss, $fifth_2_shirt, $sssss, $balloon_qty_id, $balloons_button_qty_name, $banner_qty_id, $banner_qty_name, $created_by, $created_date
    );

    while ($stmt->fetch()) {
        $row[] = array('marketing_materials_id' => $marketing_materials_id,
            'marketing_materials_name' => $marketing_materials_name, 'marketing_materials_email' => $marketing_materials_email,
            'contact_no' => $contact_no, 'shipping_address' => $shipping_address, 'gift_cup_qty_id' => $gift_cup_qty_id,
            'gift_cup_name' => $gift_cup_name, 'employee_qty_id' => $employee_qty_id,
            'employee_qty_name' => $employee_qty_name, 'shirt_qty_id' => $shirt_qty_id,
            'shirt_tqy_name' => $shirt_tqy_name,
            'first_2_shirt' => $first_2_shirt, 's' => $s,
            'second_2_shirt' => $second_2_shirt, 'ss' => $ss,
            'third_2_shirt' => $third_2_shirt, 'sss' => $sss,
            'fourth_2_shirt' => $fourth_2_shirt, 'ssss' => $ssss,
            'fifth_2_shirt' => $fifth_2_shirt, 'sssss' => $sssss,
            'balloon_qty_id' => $balloon_qty_id, 'balloons_button_qty_name' => $balloons_button_qty_name,
            'banner_qty_id' => $banner_qty_id, 'banner_qty_name' => $banner_qty_name,
            'created_by' => created_by, 'created_date' => $created_date);
    }
    $stmt->close();
    return ($row);
}

//Delete lead record
function deleteLeads($leads) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "leads 
		WHERE id = ?");
    foreach ($leads as $id) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}

// file uploading [not working]
function FileUpload($files, $temp_name) {

    $ran = rand();
    if (file_exists($file_upload_dir . $ran . $files)) {
        echo false;
    } else {
        move_uploaded_file($temp_name, $file_upload_dir . $ran . $files);
        echo true;
    }
}

// to check uploading file type
function isFileType($files) {
    $allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "txt", "rtf", "pdf", "xls", "xlsx", "ppt", "pptx");
    $temp = explode(".", $files);
    $extension = end($temp);
    if (in_array($extension, $allowedExts))
        return true;
    else
        return false;
}

//Retrieve information for all franchise
function fetchAllFranchise() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		fname,
		lname,
		ssefin,
		city_state_zip,
		phone,
		email,
		date,
		active,
		date_modified
		FROM " . $db_table_prefix . "franchise");
    $stmt->execute();
    $stmt->bind_result(
            $id, $fname, $lname, $ssefin, $city_state_zip, $phone, $email, $date, $active, $date_modified);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id, 'fname' => $fname, 'lname' => $lname, 'ssefin' => $ssefin, 'city_state_zip' => $city_state_zip, 'phone' => $phone, 'email' => $email, 'date' => $date, 'active' => $active, 'date_modified' => $date_modified);
    }
    $stmt->close();
    return ($row);
}

//Retrieve information for all card_program
function allCardProgram() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		card_program_id,
		company_name,
		address,
		city,
		state,
		zip,
		home_phone,
		cell_phone,
		email,
		total
		FROM " . $db_table_prefix . "card_program");
    $stmt->execute();
    $stmt->bind_result(
            $card_program_id, $company_name, $address, $city, $state, $zip, $home_phone, $cell_phone, $email, $total
    );

    while ($stmt->fetch()) {
        $row[] = array('card_program_id' => $card_program_id, 'company_name' => $company_name,
            'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip,
            'home_phone' => $home_phone, 'cell_phone' => $cell_phone, 'email' => $email, 'total' => $total);
    }
    $stmt->close();
    return ($row);
}



//Retrieve complete franchise information 
function fetchFranchiseDetails($id) {

    $data = $id;

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		fname,
		lname,
		ssefin,
		email,
		phone_business,
		phone,
		home_phone,
		fax,
		address,
		city_state_zip,
		developer_bank,
		software,
		afname,
		alname,
		aemail,
		primary_phone,
		aphone,
		afax,
		acity_state_zip,
		file,
		laddress,
		lstore,
		lstore_type,
		lcity_state_zip,
		lemail,
		lwebsite,
		lphone,
		lphone2,
		lfax,
		last_bank ,
		ssn_name ,
		current_bank ,
		bank_product ,
		account_type ,
		routing_number,
		routing_number_confirm ,
		account_no ,
		account_no_confirm ,
		date,
		date_modified,
		active,
		dob,
		marital_status,
		
		efin,
		active_date,
		developer,
		adob,
		amarital_status,
		
		laddress2,
		lstore2,
		lstore_type2,
		lcity_state_zip2,
		lemail2,
		lwebsite2,
		lphonee2,
		lphone22,
		lfax2,
		efin2,
		active_date2,
		developer2,
		
		laddress3,
		lstore3,
		lstore_type3,
		lcity_state_zip3,
		lemail3,
		lwebsite3,
		lphone3,
		lphone23,
		lfax3,
		efin3,
		active_date3,
		developer3 ,
		comments
		FROM " . $db_table_prefix . "franchise
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result(
            $id, $fname, $lname, $ssefin, $email, $phone_business, $phone, $home_phone, $fax, $address, $city_state_zip, $developer_bank, $software, $afname, $alname, $aemail, $primary_phone, $aphone, $afax, $acity_state_zip, $file, $laddress, $lstore, $lstore_type, $lcity_state_zip, $lemail, $lwebsite, $lphone, $lphone2, $lfax, $last_bank, $ssn_name, $current_bank, $bank_product, $account_type, $routing_number, $routing_number_confirm, $account_no, $account_no_confirm, $date, $date_modified, $active, $dob, $marital_status, $efin, $active_date, $developer, $adob, $amarital_status, $laddress2, $lstore2, $lstore_type2, $lcity_state_zip2, $lemail2, $lwebsite2, $lphonee2, $lphone22, $lfax2, $efin2, $active_date2, $developer2, $laddress3, $lstore3, $lstore_type3, $lcity_state_zip3, $lemail3, $lwebsite3, $lphone3, $lphone23, $lfax3, $efin3, $active_date3, $developer3, $comments);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'ssefin' => $ssefin,
            'email' => $email,
            'phone_business' => $phone_business,
            'phone' => $phone,
            'home_phone' => $home_phone,
            'fax' => $fax,
            'address' => $address,
            'city_state_zip' => $city_state_zip,
            'developer_bank' => $developer_bank,
            'software' => $software,
            'afname' => $afname,
            'alname' => $alname,
            'aemail' => $aemail,
            'primary_phone' => $primary_phone,
            'aphone' => $aphone,
            'afax' => $afax,
            'acity_state_zip' => $acity_state_zip,
            'file' => $file,
            'laddress' => $laddress,
            'lstore' => $lstore,
            'lstore_type' => $lstore_type,
            'lcity_state_zip' => $lcity_state_zip,
            'lemail' => $lemail,
            'lwebsite' => $lwebsite,
            'lphone' => $lphone,
            'lphone2' => $lphone2,
            'lfax' => $lfax,
            'last_bank' => $last_bank,
            'ssn_name' => $ssn_name,
            'current_bank' => $current_bank,
            'bank_product' => $bank_product,
            'account_type' => $account_type,
            'routing_number' => $routing_number,
            'routing_number_confirm' => $routing_number_confirm,
            'account_no' => $account_no,
            'account_no_confirm' => $account_no_confirm,
            'date' => $date,
            'date_modified' => $date_modified,
            'active' => $active,
            'dob' => $dob,
            'marital_status' => $marital_status,
            'efin' => $efin,
            'active_date' => $active_date,
            'developer' => $developer,
            'adob' => $adob,
            'amarital_status' => $amarital_status,
            'laddress2' => $laddress2,
            'lstore2' => $lstore2,
            'lstore_type2' => $lstore_type2,
            'lcity_state_zip2' => $lcity_state_zip2,
            'lemail2' => $lemail2,
            'lwebsite2' => $lwebsite2,
            'lphone2' => $lphone2,
            'lphone22' => $lphone22,
            'lfax2' => $lfax2,
            'efin2' => $efin2,
            'active_date2' => $active_date2,
            'developer2' => $developer2,
            'laddress3' => $laddress3,
            'lstore3' => $lstore3,
            'lstore_type3' => $lstore_type3,
            'lcity_state_zip3' => $lcity_state_zip3,
            'lemail3' => $lemail3,
            'lwebsite3' => $lwebsite3,
            'lphone3' => $lphone3,
            'lphone23' => $lphone23,
            'lfax3' => $lfax3,
            'efin3' => $efin3,
            'active_date3' => $active_date3,
            'developer3' => $developer3,
            'comments' => $comments);
    }
    $stmt->close();
    return ($row);
}

// franchise details by email
function fetchFranchiseDetailsByEmail($id) {

    $data = $id;

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id,
		fname,
		lname,
		ssefin,
		email,
		phone_business,
		phone,
		home_phone,
		fax,
		address,
		city_state_zip,
		developer_bank,
		software,
		afname,
		alname,
		aemail,
		primary_phone,
		aphone,
		afax,
		acity_state_zip,
		file,
		laddress,
		lstore,
		lstore_type,
		lcity_state_zip,
		lemail,
		lwebsite,
		lphone,
		lphone2,
		lfax,
		date,
		date_modified
		FROM " . $db_table_prefix . "franchise
		WHERE
		email = ?
		LIMIT 1");
    $stmt->bind_param("s", $data);

    $stmt->execute();
    $stmt->bind_result(
            $id, $fname, $lname, $ssefin, $email, $phone_business, $phone, $home_phone, $fax, $address, $city_state_zip, $developer_bank, $software, $afname, $alname, $aemail, $primary_phone, $aphone, $afax, $acity_state_zip, $file, $laddress, $lstore, $lstore_type, $lcity_state_zip, $lemail, $lwebsite, $lphone, $lphone2, $lfax, $date, $date_modified);

    while ($stmt->fetch()) {
        $row[] = array('id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'ssefin' => $ssefin,
            'email' => $email,
            'phone_business' => $phone_business,
            'phone' => $phone,
            'home_phone' => $home_phone,
            'fax' => $fax,
            'address' => $address,
            'city_state_zip' => $city_state_zip,
            'developer_bank' => $developer_bank,
            'software' => $software,
            'afname' => $afname,
            'alname' => $alname,
            'aemail' => $aemail,
            'primary_phone' => $primary_phone,
            'aphone' => $aphone,
            'afax' => $afax,
            'acity_state_zip' => $acity_state_zip,
            'file' => $file,
            'laddress' => $laddress,
            'lstore' => $lstore,
            'lstore_type' => $lstore_type,
            'lcity_state_zip' => $lcity_state_zip,
            'lemail' => $lemail,
            'lwebsite' => $lwebsite,
            'lphone' => $lphone,
            'lphone2' => $lphone2,
            'lfax' => $lfax,
            'date' => $date,
            'date_modified' => $date_modified);
    }
    $stmt->close();
    return ($row);
}

//Delete FRanchise record
function deleteFranchise($leads) {
    global $mysqli, $db_table_prefix;
    $i = 0;
    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "franchise 
		WHERE id = ?");
    foreach ($leads as $id) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $i++;
    }
    $stmt->close();
    return $i;
}





//Change a franchisee from inactive to active
function setFranchiseActive($token) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "franchise
		SET active = 1
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $token);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Change a franchisee from active to inactive
function setFranchiseDeactive($token) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "franchise
		SET active = 0
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $token);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Retrieve total no of franchisee 
function TotalFranchisee() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id
		FROM " . $db_table_prefix . "franchise");
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    return $num_returns;
}

//Retrieve total no of card program 
function TotalCardProgram() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		card_program_id
		FROM " . $db_table_prefix . "card_program");
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();
    return $num_returns;
}

//Retrieve total no of marketing metarials
function TotalCardMarketingMeterials() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		marketing_materials_id
		FROM " . $db_table_prefix . "marketing_materials");
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();
    return $num_returns;
}

//Retrieve information for all users
function fetchComments($leadId) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
							" . $db_table_prefix . "comments.comments,
							" . $db_table_prefix . "comments.date,
							" . $db_table_prefix . "users.display_name
							FROM " . $db_table_prefix . "comments
							LEFT JOIN " . $db_table_prefix . "users on " . $db_table_prefix . "comments.user_id = " . $db_table_prefix . "users.id
							WHERE
							" . $db_table_prefix . "comments.franchise_id = ?"
    );
    $stmt->bind_param("s", $leadId);

    $stmt->execute();
    $stmt->bind_result($comments, $date, $display_name);

    while ($stmt->fetch()) {
        $row[] = array('comments' => $comments, 'date' => $date, 'display_name' => $display_name);
    }
    $stmt->close();
    return ($row);
}

//Check if a lead ID exists in the DB
function franchiseIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT active
		FROM " . $db_table_prefix . "franchise
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if a lead ID exists in the DB
function cardProgramIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT card_program_id
		FROM " . $db_table_prefix . "card_program
		WHERE
		card_program_id = $id
		LIMIT 1");
    //$stmt->bind_param("card_program_id", $id);	
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();
    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Check if a lead ID exists in the DB for marketing materials
function marketingMaterialsIdExists($id) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT marketing_materials_id
		FROM " . $db_table_prefix . "marketing_materials
		WHERE
		marketing_materials_id = $id
		LIMIT 1");
    //$stmt->bind_param("card_program_id", $id);	
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();
    if ($num_returns > 0) {
        return true;
    } else {
        return false;
    }
}

//Create a permission level in DB
function addComment($franchise_id, $user_id, $comments) {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "comments (
		user_id,
		franchise_id,
		comments,
		date
		)
		VALUES (
		?,
		?,
		?,
		'" . time() . "'
		)");
    $stmt->bind_param("sss", $user_id, $franchise_id, $comments);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//Check if a franchise is logged in
function isFranchiseLoggedIn() {
    global $loggedInUser, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		id
		FROM " . $db_table_prefix . "franchise
		WHERE
		id = ?
		LIMIT 1");
    $stmt->bind_param("i", $loggedInUser->user_id);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("userCakeUser");
            return false;
        }
    }
}

//export event training to excel
function exportLead() {
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		fname,
		lname,
		address,
		city_state_zip,
		phone,
		mobile,
		fax,
		tshirt_size,
		email,
		afname,
		alname,
		aemail,
		arelation,
		aphone,
		atshirt_size,
		event_date,
		date, event_type
		FROM " . $db_table_prefix . "leads");

    $stmt->execute();
    $stmt->bind_result(
            $fname, $lname, $address, $city_state_zip, $phone, $mobile, $fax, $tshirt_size, $email, $afname, $alname, $aemail, $arelation, $aphone, $atshirt_size, $event_date, $date, $event_type);
    $row[] = array('fname' => 'First Name', 'lname' => 'Last Name', 'address' => 'Address', 'city_state_zip' => 'City/State/Zip', 'phone' => 'Phone', 'mobile' => 'Cell Phone', 'fax' => 'Fax', 'tshirt_size' => 'T-Shirt Size', 'email' => 'E-Mail', 'afname' => 'Attendee First Name', 'alname' => 'Attendee Last Name', 'aemail' => 'Attendee E-Mail', 'arelation' => 'Attendee Relation', 'aphone' => 'Attendee Phone', 'atshirt_size' => 'Attendee T-Shirt Size', 'event_date' => 'Event Date', 'date' => 'Date', 'event_type' => 'Event Type');

    while ($stmt->fetch()) {
        $row[] = array('fname' => $fname, 'lname' => $lname, 'address' => $address, 'city_state_zip' => $city_state_zip, 'phone' => $phone, 'mobile' => $mobile, 'fax' => $fax, 'tshirt_size' => $tshirt_size, 'email' => $email, 'afname' => $afname, 'alname' => $alname, 'aemail' => $aemail, 'arelation' => $arelation, 'aphone' => $aphone, 'atshirt_size' => $atshirt_size, 'event_date' => $event_date, 'date' => $date, 'event_type' => $event_type);
    }
    $count = $stmt->num_rows;
    $stmt->close();

    return ($row);
}

// delete card 
function deleteCards($id) {
    global $mysqli, $db_table_prefix;

    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "card_program 
		WHERE card_program_id = $id");
    $stmt->execute();
    $stmt->close();
}

// delete Marketing Materials 
function deleteMarketingMaterials($id) {
    global $mysqli, $db_table_prefix;

    $stmt = $mysqli->prepare("DELETE FROM " . $db_table_prefix . "marketing_materials 
		WHERE marketing_materials_id = $id");
    $stmt->execute();
    $stmt->close();
}

// export franchisee list
function exportFranchisee() {


    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT 
		fname,
		lname,
		ssefin,
		email,
		phone_business,
		phone,
		home_phone,
		fax,
		address,
		city_state_zip,
		developer_bank,
		software,
		afname,
		alname,
		aemail,
		primary_phone,
		aphone,
		afax,
		acity_state_zip,
		file,
		laddress,
		lstore,
		lstore_type,
		lcity_state_zip,
		lemail,
		lwebsite,
		lphone,
		lphone2,
		lfax,
		last_bank ,
		ssn_name ,
		current_bank ,
		bank_product ,
		account_type ,
		routing_number,
		routing_number_confirm ,
		account_no ,
		account_no_confirm ,
		date
		FROM " . $db_table_prefix . "franchise
		");

    $stmt->execute();
    $stmt->bind_result(
            $fname, $lname, $ssefin, $email, $phone_business, $phone, $home_phone, $fax, $address, $city_state_zip, $developer_bank, $software, $afname, $alname, $aemail, $primary_phone, $aphone, $afax, $acity_state_zip, $file, $laddress, $lstore, $lstore_type, $lcity_state_zip, $lemail, $lwebsite, $lphone, $lphone2, $lfax, $last_bank, $ssn_name, $current_bank, $bank_product, $account_type, $routing_number, $routing_number_confirm, $account_no, $account_no_confirm, $date);

    $row[] = array(
        'fname' => 'First Name',
        'lname' => 'Last Name',
        'ssefin' => 'Social Security EFIN',
        'email' => 'E-Mail Address',
        'phone_business' => 'Primary Phone Business',
        'phone' => 'Phone',
        'home_phone' => 'Home Phone',
        'fax' => 'Fax',
        'address' => 'Mailing Address',
        'city_state_zip' => 'City/State/Zip',
        'developer_bank' => 'Developer Bank Product',
        'software' => 'Software',
        'afname' => 'Partner First Name',
        'alname' => 'Partner Last Name',
        'aemail' => 'Partner E-Mail Address',
        'primary_phone' => 'Partner Primary Phone',
        'aphone' => 'Partner Business Phone',
        'afax' => 'Partner Fax',
        'acity_state_zip' => 'Partner City/State/Zip',
        'file' => 'Document Upload(EFIN letter)',
        'laddress' => 'Location Address',
        'lstore' => 'Store Category',
        'lstore_type' => 'Store Type',
        'lcity_state_zip' => 'City/State/Zip',
        'lemail' => 'Email',
        'lwebsite' => 'Website',
        'lphone' => 'Primary Phone',
        'lphone2' => 'Secondary Phone',
        'lfax' => 'Fax',
        'last_bank' => 'What bank did you use last tax season?',
        'ssn_name' => 'Business name EIN registered under, or SSN name',
        'current_bank' => 'Which bank will you use this tax season?',
        'bank_product' => 'Estimated Number of bank products - 2013',
        'account_type' => 'In what type of account will your fees be deposited?',
        'routing_number' => 'Routing Number',
        'routing_number_confirm' => 'Confirm Routing Number',
        'account_no' => 'Account Number',
        'account_no_confirm' => 'Confirm Account Number',
        'date' => 'Date'
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'fname' => $fname,
            'lname' => $lname,
            'ssefin' => $ssefin,
            'email' => $email,
            'phone_business' => $phone_business,
            'phone' => $phone,
            'home_phone' => $home_phone,
            'fax' => $fax,
            'address' => $address,
            'city_state_zip' => $city_state_zip,
            'developer_bank' => $developer_bank,
            'software' => $software,
            'afname' => $afname,
            'alname' => $alname,
            'aemail' => $aemail,
            'primary_phone' => $primary_phone,
            'aphone' => $aphone,
            'afax' => $afax,
            'acity_state_zip' => $acity_state_zip,
            'file' => $file,
            'laddress' => $laddress,
            'lstore' => $lstore,
            'lstore_type' => $lstore_type,
            'lcity_state_zip' => $lcity_state_zip,
            'lemail' => $lemail,
            'lwebsite' => $lwebsite,
            'lphone' => $lphone,
            'lphone2' => $lphone2,
            'lfax' => $lfax,
            'last_bank' => $last_bank,
            'ssn_name' => $ssn_name,
            'current_bank' => $current_bank,
            'bank_product' => $bank_product,
            'account_type' => $account_type,
            'routing_number' => $routing_number,
            'routing_number_confirm' => $routing_number_confirm,
            'account_no' => $account_no,
            'account_no_confirm' => $account_no_confirm,
            'date' => $date
        );
    }
    $stmt->close();
    return ($row);
}

function rs2array($sql) {
    global $mysqli;
    $result_sql = mysqli_query($mysqli, $sql);
    $result = array();
    while ($row = $result_sql->fetch_row()) {
        $result[] = $row;
    }
    return $result;
}

function comboBox($name, $data, $selectedValue, $allowNull, $class = null, $onChange = null, $ajux_sql = null, $onChangeFunction = null) {
    if ($onChange != '') {
        if ($ajux_sql != '') {
            $ajux_sql_call = '-' . $ajux_sql;
            $onChange = "ajaxLoader('$onChange.php?val='+this.value+'&id=$ajux_sql', '$onChange$ajux_sql_call', '<img src=../public/images/loading.gif />');";
        } else {
            $onChange = "ajaxLoader('$onChange.php?val='+this.value+'&id=$ajux_sql', '$onChange$ajux_sql', '<img src=../public/images/loading.gif />');";
        }
    } else {
        $onChange = $onChangeFunction == '' ? '' : "$onChangeFunction";
    }
    ?>
    <select name='<?php echo $name; ?>' id='<?php echo $name; ?>ID' class='<?php echo $class; ?>' onChange= "<?php echo $onChange; ?>"  

    <?php
    if (array_key_exists('readonly', $_REQUEST))
        echo "disabled=true ";
    echo ">\n";
    if ($allowNull)
        echo "<option></option>";
    for ($j = 0; $j < count($data); $j++) {
        $option = $data[$j];
        if (count($option) > 3)
            $label = $option[1] . ' - ' . $option[2] . ' - ' . $option[3];
        else if (count($option) > 2)
            $label = $option[1] . ' - ' . $option[2];
        else if (count($option) > 1)
            $label = $option[1];
        else
            $label = $option[0];
        echo "<option value='$option[0]' ";
        if ($option[0] == $selectedValue)
            echo "selected";
        echo ">$label</option>";
    }
    echo "</select>";
}

function comboChange($name, $data, $selectedValue, $allowNull, $class = null, $onChange = null) {
    $onChange = $onChange == '' ? '' : $onChange;
    ?>
            <select name='<?php echo $name; ?>' id='<?php echo $name; ?>ID' class='<?php echo $class; ?>' onChange= "ComboChange($(this), '<?php echo $onChange; ?>');"

    <?php
    if (array_key_exists('readonly', $_REQUEST))
        echo "disabled=true ";
    echo ">\n";
    if ($allowNull)
        echo "<option></option>";
    for ($j = 0; $j < count($data); $j++) {
        $option = $data[$j];
        if (count($option) > 3)
            $label = $option[1] . ' - ' . $option[2] . ' - ' . $option[3];
        else if (count($option) > 2)
            $label = $option[1] . ' - ' . $option[2];
        else if (count($option) > 1)
            $label = $option[1];
        else
            $label = $option[0];
        echo "<option value='$option[0]' ";
        if ($option[0] == $selectedValue)
            echo "selected";
        echo ">$label</option>";
    }
    echo "</select>";
}
?>
