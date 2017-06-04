# -*- mode: ruby -*-
# vi: set ft=ruby :
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "centos/7"
  config.vm.network "private_network", ip: "192.168.33.10"
  #only for windows
  config.vm.synced_folder ".", "/vagrant", id: "good", type: "virtualbox"
  #sync folder
  config.vm.synced_folder "./project", "/var/www/html", id:"bad", owner: "root", group: "root"
  config.vm.synced_folder "./config", "/etc/elasticsearch", id:"good", owner: "root", group: "root"
  config.vm.provision :shell, path: "bootstrap.sh"
  config.vm.provider "virtualbox" do |v|
  v.memory = 4096
  end
end
