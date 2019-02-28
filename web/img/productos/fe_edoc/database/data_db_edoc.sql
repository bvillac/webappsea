CREATE DATABASE  IF NOT EXISTS `db_edoc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_edoc`;

--
-- Dumping data for table `empresa`
-- PRUEBAS ambiente 1 tipoemison 1
-- PRODUCCION ambiente 2 tipoemision 1
--
INSERT INTO `empresa` (`emp_ruc`, `emp_razonsocial`, `emp_nom_comercial`, `emp_ambiente`, `emp_tipo_emision`, `emp_direccion_matriz`, `emp_obliga_contabilidad`, `emp_contri_especial`, `emp_telefono`, `emp_fax`, `emp_email`, `emp_email_digital`, `emp_email_conta`, `emp_moneda`, `emp_website`, `emp_logo`, `emp_est_log`) VALUES 
('0992164913001', 'UNIVERSIDAD TECNOLÓGICA EMPRESARIAL DE GUAYAQUIL - UTEG', 'UNIVERSIDAD TECNOLÓGICA EMPRESARIAL DE GUAYAQUIL - UTEG', '1', '1', 'GUAYACANES 520 Y LA 5TA. - URDESA CENTRAL', 'SI', '', '46052450', '46052450', 'info@uteg.edu.ec', 'digital@uteg.edu.ec', 'contador@uteg.edu.ec', 'DOLAR', 'www.uteg.edu.ec', '/ruta/', '1');

--
-- Dumping data for table `VSFirmaDigital`
--
INSERT INTO `VSFirmaDigital` (`Id`, `emp_id`, `Clave`, `RutaFile`, `RutaFileCrt`, `FechaCaducidad`, `EmpresaCertificadora`, `SeaDocXml`, `Wdsl_local`, `Estado`, `UsuarioCreacion`) VALUES 
('1', '1', 'R2FsbzM0NTQxMQ==', 'Y2FybG9zX2VucmlxdWVfY2FzdHJvX2VzcGFuYS5wMTI=', '', '2019-01-27', 'BCE', '/opt/SEADOC/GENERADO/', 'http://127.0.0.1:8080/FIRMARSRI/FirmaElectronicaSRI?wsdl', '1', '1');

--
-- Dumping data for table `establecimiento`
--
INSERT INTO `db_edoc`.`establecimiento` (`est_id`, `emp_id`, `est_numero`, `est_nombre`, `est_direccion`, `est_telefono`, `est_log`) VALUES 
('1', '1', '001', 'UTEG', 'DIR UTEG', '99999', '1');

--
-- Dumping data for table `punto_emision`
--
INSERT INTO `db_edoc`.`punto_emision` (`pemi_id`, `est_id`, `pemi_numero`, `pemi_nombre`, `est_log`) VALUES 
('1', '1', '001', 'MATRIZ 01', '1');

--
-- Dumping data for table `VSFormaPago`
--

INSERT INTO `VSFormaPago` VALUES (1,'SIN UTILIZACION DEL SISTEMA FINANCIERO','1','1',NULL,NULL),(2,'CHEQUE PROPIO','2','1',NULL,NULL),(3,'CHEQUE CERTIFICADO','3','1',NULL,NULL),(4,'CHEQUE DE GERENCIA','4','1',NULL,NULL),(5,'CHEQUE DEL EXTERIOR','5','1',NULL,NULL),(6,'DÉBITO DE CUENTA','6','1',NULL,NULL),(7,'TRANSFERENCIA PROPIO BANCO','7','1',NULL,NULL),(8,'TRANSFERENCIA OTRO BANCO NACIONAL','8','1',NULL,NULL),(9,'TRANSFERENCIA BANCO EXTERIOR','9','1',NULL,NULL),(10,'TARJETA DE CRÉDITO NACIONAL','10','1',NULL,NULL),(11,'TARJETA DE CRÉDITO INTERNACIONAL','11','1',NULL,NULL),(12,'GIRO','12','1',NULL,NULL),(13,'DEPOSITO EN CUENTA (CORRIENTE/AHORROS)','13','1',NULL,NULL),(14,'ENDOSO DE INVERSIÒN','14','1',NULL,NULL),(15,'COMPENSACIÓN DE DEUDAS','15','1',NULL,NULL),(16,'TARJETA DE DÉBITO','16','1',NULL,NULL),(17,'DINERO ELECTRÓNICO','17','1',NULL,NULL),(18,'TARJETA PREPAGO','18','1',NULL,NULL),(19,'TARJETA DE CRÉDITO','19','1',NULL,NULL),(20,'OTROS CON UTILIZACION DEL SISTEMA FINANCIERO','20','1',NULL,NULL),(21,'ENDOSO DE TÍTULOS','21','1',NULL,NULL);


--
-- Dumping data for table `VSImpuesto`
--

INSERT INTO `VSImpuesto` VALUES (1,'IVA','2','1'),(2,'ICE','3','1'),(3,'IRBPNR','5','1'),(4,'NINGUNO','0','1');


--
-- Dumping data for table `VSImpuestoRetencion`
--
INSERT INTO `VSImpuestoRetencion` VALUES (1,4,'RENTA','1','1'),(2,1,'IVA','2','1'),(3,4,'ISD','6','1');


--
-- Dumping data for table `VSRetencion`
--

INSERT INTO `VSRetencion` VALUES (1,2,'10%',10.00,'9','1'),(2,2,'20%',20.00,'10','1'),(3,2,'30%',30.00,'1','1'),(4,2,'50%',50.00,'11','1'),(5,2,'70%',70.00,'2','1'),(6,2,'100',100.00,'3','1'),(7,2,'0% Retencion 0',0.00,'7','1'),(8,2,'0% No Procede Retencion',0.00,'8','1'),(9,3,'5%',5.00,'45','1'),(10,1,'HONORARIOS PROFESIONALES',0.00,'30','1'),(11,1,'SERVICIOS PREDOMINA EL INTELECTO',0.00,'304','1'),(12,1,'SERVICIOS PREDOMINA LA MANO DE OBRA',0.00,'307','1'),(13,1,'SERVICIOS ENTRE SOCIEDADES',0.00,'308','1'),(14,1,'SERVICIOS PUBLICIDAD Y COMUNICACIÓN',0.00,'309','1'),(15,1,'SERVICIO TRANSPORTE PRIVADO DE PASAJEROS O SERVICIO PUBLICO O PRIVADO DE CARGA',0.00,'310','1'),(16,1,'TRANSFERENCIA DE BIENES MUEBLES DE NATURALEZA CORPORAL',0.00,'312','1'),(17,1,'POR ARRENDAMIENTO MERCANTIL',0.00,'319','1'),(18,1,'ARRENDAMIENTO BIENES INMUEBLES',0.00,'320','1'),(19,1,'PAGOS POR SEGUROS Y REASEGUROS(PRIMAS Y CESIONES)',0.00,'322','1'),(20,1,'PAGOS POR RENDIMIENTOS FINANCIEROS (NO APLICA PARA IFIs)',0.00,'323','1'),(21,1,'RF: DEPOSITOS CTA. CORRIENTE (SOLO APLICA PARA IFI S)',0.00,'323A','1'),(22,1,'RF: DEPOSITOS CTA. AHORROS SOCIEDADES (SOLO APLICA PARA IFI S)',0.00,'323B1','1'),(23,1,'RF: DEPOSITOS CTA. AHORROS PERSONAS NATURALES (SOLO APLICA PARA IFI S)',0.00,'323B2','1'),(24,1,'RF: DEPOSITOS CTAS. EXENTAS (SOLO APLICA PARA IFI S)',0.00,'323C','1'),(25,1,'RF: DEPOSITO A PLAZO (SOLO APLICA PARA IFI S)',0.00,'323E','1'),(26,1,'RF: OPERACIONES DE REPORTO – REPOS (SOLO APLICA PARA IFI S)',0.00,'323F','1'),(27,1,'RF: INVERSIONES (CAPTACIONES) (SOLO APLICA PARA IFI S)',0.00,'323G','1'),(28,1,'RF: OBLIGACIONES (SOLO APLICA PARA IFI S)',0.00,'323H','1'),(29,1,'RF: BONOS CONVERTIBLE EN ACCIONES (SOLO APLICA PARA IFI S)',0.00,'323I','1'),(30,1,'RF: BONOS DE ORGANISMOS Y GOBIERNOS EXTRANJEROS (SOLO APLICA PARA IFI S)',0.00,'323J','1'),(31,1,'RF: ENTRE IFIS (SOLO APLICA PARA IFI S)',0.00,'323K','1'),(32,1,'LOTERIAS, RIFAS, APUESTAS Y SIMILARES',0.00,'325','1'),(33,1,'VENTA DE COMBUSTIBLES A COMERCIALIZADORAS',0.00,'327','1'),(34,1,'VENTA DE COMBUSTIBLES A DISTRIBUIDORAS',0.00,'328','1'),(35,1,'OTRAS COMPRAS DE BIENES Y SERVICIOS NO SUJETAS A RETENCIÓN',0.00,'332','1'),(36,1,'CONVENIO DE DÉBITO O RECAUDACIÓN',0.00,'333','1'),(37,1,'PAGO CON TARJETA DE CRÉDITO',0.00,'334','1'),(38,1,'REEMBOLSO DE GASTO - COMPRA INTERMEDIARIO ',0.00,'336','1'),(39,1,'REEMBOLSO DE GASTO - COMPRA DE QUIEN ASUME EL GASTO ',0.00,'337','1'),(40,1,'OTRAS RETENCIONES APLICABLES 1% ',0.00,'340','1'),(41,1,'OTRAS RETENCIONES APLICABLES 2% ',0.00,'341','1'),(42,1,'OTRAS RETENCIONES APLICABLES 8% ',0.00,'342','1'),(43,1,'OTRAS RETENCIONES APLICABLES A LA TARIFA DE IMPUESTO A LA RENTA PREVISTA PARA SOCIEDADES',0.00,'343','1'),(44,1,'OTRAS RETENCIONES APLICABLES A OTROS PORCENTAJES',0.00,'344','1'),(45,1,'DIVIDENDOS PERSONAS NATURALES RESIDENTES',0.00,'345','1'),(46,1,'DIVIDENDOS SOCIEDADES EN PARAÍSOS FISCALES',0.00,'346','1'),(47,1,'DIVIDENDOS ANTICIPADOS',0.00,'347','1'),(48,1,'COMPRA LOCAL DE BANANO A PRODUCTOR',0.00,'348','1'),(49,1,'IMPUESTO A LA ACTIVIDAD BANANERA PRODUCTOR - EXPORTADOR',0.00,'349','1'),(50,1,'PAGO AL EXTERIOR - RENTAS INMOBILIARIAS',0.00,'500','1'),(51,1,'PAGO AL EXTERIOR - BENEFICIOS EMPRESARIALES',0.00,'501','1'),(52,1,'PAGO AL EXTERIOR - SERVICIOS EMPRESARIALES',0.00,'502','1'),(53,1,'PAGO AL EXTERIOR - NAVEGACIÓN MARÍTIMA Y/O AÉREA',0.00,'503','1'),(54,1,'PAGO AL EXTERIOR - DIVIDENDOS',0.00,'504','1'),(55,1,'PAGO AL EXTERIOR - INTERESES',0.00,'505','1'),(56,1,'PAGO AL EXTERIOR - INTERESES POR FINACIAMIENTO DE PROVEEDORES EXTERNOS',0.00,'506','1'),(57,1,'PAGO AL EXTERIOR - INTERESES DE CRÉDITOS EXTERNOS',0.00,'507','1'),(58,1,'PAGO AL EXTERIOR - CRÉDITOS DE IFIs ORGANISMOS Y GOBIERNO A GOBIERNO',0.00,'508','1'),(59,1,'PAGO AL EXTERIOR - CÁNONES O REGALÍAS',0.00,'509','1'),(60,1,'PAGO AL EXTERIOR - GANANCIAS DE CAPITAL',0.00,'510','1'),(61,1,'PAGO AL EXTERIOR - SERVICIOS PROFESIONALES INDEPENDIENTES',0.00,'511','1'),(62,1,'PAGO AL EXTERIOR - SERVICIOS PROFESIONALES DEPENDIENTES',0.00,'512','1'),(63,1,'PAGO AL EXTERIOR - ARTISTAS Y DEPORTISTAS',0.00,'513','1'),(64,1,'PAGO AL EXTERIOR - PARTICIPACIÓN DE CONSEJEROS',0.00,'514','1'),(65,1,'PAGO AL EXTERIOR - ENTRETENIMIENTO PÚBLICO',0.00,'515','1'),(66,1,'PAGO AL EXTERIOR - PENSIONES',0.00,'516','1'),(67,1,'PAGO AL EXTERIOR - REEMBOLSO DE GASTOS',0.00,'517','1'),(68,1,'PAGO AL EXTERIOR - FUNCIONES PÚBLICAS',0.00,'518','1'),(69,1,'PAGO AL EXTERIOR - ESTUDIANTES',0.00,'519','1'),(70,1,'PAGO AL EXTERIOR - OTROS CONCEPTOS',0.00,'520','1');


--
-- Dumping data for table `VSTarifa`
--

INSERT INTO `VSTarifa` VALUES (1,1,'0','0%',0.00,'0','1'),(2,1,'2','12%',12.00,'0','1'),(3,1,'3','14%',14.00,'0','1'),(4,1,'6','No Objeto de Impuesto',0.00,'0','1'),(5,1,'7','Exento de IVA',0.00,'0','1'),(6,2,'3023','Productos del tabaco y sucedáneos del tabaco (abarcan los \n productos preparados totalmente o en parte utilizando como \n materia prima hojas de tabaco y destinados a ser fumados, \n chupados, inhalados, mascados o utilizados como rapé). ',150.00,'1','1'),(7,2,'3610','Perfumes y aguas de tocador ',20.00,'1','1'),(8,2,'3620','Videojuegos',35.00,'1','1');

--
-- Dumping data for table `VSValidacion`
--

INSERT INTO `VSValidacion` VALUES (1,'ERROR',NULL,'1'),(2,'ADVERTENCIA',NULL,'1');

--
-- Dumping data for table `VSValidacion_Mensajes`
--

INSERT INTO `VSValidacion_Mensajes` VALUES (1,1,2,'RUC del emisor se encuentra NO ACTIVO.','Verificar que el número de RUC se encuentre en estado ACTIVO.','1'),(2,1,10,'Establecimiento del emisor se encuentra Clausurado.','No se autorizará comprobantes si el establecimiento emisor ha sido clausurado, automáticamente se habilitará el servicio una vez concluida la clausura.','1'),(3,1,26,'Tamaño máximo superado','Tamaño del archivo supera lo establecido','1'),(4,1,27,'Clase no permitido','La clase del contribuyente no puede emitir comprobantes electrónicos.','1'),(5,1,28,'Acuerdo de medios electronicos no aceptado','Siempre el contribuyente debe haber aceptado el Acuerdo de medio electrónicos en el cual se establece que se acepta que lleguen las notificaciones al buzón del contribuyente.','1'),(6,1,33,'Dirección Ip sancionada','Cuando la dirección desde la cual está llamando muchas veces al servicio en un tiempo determinado','1'),(7,1,34,'Comprobante no autorizado','Cuando el comprobante no ha sido autorizado como parte de la solicitud de emisión del contribuyente. ','1'),(8,1,35,'Documento Inválido','Cuando el xml no pasa validación de esquema','1'),(9,1,36,'Versión esquema descontinuada','Cuando la versión del esquema no es la correcta.','1'),(10,1,37,'RUC sin autorización de emisión','Cuando el RUC del emisor no cuenta con una solicitud de emisión de comprobantes electrónicos.','1'),(11,1,39,'Firma inválida','Firma electrónica del emisor no es válida','1'),(12,1,40,'Error en el certificado','No se encontró el certificado o no se puede convertir en certificad X509.','1'),(13,1,42,'Certificado revocado','Certificado que ha superado su fecha de caducidad, y no ha sido renovado.','1'),(14,1,43,'Clave acceso registrada','Cuando la clave de acceso ya se encuentra registrada en la base de datos.','1'),(15,1,45,'Secuencial registrado','Secuencial del comprobante ya se encuentra registrado en la base de datos','1'),(16,1,46,'RUC no existe','Cuando el ruc emisor no existe en el Registro Único de Contribuyentes.','1'),(17,1,47,'Tipo de comprobante no existe','Cuando envían en el tipo de comprobante uno que no exista en el catálogo de nuestros tipos de comprobantes.','1'),(18,1,48,'Esquema XSD no existe','Cuando el esquema para el tipo de comprobante enviado no existe.','1'),(19,1,49,'Argumentos que envían al WS nulos','Cuando se consume el WS con argumentos nulos.','1'),(20,1,50,'Error interno general','Cuando ocurre un error inesperado en el servidor.','1'),(21,1,52,'Error en diferencias','Cuando existe error en los cálculos del comprobante.','1'),(22,1,53,'Claves no registradas','Cuando envían comprobantes electrónicos que hayan sido generados en contingencia y las claves de acceso no son las que entregó la Administración Tributaria al contribuyente emisor.','1'),(23,1,56,'Establecimiento Cerrado','Cuando el establecimiento desde el cual se genera el comprobante se encuentra cerrado.','1'),(24,1,57,'Autorización suspendida','Cuando la autorización para emisión de comprobantes electrónicos para el emisor se encuentra suspendida por procesos de control de la Administración Tributaria.','1'),(25,1,58,'Error en la estructura de clave acceso','Cuando la clave de acceso tiene componentes diferentes a los del comprobante.','1'),(26,1,63,'RUC clausurado','Cuando el RUC del emisor se encuentra clausurado por procesos de control de la Administración Tributaria. ','1'),(27,1,64,'Código documento sustento','Cuando el código del documento sustento no existe en el catálogo de documentos que se tiene en la Administración.','1'),(28,1,65,'Fecha de emisión extemporánea','Cuando el comprobante emitido no fue enviado de acuerdo al tiempo del tipo de emisión en el cual fue realizado.','1'),(29,1,66,'Clave reportada','Cuando el comprobante es emitido en tipo de emisión contingente y utilizan una clave que ya fue registrada para otros comprobante en el mismo tipo de emisión.','1'),(30,1,67,'Fecha inválida','Cuando existe errores en el formato de la fecha.','1'),(31,1,69,'Identificación del receptor','Cuando la identificación asociada al adquirente no existe. En general cuando el RUC del adquirente no existe en el Registro Único de Contribuyentes.','1'),(32,1,70,'Clave de acceso en procesamiento','Cuando se desea enviar un comprobante que ha sido enviado anteriormente y el mismo no ha terminado su procesamiento.','1'),(33,1,71,'El ruc de la cabecera del lote es diferente al ruc del comprobante recibido','Cuando el ruc del emisor de la cabecera del comprobante que forma un lote es diferente al ruc del emisor de la cabecera del lote masivo.','1'),(34,1,72,'Error al procesar el xml del comprobante recibido al obtener el ruc del archivo xml.','Cuando el ruc del emisior de cada comprobante que pertenece al lote masivo se encuentra mal formado en su estructura.','1'),(35,1,74,'El código de documento de la cabecera del lote es diferente al código del documento del comprobante recibido','Cuando el codDoc de la cabecera del lote masivo es diferente al codDoc de la cabecera del comprobante recibido que forma parte del lote masivo.','1'),(36,1,75,'Error en el código del documento del lote','Cuando el codDoc del documento del lote masivo es diferente a los códigos de documentos de los comprobantes que son admitidos(Facturas, Notas de Crédito, Notas de Débito, Guías de Remisión, Comprobantes de Retención).','1'),(37,1,77,'Error de conversión en la estructura del archivo xml del comprobante del lote','Cuando el CodDoc de la cabecera del comprobante que pertenece a un lote masivo está formado por letras, está vacío, o no tiene el tag. Cuando en la cabecera del comprobante que pertenece a un lote masivo, en el Ruc del Emisor se envía un número de Ruc que no se encuentra en las bases del SRI.','1'),(38,2,59,'Identificación no existe','Cuando el número de la identificación del adquirente no existe.','1'),(39,2,60,'Ambiente ejecución.','Siempre que el comprobante sea emitido en ambiente de certificación o pruebas se enviará como parte de la autorización esta advertencia.','1'),(40,2,62,'Identificación Incorrecta','Cuando el número de la identificación del adquirente del comprobante está incorrecta. Por ejemplo cédulas no pasan el dígito verificador.','1'),(41,2,68,'Documento Sustento','Cuando el comprobante relacionado no existe como electrónico.','1');

--
-- Dumping data for table `VSDirectorio`
--

INSERT INTO `VSDirectorio` VALUES (1,1,'01','FACTURA','/opt/SEADOC/AUTORIZADO/FACTURAS/',NULL,'2016-08-25 21:51:00','1'),(2,1,'04','NOTA_DE_CREDITO','/opt/SEADOC/AUTORIZADO/NC/',NULL,'2016-08-25 21:51:00','1'),(3,1,'05','NOTA_DE_DEBITO','/opt/SEADOC/AUTORIZADO/ND/',NULL,'2016-08-25 21:51:00','1'),(4,1,'06','GUÍA_DE_REMISION','/opt/SEADOC/AUTORIZADO/GUIAS/',NULL,'2016-08-25 21:51:00','1'),(5,1,'07','COMPROBANTE_DE_RETENCION','/opt/SEADOC/AUTORIZADO/RETENCIONES/',NULL,'2016-08-25 21:51:00','1'),(6,1,'02','NOTA DE VENTA',NULL,NULL,'2017-01-27 16:18:40','0'),(7,1,'03','LIQUIDACION DE COMPRA',NULL,NULL,'2017-01-27 16:18:40','0'),(8,1,'08','ENTRADA A ESPECTACULOS PUBLICOS',NULL,NULL,'2017-01-27 16:18:40','0');

--
-- Dumping data for table `VSServiciosSRI`
--

INSERT INTO `VSServiciosSRI` VALUES (1,1,'1','https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl','https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl','https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionLoteMasivo?wsdl',5,10,'bvillacreses','2016-08-29 21:20:19',NULL,'1'),(2,1,'2','https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl','https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl','https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl',5,10,'bvillacreses','2016-08-29 21:20:19',NULL,'1');
