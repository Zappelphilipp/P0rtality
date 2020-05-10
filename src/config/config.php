<?php 
/* --------------------- */
/* ==== CHANGE ME ! ==== */
/* --------------------- */

/* Management Administrator User */
$GLOBALS['adminUser']="admin2";  
$GLOBALS['adminPass']="admin2";  

/* Controller Server */
$GLOBALS['unifiServer']= "https://<IP of unifi controller>:8443";  

/* Controller admin user */
$GLOBALS['unifiUser']="username";

/* Controller admin pass */
$GLOBALS['unifiPass']="password";

/* Company Name */
$GLOBALS['companyName']="Company Name LTD";


/* ------------------------------------------------------------------------------------ */
/* Settings for manual installation (external mysql server, non-default site-name etc.) */
/* ------------------------------------------------------------------------------------ */

/*Display last X Sessions*/
$GLOBALS['displayXSessions'] = 10;

/* Controller version */
$GLOBALS['unifiVersion']="5.12.35";

/* Controller site */
$GLOBALS['unifiSite']="default";

/* Mysql Server */
$GLOBALS['mysqlServer']= "guest_portal_mysql";

/* Mysql User */
$GLOBALS['mysqlUser']="espresso";

/* Mysql Pass */
$GLOBALS['mysqlPass']="lattecaffee";


/* Mysql Database Name */
$GLOBALS['mysqlName']="portal";

/* Mysql Session Table Name */
$GLOBALS['mysqlSessionTable']="user";

/* Mysql Log Session Table Name */
$GLOBALS['LogSessionsTable']="access_logs";
        
/* Mysql port */
$GLOBALS['mysqlServerPort']=3306;

/* How long a session is authenticated in minutes */
$GLOBALS['authDuration']=120;
    
?>