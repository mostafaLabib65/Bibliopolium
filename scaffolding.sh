#!/usr/bin/env bash

composer install
php artisan key:generate

read -p "At this point ur database should be up to date" :tmp

php artisan infyom:scaffold ActiveCart --fromTable --tableName=active_carts
php artisan infyom:scaffold ActiveOrder --fromTable --tableName=active_orders
php artisan infyom:scaffold Author --fromTable --tableName=authors
php artisan infyom:scaffold BookEdition --fromTable --tableName=book_editions
php artisan infyom:scaffold BookIsbn --fromTable --tableName=book_isbns
php artisan infyom:scaffold Book --fromTable --tableName=books
php artisan infyom:scaffold HistoryOrder --fromTable --tableName=history_orders
php artisan infyom:scaffold Item --fromTable --tableName=items
php artisan infyom:scaffold Publisher --fromTable --tableName=publishers
php artisan infyom:scaffold PurchaseHistory --fromTable --tableName=purchase_histories
php artisan infyom:scaffold RoleCredential --fromTable --tableName=role_credentials
php artisan infyom:scaffold Statistic --fromTable --tableName=statistics
php artisan infyom:scaffold User --fromTable --tableName=users
php artisan infyom:scaffold AuthorBook --fromTable --tableName=authors_books