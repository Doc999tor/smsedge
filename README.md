# SMSEDGE task
Simple client gets logs lists from MySQL db

## How to run it
1. Clone the repo
2. Run the `/api/smsedge.sql` script
3. Open localhost:9000 server in /api dir
4. `npm install && npm start` will open a browser at localhost:3000
5. Enjoy browsing

## SMS moving
At the bottom of the `/api/smsedge.sql` you can find a SP called `sp_move_bunch_logs`, it accepts a `Y-m-d` date and moves safely bunch of rows to a new `send_log_aggregated` table with aggregated `log_created_aggregated` column

## Requirements:
* PHP 7.1
* MySQL 5.7
* Node.js 6+ (tested on 10)

## Live version you can see [here](https://smsedge.bewebmaster.co.il)