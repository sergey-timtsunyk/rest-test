Cron command
========================

Need add to crontab a follow line:

`47 23 */2 * * {path_interpolator}/php {path_project}/payment/app/console pay:count-sum-transaction-day`

path_interpolator - path to php interpolator
path_project - path to the directory where this project is located