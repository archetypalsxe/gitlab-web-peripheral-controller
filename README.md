# Web Peripheral Controller

Primary focus is to make a web interface for sharing the functionality of a scanner that is attached to the server through a web interface

## Requirements

### Scanning
* `scanimage`
* `tiff2pdf`
* The user the web server runs on will have to be in the `scanner` user group
  * Was the user www-data for me, running Apache
  * `sudo usermod -a -G scanner www-data`
* File `bash/scanAndConvert.sh` has to be executable
  * `chmod +x bash/scanAndConvert.sh`
  * Either add the bash to your PATH, or move it into a path
    * `sudo cp bash/scanAndConvert.sh /usr/bin/`

### Web Interface
* PHP
* Apache/web server
