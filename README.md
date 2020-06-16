# VeterinarianClinic

## **Requirments**

* You will need a valid PHP install (either PHP 5 or PHP 7).

* You will have to have Apache Server to host the application.

* You will have to use MySQL to host the database.

## **How To Run The Web App (Linux)**

* Install Apache (cross-platform)
  * *yum install httpd*

* Start Apache server
  * *service httpd start*

* Find document root
  * *etc /etc/httpd/conf/httpd.conf*
  * use emacs or text editor/viewer to look for DocumentRoot (usually looks like this *var/www/html*)*

* Put repository contents in this folder

* Install PHP
  * *yum install php*

* Install mariadb for database server
  * *yum -y install mariadb-server mariadb*

* Start database server
  * *service mariadb start*

* Start MySQL Query
  * *mysql*

* Paste database script contents

## **How To Run The Web App (Windows with XAMPP and HeidiSQL)** 

* First, navigate to *C:\xampp\htdocs\scripts* and dump the repository there.
  * If you're not using XAMPP to run your Apache Server, just make sure they're in the scripts folder of wherever your http://localhost/ accesses files.

* Now, start your Apache and MySQL server. Here's how to with XAMPP:

![Image of XAMPP](https://github.com/BrianASpencer/VeterinarianClinic/blob/master/Other/Image%20of%20XAMPP.png)

* Next, click start for the Apache and MySQL modules.

![Image of XAMPP Buttons](https://github.com/BrianASpencer/VeterinarianClinic/blob/master/Other/Image%20of%20XAMPP%20Buttons.png)

* Now, start HeidiSQL and use these values and click Open.

![Image of HeidiSQL](https://github.com/BrianASpencer/VeterinarianClinic/blob/master/Other/Image%20of%20HeidiSQL.png)

* Next, copy and paste the contents of the database script, found in the database script folder into the Query tab of HeidiSQL.

![Image of HeidiSQL w/Query](https://github.com/BrianASpencer/VeterinarianClinic/blob/master/Other/Image%20of%20HeidiSQL%20wQuery.png)

* Now, to execute the script, either hit the blue play arrow or select the whole script and right-click and hit run or run selection.

![Image of HeidiSQL w/Selection](https://github.com/BrianASpencer/VeterinarianClinic/blob/master/Other/Image%20of%20HeidiSQL%20wSelection.png)


## **How To Use the Program** 

* After navigating to the login page (*login.php*) on localhost, just create a new account and login. After that, all features of the application are available to use.
