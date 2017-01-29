# Web Peripheral Controller

Primary focus is to make a web interface for sharing the functionality of a scanner that is attached to the server through a web interface

## Requirements

### Installed Packages
* PHP
* Apache/web server
* `sqlite3`
* `php5-sqlite`
  * Some method of being able to connect to a SQLite database from within PHP
* `scanimage`
* `tiff2pdf`

### Setup
* The user the web server runs on will have to be in the `scanner` user group
  * Was the user www-data for me, running Apache
  * `sudo usermod -a -G scanner www-data`
* File `bash/scanAndConvert.sh` has to be executable
  * `chmod +x bash/scanAndConvert.sh`
  * Either add the bash to your PATH, or move it into a path
    * `sudo cp bash/scanAndConvert.sh /usr/bin/`
* File `sql/initialize.sh` needs to be executable as well
  * `chmod +x sql/initialize.sh`
* Logged in as root, or a user with appropriate permissions to create files inside of the sql directory....
  * Run `./initialize.sh` to get the database setup
