#!/usr/bin/env bash

sudo apt-get update
sudo wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.0.0-alpha1.deb
sha1sum elasticsearch-6.0.0-alpha1.deb
sudo dpkg -i elasticsearch-6.0.0-alpha1.deb
ps -p 1
sudo update-rc.d elasticsearch defaults 95 10
sudo /bin/systemctl daemon-reload
sudo /bin/systemctl enable elasticsearch.service
sudo systemctl start elasticsearch.service
