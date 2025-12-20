## MyFavGeo API

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Ambiente de desenvolvimento

### Backend only
Esta parte do projeto é uma API REST construída com Laravel.

### Subindo o servidor local
No Windows, o comando `php artisan serve` pode acabar falhando devido
a um problema de resolução de path no Laravel 12.

Então pode usar o servidor PHP nativo:

```bash
php -S 127.0.0.1:8000 -t public
```

## Banco de Dados:

- Banco: MySQL
- Migrations versionadas em `database/migrations`

