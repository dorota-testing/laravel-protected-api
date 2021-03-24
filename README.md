## Installation
You need composer installed for this, and php either globally on your system or on local server such as xampp. Clone or download this repo on your machine (in place where php runs). In terminal navigate to project folder and run:
```
  composer install
```
Then, change name of file .env.example to .env. Open .env file and change

  DB_CONNECTION=mysql  
  DB_HOST=127.0.0.1  
  DB_PORT=3306  
  DB_DATABASE=laravel  
  DB_USERNAME=root  
  DB_PASSWORD=  

to

  DB_CONNECTION=mysql

Then close the file and run:
```
  php artisan key:generate
  php artisan jwt:secret
```
Then create file database.sqlite in database folder and run:
```
  php artisan migrate
```
If you don't have local server running, in terminal enter:
```
  php artisan serve  
```
## API

All bodies of requests must be in json. Make sure the headers have content-type set to application/json.  
NOTE: the access token can be placed in body, as authorization header (type: bearer token) or as url parameter. Example of body:
  
{  
  "token":"yourTokenGoesHere"  
}  


Replace url/project-name/ with your set up.

### Register user

url/project-name/api/auth/register

This is a post call, requires a body with name, email and password. Returns either validator errors or confirmation of creating a user.

### Login

url/project-name/api/auth/login

This is a post call, requires a body with email and password. Returns either validator errors or access token. This token is to be used in all following calls.

### Logout

url/project-name/api/auth/logout

This is a post call, requires the token. Returns mesage about successful logout.

### Profile

url/project-name/api/auth/profile

This is a GET call, requires the token. Returns mesage about successful logout.

### Weather

url/project-name/api/auth/weather

This is a POST call, requires the token and body with param location. Returns mesage about not having a key, because all weather apis are closed and require a key to access them. To see a record returned from open api of google books use:
  
{  
  "location":"googlebooks"  
}  
