Projekat se pokreće na sledeći način:
Kopirati folder "ibis" u xampp/htdocs
Importati bazu
Podesiti aktivni folder:
Fajl xampp\apache\conf\httpd.conf
Izmijeniti sledeće:
DocumentRoot "C:/xampp/htdocs" =>  DocumentRoot "C:/xampp/htdocs/ibis/public_html"
<Directory "C:/xampp/htdocs">  => <Directory "C:/xampp/htdocs/ibis/public_html">
Pomoću browsera ući na localhost/

Kreirati nalog i logovati se
