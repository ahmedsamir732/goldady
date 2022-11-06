# Goldady Assesment.

#Install

clone the repo, then `cd goldady`, if you want to change docker environment including `mysql` user, check `.env` file in the main dir, then run
`cd code && cp .env.example .env`

then run:
`docker-compose up --build`

This should install the script environment for you, it might take a little bit for composer to finish installing dependencies, after the installation finished you will find nginx on port `8080`, and the phpmyadmin will run on port `8082`.

Now you should access php container with command `docker-compose exec php bash`, after that you should run `php artisan migrate` to public DB migration, or you can take the DB file attached and open phpmyadmin on `http://127.0.0.1:8082` and import the db on in it, the default DB name is `goldady` if you want yo change it you have to change it also on `./code/src/config/DB.php` file.

Now your environment is ready, all you have to do now is open your `postman` and import the colllection attached in the repo and start. 
