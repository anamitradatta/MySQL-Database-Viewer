#!/bin/bash

gcc post_mysql_tables_htmle.c -o post_mysql_tables_htmle.cgi $(mysql_config --cflags) $(mysql_config --libs) -lmysqlclient
