#!/bin/bash

bash -c '/var/www/html/serve.sh ; redis-server  ; tail -f /dev/null'
