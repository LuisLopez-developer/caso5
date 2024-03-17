# pasos para leventar el proyecto en un servidor

## Actualizar la terminal

```bash
sudo apt update
sudo apt upgrade
```

## instalar apache2

```bash
sudo apt install apache2
```

## instalar PHP

```bash
sudo apt install php
```

### instalar libapache2-mod-php 
Para que el servidor apache sea capaz de de ejecutar script PHP.

```bash
sudo apt install libapache2-mod-php
```

## Clonar repositorio de GitHub

> [!IMPORTANT]
> 
> Para agilizar, clonar el repositorio en la ruta: /var/www/html/

**caso contrario.**

1. instalar en la ruta que elijas:

```bash
git clone git@github.com:usuario/nombre-repositorio.git
```

2. Copiar archivos del repositorio al servidor web:

```bash
cd ruta/a/tu/repositorio
sudo cp -r * /var/www/html/
```

3. Ajusta los permisos de los archivos 

```bash
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
```

4. Abre los puertos en el cortafuegos (firewall)

```bash
sudo ufw allow 80/tcp
```

5. reiniciar el servidor de apache

```bash
sudo systemctl restart apache2
```