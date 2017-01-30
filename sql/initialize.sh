#!/bin/bash

LOCATION="default.db"

while getopts l: optName
    do
        case "$optName" in
            "l")
                LOCATION=$OPTARG
                ;;
            "?")
                exit 1
                ;;
        esac
    done

sqlite3 $LOCATION < users.sql
