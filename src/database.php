<?php 

require "./config/config.php";
require "Medoo.php";

use Medoo\Medoo;

$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => $GLOBALS['mysqlName'],
	'server' => $GLOBALS['mysqlServer'],
	'username' => $GLOBALS['mysqlUser'],
	'password' => $GLOBALS['mysqlPass'],
	'charset' => 'utf8',
 
	// [optional]
	'port' => $GLOBALS['mysqlServerPort'],
 
	// [optional] Table prefix
	'prefix' => '',
]);
$GLOBALS['database'] = $database;

function logSession($user, $id, $ap){
    $database = $GLOBALS['database'];

    $database->insert("sessions", [
        "username"=>$user,
        "mac"=>$id,
        "ap"=>$ap,
        "timestamp"=>gmdate('Y-m-d H:i:s')
    ]);

}

/**
 * Fetches Sessions from DB
 * $limit: number of entries fetched
 * Returns an array containing the last $limit Sessions.
 */
function getXSessions($limit){
    $database = $GLOBALS['database'];

    $queryResult = $database->select(
        "sessions", 
        [
            "id",
            "username",
            "mac",
            "ap",
            "timestamp"
        ],
        [
            "ORDER" => ["timestamp" => "DESC"],
            "LIMIT" => $limit
        ]
    
    );

    return $queryResult;
}

/**
 * Searches for last mac user in sessions table
 * $mac the mac adress to match the sessions
 * Returns the user that used this mac last, or "" if no user was found
 */
function getLastMacUser($mac){
    $database = $GLOBALS['database'];

    $queryResult = $database->select(
        "sessions",
        "username",
        [
            "mac" => $mac,
            "ORDER" => ["timestamp" => "DESC"],
            "LIMIT" => 1
        ]
    );

    if(empty($queryResult)){
        return "";
    }
    else{
        return $queryResult[0];
    }

}

function createUser($user, $password){
    
    $database = $GLOBALS['database'];

    $pwHash = password_hash($password, PASSWORD_DEFAULT);

    $database->insert("users", [
    	"username" => $user,
    	"hash" => $pwHash,
    ]);
    
}

function getUsers(){
    //$query = mysql_query("SELECT * FROM table");
    //$rows = array();

    $database = $GLOBALS['database'];

    $queryResult = $database->select("users", [
        "username",
        "hash",
        "sessions",
        "enabled"
    ]);

    return $queryResult;
}

function authorizeUser($user, $password){

    $database = $GLOBALS['database'];

    $queryResult = $database->select("users", [
        "username",
        "hash",
        "enabled"
    ], [
        "username" => $user
    ]);

    if(count($queryResult) === 1 && $queryResult[0]["enabled"] == 1){

        $pwHash = $queryResult[0]["hash"];

        if(password_verify($password, $pwHash)) {
            increaseSessionCounter($user);
            return true;
        }
        
    }
    else{
        return false;
    }

}

function deleteUser($user) {
    $database = $GLOBALS['database'];

    $queryResult = $database->delete("users", [
        "username" => [$user]
    ]);
}

function increaseSessionCounter($user){
    $database = $GLOBALS['database'];

    $queryResult = $database->select("users", [
        "sessions"
    ], [
        "username" => $user
    ]);

    $database->update("users", [ "sessions"=>$queryResult[0]["sessions"] + 1], ["username"=>$user] );
}

?>