### Sposób uruchomienia aplikacji

Aby uruchomić aplikację, postępuj zgodnie z poniższymi krokami:

1. **Pobierz repozytorium:**
   Skopiuj repozytorium aplikacji na swoją lokalną maszynę.
   ```sh
   git clone <URL_REPOZYTORIUM>
   cd <NAZWA_FOLDERU_PROJEKTU>
   
2. **Zainstaluj Docker:**
Upewnij się, że masz zainstalowany Docker na swoim komputerze. Instrukcje instalacji można znaleźć na oficjalnej stronie Dockera.

3. **Uruchom kontener Docker**:
W folderze, w którym znajduje się projekt, wykonaj poniższe polecenie, aby uruchomić kontener Docker i zainstalować wymagane zależności:

```sh
Copy code
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

4. **Skopiuj plik konfiguracyjny:**
Skopiuj plik `.env.example` jako `.env`:

```sh
Copy code
cp .env.example .env
```
5. **Uruchom Sail:**
Użyj Laravel Sail, aby uruchomić kontenery Docker:

```sh
Copy code
./vendor/bin/sail up
```
6. **Migracje bazy danych:**
Wejdź do kontenera laravel.test i uruchom migracje, aby utworzyć tabele w bazie danych:

```sh
Copy code
./vendor/bin/sail exec laravel.test bash
php artisan migrate
```
