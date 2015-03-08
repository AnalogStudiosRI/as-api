Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/trusty64"

  config.vm.provision :shell, path: "sh/vagrant.sh"

  config.vm.network :forwarded_port, host: 4567, guest: 80
  
end