 docker run -p 3001:80 -v C:/home/HannilSolutions/slim-3-jwt:/var/www/html -v C:/home/Dockerlog/log_slim-3-jwt:/var/log/apache2 --name slim-jwt -d php:7.4-apache