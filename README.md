# StorexWeb Backend Test

This website made for multiple bloggers, it is built with PHP Laravel, and VueJs (SPA web application)

# How to install

first git clone of the repo then intiate a database (MySql preferred) and give your DB a name and associate it then run the following commands, BTW make sure your using PHP V7.3 || v8.0

```
composer install
```

```
cat .env.example > .env
```

```
php artisan key:generate
```

don't forget to set the database on your machine and customize its vars in the .env file

```
php artisan migrate --seed
```

```
npm install && npm run dev
```

```
php artisan serve
```

and open this url on your browser `127.0.0.1:8000`

#USAGE
you can start with 
``
Email: super_admin@app.com   && Pass: 12345678
``
