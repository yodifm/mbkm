
# SIP MBKM (Sistem Informasi Program Merdeka Belajar - Kampus Merdeka) Program Studi Manajemen Pendidikan FIP UNJ

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Tech Stack

**FullStack:** PHP, Laravel, Bootstrap

**Database:** Mysql

## Run Locally

Clone the project

```bash
  git clone https://github.com/yodifm/mbkm
```

Go to the project directory

```bash
  cd mbkm
```

Install dependencies

```bash
  composer install

  npm install
```

Environment

```bash
  cp .env.example .env 

  Search & Replace db name in .env file
  DB_DATABASE=mbkm
```

Database & App setup

```bash
  php artisan migrate
  or with seeder
  php artisan migrate:fresh --seed

  php artisan key:generate
```

Start the server

```bash
  php artisan serve

  open another terminal and run:
  npm run dev
```

## Authors

- [@yodifm](https://www.github.com/yodifm/)
- [@syrsdev](https://www.github.com/syrsdev)
