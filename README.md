<p><h3 align="center">How to use this App.</h3></p>

- Clone the Repository.
~~~
git clone <repo_link>
~~~
- Move into project Directory

~~~
cd <project_dir>
~~~

- Config the Database file config/db.php


- Install Dependencies
~~~
composer install
~~~

- Run migrations 

~~~
//run migrations
php yii migrate

OR
 
./yii migrate
~~~

- Start the Server
~~~
//run server
php yii serve

OR

./yii serve
~~~
<p><h3>How Import, Search & Export works.</h3></p>
For login we have only two accounts Admin & Demo (default accounts). For importing the CSV files we can use only admin account, with demo account we have access only Practices list page.  
Click on login page in the navbar link & use admin account (Username => admin, Password => admin), for Demo account (Username => demo, Password => demo). After login user will be redirect to the Practices list page. If the practice page is empty it means we have no data in Database, for importing the Data in DB, click on the import link (this link is visible only if we will use admin account) in the navbar where user can select Type of file & can upload Provided CSV files from <b>FilesToTest directory in the Project.</b>
After importing the CSV file in DB user will be redirect to Practices list page & can see the results Table with all the Practces related clients, user can also use Pagination for going to the next page. In Practice list page user can search by practice_id OR by Codice Fiscale OR with both, & user can export displayed results Data or all the Data from the DB.  


