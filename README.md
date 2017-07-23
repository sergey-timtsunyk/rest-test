Payment system
========================
**System include the following components:**

  * REST API;

  * GUI;

  * Crton command;


Installation and configuration
--------------

<code>
$ php app/console fos:user:create<br>
Please choose a username:admin<br>
Please choose an email:admin@example.com<br>
Please choose a password:admin<br>
Created user admin<br>
</code>


<code>
$ php app/console fos:user:create --super-admin<br>
Please choose a username:admin<br>
Please choose an email:admin@example.com<br>
Please choose a password:admin<br>
Created user admin<br>
</code>


{base_url}/rest/doc - Rest Api documentation

{base_url}/oauth/v2/token
{
    "grant_type": "password",
    "client_id": "1_3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4",
    "client_secret": "4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k",
    "username": "AdminPay",
    "password": "123"
}

{
  "access_token": "YTRjYmI4MjY3OTM5YjYyOWU4YjE4ZTY0N2I3MWRlZTRjMjc0NjIyYjhiMjllYTIwNzY1YjYyNWUzZjFmYjMyOA",
  "expires_in": 3600,
  "token_type": "bearer",
  "scope": null,
  "refresh_token": "OTMzNTk1NGNkMWI4Y2JhMjBiMzA1ZjljNTU0MzVmMTlmNWEwMTUyYTI5NDQyYjE3NmNjNzk5YzExNjVlZTg5Nw"
}

{base_url}/oauth/v2/token
{
    "grant_type": "refresh_token",
    "client_id": "1_3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4",
    "client_secret": "4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k",
    "refresh_token": "YTQ2ZTMzNWQzNTgzOTU0NGZkNjIxMDJjMGU1OWI5MDA0MTI5NTE0MmYxN2IwOTkzNDBmMzQ2MDE5YmFiNGYwNA"
}


{base_url}/api
 Authorization: Bearer MWNiNTViYTZjNDlkNTM3OWIwYzIwZjMyNmNhN…
 Content-Type: application/json
 
 
 bower install ./vendor/sonata-project/admin-bundle/bower.json
 $ php app/console cache:clear
$ php app/console assets:install