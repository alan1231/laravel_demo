#!/bin/bash

# 端口號
PORT=8000

# 查找佔用端口的進程
PID=$(lsof -t -i :$PORT)

# 終止佔用端口的進程
if [ -n "$PID" ]; then
    kill -9 $PID
    echo "Terminated process $PID on port $PORT"
else
    echo "No process found on port $PORT"
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan cache:clear
lsof -i -P -n | grep LISTEN | awk '{print $2}' | xargs kill -9
php artisan serve