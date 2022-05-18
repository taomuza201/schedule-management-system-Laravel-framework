#  <center >Laravel framework</center >
#  schedule management system
  ระบบบริหารจัดการติดตามการทำงาน <br /> 
 =>login and register  <br />
 =>ระบบสมาชิก  <br />
 =>ระบบปฏิทิน   <br />
 =>ระบบหมอบหมายงาน <br />
 =>ระบบติดตามงาน <br />
 =>ระบบค้นหางานตามบุคล วันเดือนปี <br />


=> ฯลฯ  <br />
  

## get it up and running.

After you clone this project, do the following:

```bash
# go into the project
cd  root project
# create a .env file
cp .env.example .env
# install composer dependencies
composer update
# install npm dependencies
npm install
# generate a key for your application
php artisan key:generate

# add the database connection config to your .env file
DB_CONNECTION=mysql
DB_DATABASE=your database
DB_USERNAME=your table name
DB_PASSWORD=your password
# run the migration files to generate the schema
php artisan migrate


# run serve
php artisan serve

Good Luck :)
