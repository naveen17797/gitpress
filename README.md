# Gitpress
Run wordpress directly on github pages

## Gitpress won the innovation award for may 2021
Read more about this [https://naveen17797.github.io/gitpress-won-the-php-innovation-award/](here)

## Want to see live demo ? 
Go to my github pages site at [https://naveen17797.github.io/](https://naveen17797.github.io/)

## What does this repo do ?
This helps to host your wordpress site in github pages

## How does it do it ?
1. It runs wordpress on your local docker container
2. It generates static files with the help of the plugin [simply static](https://github.com/patrickposner/simply-static) written by [Patrick Posner](https://patrickposner.dev/)
3. It pushes all the static files to your github pages

## How can i install ?
1. Clone the repo.
2. Run `docker-compose up` 
3. Open http://localhost, set up your wordpress site
4. Add your github username and password ( or token )
5. Click on sync site on the top admin bar, thats it.
![2021-05-24_05-58](https://user-images.githubusercontent.com/18109258/119281888-1a096f00-bc55-11eb-9ea8-495ee09682e7.png)
6. Now do that every time when you want to sync your local site to github pages.

## Can i use it in my production environment ?
No
