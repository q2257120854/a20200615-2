#!/bin/sh

logfile=/usr/share/nginx/html/feichangpeizi/data/jobs.log

ls_date=`date +%H:%M:%S`

ls_data="$ls_date"

echo $ls_date >> $logfile
echo "\n www.dsqqapp.com/admin.php/admin/jobs/delayDays \n" >> $logfile
curl  www.dsqqapp.com/admin.php/admin/jobs/delayDays
echo "jisuan le yici diyan \n" >> $logfile







