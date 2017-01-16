#!/bin/bash

# Creating a unique ID in case this is ran twice in close proximity
date_id="$(date +%s)";
file_name="scannedImage-$date_id";
scanimage --format=tiff > /tmp/$file_name.tiff;
tiff2pdf -o /tmp/$file_name.pdf /tmp/$file_name.tiff;
rm /tmp/$file_name.tiff;
echo "/tmp/$file_name.pdf";
