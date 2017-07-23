Payment system
========================
**System include the following components:**

  * REST API;

  * GUI;

  * Crton command;

use PHP7.1, Mysql5.7.19, Symfony2.8

Installation and configuration
--------------

 1 Install required libraries

    composer install

 2 Create parameters. Need copy app/parameters.yml.dist to app/parameters.yml and add params for BD.

 3 Run migration for BD
 
    php app/console  doctrine:migrations:migrate
 
 4 Initialize GUI
 
    bower install ./vendor/sonata-project/admin-bundle/bower.json
    php app/console cache:clear
    php app/console assets:install
    
 5 For REST API need use headers
 
      Accept: application/json
      Content-Type: application/json   
 

Create user and authentication
--------------
 
 1 Create user for UI then start server and check login
 
    php app/console fos:user:create --super-admin
 
    Please choose a username:admin
    Please choose an email:admin@example.com
    Please choose a password:admin
 
 
 2 For REST API to see the documentation on the following link `{base_url}/rest/doc`

 3 Create user for authentication by API 
 
    php app/console fos:user:create
 
    Please choose a username:client
    Please choose an email:client@example.com
    Please choose a password:client_pass
 
 4 Create client ID and secret for authentication by API
 
    php app/console auth:generate:client
 
    client_id: [client_id_value]
    client_secret: [client_secret_value]

 5  For create token, need send request to ` {base_url}/oauth/v2/token`

    {
        "grant_type": "password",
        "client_id": "client_id_value",
        "client_secret": "client_secret_value",
        "username": "client",
        "password": "client_pass"
    }

 Response has access token for REST API

    {
      "access_token": "access_token_value",
      "expires_in": 3600,
      "token_type": "bearer",
      "scope": null,
      "refresh_token": "refresh_token_value"
    }

 6 If need refresh token, use same url `{base_url}/oauth/v2/token`
    
    {
        "grant_type": "refresh_token",
        "client_id": "client_id_value",
        "client_secret": "client_secret_value",
        "refresh_token": "refresh_token_value"
    }


 7 REST API is available by url `{base_url}/api` But for authentication, you need to include a header in the request

     Authorization: Bearer access_token_value
 
Command
--------------
 1 The command makes the counting of amount in transactions and stores it in the database. The counting is make for the current day or for a given day in the parameters
    
    php app/console pay:count-sum-transaction-day --day=d.m.Y
