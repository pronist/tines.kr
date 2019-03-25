# Before run this script

### Step 1. Get sudo permission

```bash
sudo -s
```

### Step 2. Add User and group

```bash
adduser <user>
usermod -G www-data <user>
id <user>
groups www-data
```

# How to run

### provision.sh

```bash
bash provision.sh <user> <mysql_password> | tee log.txt
```

```bash
nginx -v
mysql --version
php --version
composer --version
```

### serve.sh

```bash
bash serve.sh <domain> <document_root>
```

# Reference

<https://github.com/appkr/l5code/tree/master/provision-scripts>