# CI-AdminLTE-HMVC
CodeIgniter dengan template AdminLTE dengan tambahan HMVC (**_Hierarchical model–view–controller_**).

Perhatikan konfigurasi dibawah, setelah di konfigurasi aplikasi dapat di akses di :
```
http://localhost/test/codeigniter/
```
atau
```
http://localhost/test/codeigniter/index.php/dashboard/
```

## Configuration :
buka file *config.php* yang ada di *application/config/*, lalu masukkan URL nya sesuai dengan lokasi folder codeigniternya di bagian *$config['base_url']*.

## Contoh :
### Windows
misalkan aplikasi diletakkan di folder **_D:/xampp/htdocs/test/codeigniter/_**
maka isinya  :
```
$config['base_url'] = http://localhost/test/codeigniter/
```
### Linux
misalkan aplikasi berada di direktori **_/var/www/html/dev/codeigniter/_**
maka URL nya :
```
$config['base_url'] = http://localhost/dev/codeigniter/
```

## Dependencies
| NAME | VERSION | WEBSITE | REPOSITORY |
| :--- | :---: | :---: | :---: |
| CodeIgniter | 3.1.2 | [Website](http://codeigniter.com) | [Github](https://github.com/bcit-ci/CodeIgniter/)
| AdminLTE | 2.3.7 | [Website](https://almsaeedstudio.com) | [Github](https://github.com/almasaeed2010/AdminLTE/)
| Bootstrap | 3.3.6 | [Website](http://getbootstrap.com) | [Github](https://github.com/twbs/bootstrap)
| jQuery | 2.2.3 | [Website](http://jquery.com) | [Github](https://github.com/jquery/jquery)
| Font Awesome | 4.7.0 | [Website](http://fortawesome.github.io/Font-Awesome/) | [Github](https://github.com/FortAwesome/Font-Awesome)
| Modular Extensions | 5.5 | [Website] (http://wiredesignz.co.nz/) | [Bitbucket] (https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc)
| Breadcrumbs | 1.0 | - | [Github] (https://github.com/nobuti/Codeigniter-breadcrumbs)
