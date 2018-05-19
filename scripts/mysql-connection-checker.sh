#!/bin/bash
dbuser="root"
dbpass="root"
dbhost="db"
dbaccess="denied"
echo "Waiting for MySQL Connection..."
until [[ $dbaccess = "success" ]]; do
  mysql --user="${dbuser}" --password="${dbpass}" --host="${dbhost}" -e exit 2>/dev/null
  dbstatus=`echo $?`
  if [ $dbstatus -ne 0 ]; then
    dbaccess="denied"
    sleep 1
  else
    dbaccess="success"
    echo "Success!"
    break
  fi
done
