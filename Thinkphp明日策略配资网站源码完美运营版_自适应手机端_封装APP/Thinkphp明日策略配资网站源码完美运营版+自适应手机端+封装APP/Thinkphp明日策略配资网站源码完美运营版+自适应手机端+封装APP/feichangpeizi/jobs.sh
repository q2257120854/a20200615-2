#!/bin/sh

while true
do
logfile=/www/wwwroot/feichangpeizi/data/jobs.log

ls_date=`date +%H:%M:%S`

ls_data="$ls_date"

#echo $ls_date
#echo $ls_date >> $logfile

#每天结束交易时 判断判断亏损额是否大于递延条件  接口：noDelay
if [ $ls_data \> "15:01:00" ] && [ $ls_data \< "15:01:05" ] ; then  
echo $ls_date >> $logfile
echo "www.dsqqapp.com/admin.php/admin/jobs/noDelay   " >> $logfile
curl  www.dsqqapp.com/admin.php/admin/jobs/noDelay
sleep 3;
fi

#每天凌晨扣除递延费 接口：delayDays
if [ $ls_data \> "00:30:00" ] && [ $ls_data \< "00:30:05" ] ; then
echo $ls_date >> $logfile
echo "www.dsqqapp.com/admin.php/admin/jobs/delayDays  " >> $logfile
curl  www.dsqqapp.com/admin.php/admin/jobs/delayDays
sleep 3;
fi

#每天交易时间比较止损线、止盈线 自动平仓 接口：pingCang
#if [ $ls_data \> "09:30:00" ] && [ $ls_data \< "11:30:00" ] || [ $ls_data \> "13:00:00" ] && [ $ls_data \< "15:00:00" ] ; then  
#echo "www.dsqqapp.com/admin.php/admin/jobs/pingCang   " >> $logfile
#curl  www.dsqqapp.com/admin.php/admin/jobs/pingCang

#fi

#echo "www.dsqqapp.com/admin.php/admin/jobs/getStockDataToDb   " >> $logfile
#curl  www.dsqqapp.com/admin.php/admin/jobs/getStockDataToDb

sleep 1

done





