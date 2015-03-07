Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu-12.04"
  config.vm.provision :shell, path: "sh/bootstrap2.sh"
  config.vm.network :forwarded_port, host: 4567, guest: 80
end