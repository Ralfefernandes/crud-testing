# themindoffice
Assesment

## step 1 Run composer update
You need to run ```
composer update ```
## step 2 Database Details
The database details can be found in the .env file. Make sure to set the following values accordingly:

## Step 3: Uploading CSV files

To upload new CSV files, you can use the following commands:
here are the details:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=themindoffice
DB_USERNAME=themindoffice
DB_PASSWORD=Amaral_10
```
## Email Details
```bash
MAIL_MAILER=smtp
MAIL_HOST=app.debugmail.io
MAIL_PORT=9025
MAIL_USERNAME=4c73c0fd-c261-4c7b-8b75-78790ad6088e
MAIL_PASSWORD=c62be056-f303-4034-aae6-4597cc833b00
MAIL_ENCRYPTION=tls
```
## Login on the https://app.debugmail.io/

To see the fake emails, you can login on this server:
- Server URL: https://app.debugmail.io/
- Username: Ralfefernandes@hotmail.com
- Password: Amaral_10

```bash
php artisan import:bedrijven-csv-data
php artisan import:adressen-csv-data
php artisan import:contactpersonen-csv-data 
```

The imported CSV file should be located in ```bash storage/app/public/csv``` 

Make sure to place the respective CSV file in the correct location before running the command.

The code for importing CSV files can be found in the following files:

```bash 
Console/Commands/ImportAdressenCsvData.php
Console/Commands/ImportBedrijvenCsvData.php
Console/Commands/ImportContactpersonenCsvData.php
```

## Step 4: Sending update details emails

To send an email to everyone, you can use the following command:

```bash 
php artisan send:update-details-emails
```

The code for sending the update details emails can be found in the following files:

```bash
Console/Commands/SendUpdateDetailsEmails.php
Mail/UpdateDetailsEmail.php
```

## Step 5: Model and relationship logic
The Models directory contains the logic and relationships between the tables.

## Step 6: UpdateDetailsController
The main controller for this project is ```bash UpdateDetailsController.php ```, located in the ```bash Http/Controllers ``` directory. This controller contains the code for handling various actions and requests related to updating details.

## Step 7: ModelChangeObserver
To track model changes and save them to the log file, you can find the code in the following file:
- ```bash app/Observers/ModelChangeObserver.php```
The ModelChangeObserver class contains the logic for logging model changes to the ```bash model_changes.log``` file located in ```bash storage/logs/model_changes.log```.
