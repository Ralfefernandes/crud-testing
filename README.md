# crud-testing
Assesment

## step 1 Composer install
You need to run ```
composer install ```
## step 2 Database Details
The database details can be found in the .env file. Make sure to set the following values accordingly:

## Step 3: Uploading CSV files

To upload new CSV files, you can use the following commands:
here are the details:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
## Email Details
```bash
MAIL_MAILER=smtp
MAIL_HOST=app.debugmail.io
MAIL_PORT=9025
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```
## Login on the https://app.debugmail.io/

To see the fake emails, you can login on this server:
- Server URL: https://app.debugmail.io/
- Username: Ralfefrns@hotmail.com
- Password: 

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

``` 
php artisan send:update-details-emails
```

The code for sending the update details emails can be found in the following files:

```
Console/Commands/SendUpdateDetailsEmails.php
Mail/UpdateDetailsEmail.php
```

## Step 5: Model and relationship logic
The Models directory contains the logic and relationships between the tables.

## Step 6: UpdateDetailsController
The main controller for this project is ``` UpdateDetailsController.php ```, located in the ``` Http/Controllers ``` directory. This controller contains the code for handling various actions and requests related to updating details.

## Step 7: ModelChangeObserver
To track model changes and save them to the log file, you can find the code in the following file:
- ``` app/Observers/ModelChangeObserver.php```
The ModelChangeObserver class contains the logic for logging model changes to the ``` model_changes.log``` file located in ``` storage/logs/model_changes.log```.
