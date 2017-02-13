# KlipBoard Lateness/Earliness Calculator from csv upload


## Solution
The solution works by querying attendance data imported from a csv file.

This is not the best approach to the problem. A better approach will be to make provision for public holidays, weekends/weekday ,mid-term breaks and number of days a staff is surpose to be available in a month as this parameters will take care of every possiblities that might arise.


## Methods
1. saveAttandance // saves the csv file in a database table
2. check_dulplicate($staff,$date) // Prevents dupliate entry for a staff for a particular day.
3. overViewAllStaffYearMonth($year, $staff) // this method performs the actual computation it uses helper methods           getLateness($data),getEarliness($data), getStaffnames($staffid)


## Installlation
1. cd to app dir run composer update
2. edit the .env file to suit your environment .ie your database connection srting
3. php artisan config:cache (optional)
4. run migration  
5. You are up


If you discover a security vulnerability within Laravel, please send an e-mail to Daniel Uche at dank.uche@yahoo.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
