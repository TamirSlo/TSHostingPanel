# TS Web Hosting Panel
This project is inspired by DirectAdmin and developed for machines which are not supported and to create an open source, free solution, for Website Hosting on most Linux machines.

## Planned Features:
Three access levels: Admin, Reseller and User.

A rough comparison of features between TS Hosting Panel and DirectAdmin:

| Permission Level | Feature | TS Panel | DirectAdmin |
| :--------------: | :-----: | :------: | :---------: |
|| **SERVER MANAGEMENT**
| Admin | Create Admin | :white_check_mark: | :white_check_mark: |
| Admin | List Admins | :white_check_mark: | :white_check_mark: |
| Admin | Change Passwords | :white_check_mark: | :white_check_mark: |
| Admin | Manage Tickets | :question: | :white_check_mark: |
| Admin | Create Reseller | :white_check_mark: | :white_check_mark: |
| Admin | List Reseller | :white_check_mark: | :white_check_mark: |
| Admin | Manage Reseller Packages | :white_check_mark: | :white_check_mark: |
| Admin | Show All Users | :white_check_mark: | :white_check_mark: |
|| **ADMIN TOOLS**
| Admin | IP Managemnet | :x: | :white_check_mark: |
| Admin | DNS Administration | :x: | :white_check_mark: |
| Admin | Admin Backup/Transfer | :white_check_mark: | :white_check_mark: |
| Admin | Multi Server Setup | :x: | :white_check_mark: |
| Admin | Mail Queue Administration | :x: | :white_check_mark: |
| Admin | Move Users Between Resellers | :white_check_mark: | :white_check_mark: |
| Admin | System Information | :question: | :white_check_mark: |
| Admin | Service Monitor | :x: | :white_check_mark: |
| Admin | System Backup | :white_check_mark: | :white_check_mark: |
| Admin | Log Viewer | :white_check_mark: | :white_check_mark: |
| Admin | File Editor | :question: | :white_check_mark: |
| Admin | Process Monitor | :question: | :white_check_mark: |
|| **EXTRA FEATURES**
| Admin | Complete Usage Stats. | :x: | :white_check_mark: |
| Admin | Custom HTTPD Config. | :x: | :white_check_mark: |
| Admin | PHP Config. | :white_check_mark: | :white_check_mark: |
| Admin | Brute Force Monitor | :x: | :white_check_mark: |
| Admin | Admin. Settings | :white_check_mark: | :white_check_mark: |
| Admin | Licensing\Updates | :x: \ :white_check_mark: | :white_check_mark: |
| Admin | Plugin Manager | :question: | :white_check_mark: |
| Admin | All User Cron Jobs | :white_check_mark: | :white_check_mark: |
|| **ACCOUNT MANAGEMENT**
| Reseller | Add User | :white_check_mark: | :white_check_mark: |
| Reseller | List Users | :white_check_mark: | :white_check_mark: |
| Reseller | Manage Tickets | :question: | :white_check_mark: |
| Reseller | Add Package | :question: | :white_check_mark: |
| Reseller | Manage User Packages | :white_check_mark: | :white_check_mark: |
| Reseller | Edit user Message | :white_check_mark: | :white_check_mark: |
|| **RESELLER TOOLS**
| Reseller | Change passwords | :white_check_mark: | :white_check_mark: |
| Reseller | Reseller Stats. | :question: | :white_check_mark: |
| Reseller | IP Management | :x: | :white_check_mark: |
| Reseller | Skin manager | :question: | :white_check_mark: |
| Reseller | Manage User Backups | :white_check_mark: | :white_check_mark: |
|| **EXTRA FEATURES**
| Reseller | System Info | :question: | :white_check_mark: |
| Reseller | Nameservers | :x: | :white_check_mark: |
| Reseller | Message All Users | :white_check_mark: | :white_check_mark: |
| Reseller | Contact Administrator | :white_check_mark: | :white_check_mark: |
|| **YOUR ACCOUNT**
| User | Domain Setup | :white_check_mark: | :white_check_mark: |
| User | Change Password | :white_check_mark: | :white_check_mark: |
| User | Login History | :question: | :white_check_mark: |
| User | DNS Management | :x: | :white_check_mark: |
| User | Support Center | :question: | :white_check_mark: |
| User | Installed Perl Modules | :question: | :white_check_mark: |
| User | Create\Restore Backups | :white_check_mark: | :white_check_mark: |
| User | Site Summary \ Stats. \ Logs | :question: | :white_check_mark: |
| User | FTP Management | :white_check_mark: | :white_check_mark: |
| User | Subdomain Management | :white_check_mark: | :white_check_mark: |
| User | MySQLManagement | :white_check_mark: | :white_check_mark: |
| User | Password Protected Directories | :question: | :white_check_mark: |
| User | File Manager | :question: | :white_check_mark: |
|| **E-MAIL MANAGEMENT**
| User | E-Mail Accounts | :x: | :white_check_mark: |
| User | Catch-All Email | :x: | :white_check_mark: |
| User | Forwarders | :x: | :white_check_mark: |
| User | Autoresponders | :x: | :white_check_mark: |
| User | Vacation Messages | :x: | :white_check_mark: |
| User | Spamassassin Setup | :x: | :white_check_mark: |
| User | Mailing Lists | :x: | :white_check_mark: |
| User | SPAM Filters | :x: | :white_check_mark: |
| User | Webmail: Sq. | :x: | :white_check_mark: |
| User | Webmail: RC | :x: | :white_check_mark: |
| User | MX Records | :x: | :white_check_mark: |
|| **ADVANCED FEATURES**
| User | Server Info. | :question: | :white_check_mark: |
| User | SSL Certs. | :white_check_mark: | :white_check_mark: |
| User | Cronjobs | :question: | :white_check_mark: |
| User | Mime Types | :x: | :white_check_mark: |
| User | Apache Handlers | :x: | :white_check_mark: |
| User | SSH Keys | :x: | :white_check_mark: |
| User | Custom Error Pages | :white_check_mark: | :white_check_mark: |
| User | phpMyAdmin | :white_check_mark: | :white_check_mark: |
| User | Site Redirection | :white_check_mark: | :white_check_mark: |
| User | Domain Pointers | :x: | :white_check_mark: |
| User | Login Keys | :question: | :white_check_mark: |


**_A Messaging / Tickets system will also be implemented at a later stage of the development. Email managemnet is not planned to be included within this Web Hosting Panel as no experience with such systems. A later assessment will be performed and it could be added at a later stage with no complications._**

###### This is an ongoing project that is actively being modified. This is developed privately, and not widely tested.

## Copyright
This project is licensed with the GNU General Public License. 
