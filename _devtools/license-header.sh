#!/bin/bash
# Dieses Skript fügt automatisch GPLv3-Lizenzheader zu allen Quelldateien
# im Verzeichnis app/ hinzu.
# Benötigt: gem install copyright-header

copyright-header -a app \
    --license GPL3 \
    --copyright-holder 'Eric Haberstroh <eric@erixpage.de>' \
    --copyright-software 'Korona' \
    --copyright-software-description "A free community management system for German-language fraternities" \
    --copyright-year 2016 \
    --output-dir /tmp

find /tmp/app -type f -name '*.php' -print0 |xargs -0 sed -i '20s/.*/ \*\//'
find /tmp/app -type f -name '*.php' -print0 |xargs -0 sed -i '21s/.*//'
cp -r /tmp/app .

