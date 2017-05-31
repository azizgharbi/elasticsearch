# -*- mode: ruby -*-
# vi: set ft=ruby :
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "forwarded_port", guest: 80, host: 80, host_ip: "127.0.0.1"
  config.vm.synced_folder "./project", "/var/www/html", id:"bad", owner: "root", group: "root",  mount_options: ["dmode=777,fmode=777"]
  config.vm.provision :shell, path: "bootstrap.sh"
end
