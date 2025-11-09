#!/bin/bash
PHP_CLI_SERVER_WORKERS=${CLI_WORKERS:-10} php artisan serve --host=0.0.0.0 --port=${APP_LOCAL_PORT:-8888} &
/usr/bin/supervisord &
