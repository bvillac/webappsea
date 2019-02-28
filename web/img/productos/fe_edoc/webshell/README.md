INSTALACION DE PHP WINDOWS 10
============================

PREPARANDO EL SERVIDOR CENTOS 7

1.- DESCARGAR EN Ruta Raiz:/webshell de CENTOS 7 
2.- INSTALAR EL JAVA Y APACHE TOMCAT 7 o Superior
    - Instalar JAVA o actualizar
        yum install java
        yum update java
    -   a.- Descargar Tomcat7
        b.- Descomprimirlo en la ruta
            #/var/local
            tar -xzf apache-tomcat-7.0.57.tar.gz
        c.- Se deber haber creado un directorio apache tomcat 7
        d.- Apache Tomcat se puede iniciar y detener la secuencia de comandos que viene con el paquete, iniciar el Apache Tomcat.
            /var/local/apache-tomcat-7.0.57/bin/
            ./startup.sh
            Hay que correr el siguiente script
            [root@vs bin]# ./startup.sh
            Using CATALINA_BASE:   /var/local/apache-tomcat-7.0.57
            Using CATALINA_HOME:   /var/local/apache-tomcat-7.0.57
            Using CATALINA_TMPDIR: /var/local/apache-tomcat-7.0.57/temp
            Using JRE_HOME:        /usr
            Using CLASSPATH:       /var/local/apache-tomcat-7.0.57/bin/bootstrap.jar:/var/local/apache-tomcat-7.0.57/bin/tomcat-juli.jar
            Tomcat started.
        e.- El apache tomcat esta iniciado; Usted puede verificar el servicio en ejecución, por tomcat defecto ejecuta en el puerto 8080
            [root@vs bin]# netstat -antup | grep 8080
            tcp        0      0 :::8080                     :::*                        LISTEN      2820/java  
        f.- Hacemos un Text de Verificacion puerto por medio de un navegador
            http://127.0.0.1:8080/
        g.- Para parar el servicio en la misma ruta
            /var/local/apache-tomcat-7.0.26/bin/shutdown.sh

        h.- Dentro de la Carpeta del apache tomcat7 hay que instalar el .WAR
            /var/local/apache-tomcat-7.0.57/webapps
             O
            /var/local/tomcat7/webapps
        i.- Hay que reiniciar el servicio del tomcat

        NOTA: No olvidar abrir los puertos en el firewall 8080.


3.- DESCARGAR EL FIRMADO DE JAVA.war QUE ESTA EN WEBSHELL /firmadorToncat/FIRMARSRI.war
4.- DESCARGAR LOS ARCHIVOS cron.sh DE fileCromtab Y GUARDARLOS EN LA RUTA DE  /home/
    - SeaFacturacionAut.cron.sh
    - SeaFacturacionRec.cron.sh
5.- CREAR UNA TAREA CON /crontab -e Y AGREGAR LO SIGUIENTE
    - (Cada 2 minutos de 8am a 7pm los dias Lun,Mar,Mie,Jue,Vir)
        */2 8-19 * * 1,2,3,4,5 /home/SeaFacturacionRec.cron.sh
        */3 8-19 * * 1,2,3,4,5 /home/SeaFacturacionAut.cron.sh

6.- ESTADO DE ENVIO DE DOCUMENTOS
    0 = NO ENVIADO
    1 = ENVIADO BASE INTERMEDIA
    2 = RECIBIDO SRI 
    3 = AUTORIZADO SRI 
    4 = EN PROCESO (CLAVE DE ACCESO) Recibir
    5 = ELIMINADO DEL SISTEMA
    6 = RECHAZADO (NO AUTORIZADOS, NEGADO o DEVUELTAS) =>SOLUC VOLVER ENVIAR CON ESTADO 1
    8 = DOCUMENTO ANULADO
    9 = EN PROCESO (AUTORIZACION) DOCUMENTO

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0. o Superior

~~~

INSTALLATION
------------

### Install 