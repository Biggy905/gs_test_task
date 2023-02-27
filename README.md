# GS Test Task

## Instruction:
Requirement by installation:
1. OS X, any distr Linux, Windows with WSL
2. Docker
3. Make

### Docker
Create network:
~~~
make init
~~~

Launch project:
~~~
make up
~~~

Install dependincies:
~~~
make composer-install
~~~
Migrate to db:
~~~
make migrate
~~~

Load fixture to db:
~~~
make fixtures
~~~

Run websocket <br/>
Step 1:
~~~
docker exec -it gs_php_fpm sh
~~~
Step 2:
~~~
php yii websocket/run
~~~


Web-service available by:
~~~
http://localhost:3200
~~~

Stop project:
~~~
make down
~~~

### Directory Structure

-------------------

      assets/             contains assets definition
      auction/            contains application configurations
      auction.ru/         contains the entry script and Web resources
      console/            contains console commands (controllers)
      common/             contains common classes
      mail/               contains view files for e-mails
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages

### REQUIREMENTS

------------

The minimum requirement by this project template that your Web server supports PHP 8.1
