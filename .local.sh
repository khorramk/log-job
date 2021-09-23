echo "Welcome to Log job"
echo "-------------------"
echo "first we will run composer install. make sure it is installed."

composer install

echo "we will copy .env file from example"

cp .env.example .env

echo "make sure you edit your .env file with DB credentials"

