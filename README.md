##Developers
Kyle Giard-Chase

##Date
April 26 2015



##Description
An app to manage and keep track of volunteers at a non-profit organization. Supervisors are able to create committees and events for volunteers to assign themselves to, track volunteers, and create accounts for other supervisors. In turn, volunteers are able to create accounts for themselves, add themselves to committees, and RSVP to help out at events.

##Technologies Used
PHP <br>
<a href='http://www.postgresql.org/'>PostgreSQL</a> <br>
<a href='https://developers.google.com/speed/libraries/'>jQuery</a> <br>
<a href='http://getbootstrap.com/'>Bootstrap </a>for styling <br>
It uses <a href='https://getcomposer.org/'>Composer</a> to install:
<li>
<a href='http://silex.sensiolabs.org/'>Silex</a>
</li>
<li><a href='http://twig.sensiolabs.org/'>Twig</a></li>
<li><a href='https://phpunit.de/'>PHPUnit</a></li>

##Use and Editing
To view the app,
1. Open your command shell, and clone the repository into your home folder using the command `git clone https://github.com/k-giardchase/volunteer_management.git`
2. Import the database into PostgreSQL.
    1. Create a new database `CREATE DATABASE volunteer_management;`
    2. Connect to the database `\c volunteer_management;`
    3. In your command shell, and in the top level of your home directory, import the database `\i volunteer_management.sql`
    4. If you would like to edit the app and make use of the test database, `CREATE DATABASE volunteer_management_test WITH TEMPLATE volunteer_management`
    4. NOTE: if the database fails to import, please see the following database section to manually create the database.
3. In the top level of the project folder, run `composer install`
4. Start a php server by changing directories into the web folder `cd volunteer_management/web`
and start your server `php -S localhost:8000`
5. Open your browser and navigate to your root path: `localhost:8000`


##DATABASE
If the database fails to import (see above), you may manually create it using the following commands:
```sql
CREATE DATABASE volunteer_management;
 \c volunteer_management
CREATE TABLE volunteers (id serial PRIMARY KEY, first_name varchar, last_name varchar, email varchar, phone varchar, username varchar, password varchar, admin_stat int);
CREATE TABLE supervisors (id serial PRIMARY KEY, first_name varchar, last_name varchar, position_title varchar, email varchar, username varchar, password varchar, phone varchar, admin_stat int);
CREATE TABLE committees (id serial PRIMARY KEY, committee_name varchar, department varchar, description varchar);
CREATE TABLE events (id serial PRIMARY KEY, event_name varchar, event_date timestamp, location varchar);
CREATE TABLE committees_events (id serial PRIMARY KEY, committee_id int, event_id int);
CREATE TABLE committees_supervisors (id serial PRIMARY KEY, committee_id int, supervisor_id int);
CREATE TABLE committees_volunteers (id serial PRIMARY KEY, committee_id int, volunteer_id int);
CREATE TABLE events_volunteers (id serial PRIMARY KEY, event_id int, volunteer_id int);
CREATE DATABASE volunteer_management_test WITH TEMPLATE volunteer_management;
```

##Known bugs
This app is currently a work in progress. To date, the following need to be updated:
1. Views to create, delete, and update a supervisor.
2. The ability to update the committees an event is associated with.
3. The ability to add a supervisor to a committee.
4. The date must be entered in a way that affects user experience, e.g. 2014-09-01 12:00:00.
5. Though supervisors and volunteers have an admin_stat property, the app does not make use of it as of yet.
6. Styling/CSS.


##Copyright (c) 2015 Kyle Giard-Chase
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
