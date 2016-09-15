start cmd.exe /k "php artisan serve"
start chrome.exe http://localhost:8000
set root=c:\xampp\
%root%mysql\bin\mysqld.exe --defaults-file=%root%mysql\bin\my.ini --standalone --console &
