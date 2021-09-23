echo "in here we will do some setup"
echo "first we will generate application key"

php artisan key:generate

echo "We think you have edited the .env correctly"
echo "Now we will run migration for db structure"

php artisan migrate

echo "Now we will seed data in db for testing purposes"

php artisan db:seed

echo "seeding successfull"

echo "Now will run asset setup"

echo "running npm install"

npm install

echo "now compilling assets"

npm run dev

echo "successfull compiled assets"
