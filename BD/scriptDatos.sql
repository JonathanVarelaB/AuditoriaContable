SET NAMES UTF8;
-- usuarios
insert into usuario values(null,'admin','Administrador1','admin@hotmail.com','123',1,1,1,1,1);
-- tipoActivo
insert into tipoActivo values(null,'Equipo de Computo',60);
insert into tipoActivo values(null,'Equipo de Oficina',120);
insert into tipoActivo values(null,'Software',36);
insert into tipoActivo values(null,'VehÃ­culo',120);
insert into tipoActivo values(null,'Edificio',600);
-- aspectoDeclaracion
insert into aspectodeclaracion values(20,'Efectivo, bancos, inversiones transitorias, documentos y cuentas por cobrar');
insert into aspectodeclaracion values(21,'Acciones y aportes en sociedades');
insert into aspectodeclaracion values(22,'Inventarios');
insert into aspectodeclaracion values(23,'Activos fijos');
insert into aspectodeclaracion values(24,'Total activo neto');
insert into aspectodeclaracion values(25,'Total pasivos');
insert into aspectodeclaracion values(26,'Capital neto');
insert into aspectodeclaracion values(27,'Ventas de bienes y servicios, excepto los servicios profesionales');
insert into aspectodeclaracion values(28,'Servicios profesionales y honorarios');
insert into aspectodeclaracion values(29,'Comisiones');
insert into aspectodeclaracion values(30,'Intereses y rendimientos financieros');
insert into aspectodeclaracion values(31,'Dividendos y participaciones');
insert into aspectodeclaracion values(32,'Alquileres');
insert into aspectodeclaracion values(33,'Otros ingresos diferentes a los anteriores');
insert into aspectodeclaracion values(34,'Ingresos no gravables');
insert into aspectodeclaracion values(35,'Total renta bruta');
insert into aspectodeclaracion values(36,'Inventario inicial');
insert into aspectodeclaracion values(37,'Compras');
insert into aspectodeclaracion values(38,'Inventario final');
insert into aspectodeclaracion values(39,'Costo de ventas');
insert into aspectodeclaracion values(40,'Intereses y gastos financieros');
insert into aspectodeclaracion values(41,'Gastos de venta y administrativos');
insert into aspectodeclaracion values(42,'Depreciaciones, amortizaciÃ³n y agotamiento');
insert into aspectodeclaracion values(43,'Aporte RegÃ­menes voluntarios de pensiones complementarias (mÃ¡x. 10% renta bruto)');
insert into aspectodeclaracion values(44,'Otros costos, gastos y deducciones permitidos por Ley');
insert into aspectodeclaracion values(45,'Total costos, gastos y deducciones permitidos por Ley');
insert into aspectodeclaracion values(46,'Renta Neta');
insert into aspectodeclaracion values(46.1,'Monto no sujeto aplicado al impuesto al salario (acumulado anual)');
insert into aspectodeclaracion values(47,'Impuesto sobre la Renta');
insert into aspectodeclaracion values(51,'ExoneraciÃ³n Zona Franca');
insert into aspectodeclaracion values(53,'ExoneraciÃ³n otros conceptos');
insert into aspectodeclaracion values(54,'Impuesto sobre la renta despuÃ©s de exoneraciones');
insert into aspectodeclaracion values(58,'CrÃ©ditos familiares (solo personas fÃ­sicas)');
insert into aspectodeclaracion values(59,'Otros crÃ©ditos');
insert into aspectodeclaracion values(60,'Impuesto del perÃ­odo');
insert into aspectodeclaracion values(61,'RetenciÃ³n 2%');
insert into aspectodeclaracion values(62,'Otras retenciones');
insert into aspectodeclaracion values(63,'Pagos parciales');
insert into aspectodeclaracion values(64,'Total impuesto neto');
insert into aspectodeclaracion values(84,'Solicito compensar con crÃ©ditos a mi favor por el monto de');
-- cuentas contables
-- ingresos
insert into cuentacontable values('4-01-01','Ventas',1);
insert into cuentacontable values('4-01-02','Servicios Profesionales',1);
insert into cuentacontable values('4-01-03','Alquileres',1);

insert into cuentacontable values('4-02-01','Intereses Financieros',1);

insert into cuentacontable values('4-03-01','Dividendos y Participaciones',1);
insert into cuentacontable values('4-03-02','Comisiones',1);
insert into cuentacontable values('4-03-03','Otros Ingresos',1);
-- gastos
insert into cuentacontable values('5-01-01','Sueldos y Salarios',1);
insert into cuentacontable values('5-01-02','Cargas Sociales',1);
insert into cuentacontable values('5-01-03','Prestaciones Legales',1);
insert into cuentacontable values('5-01-04','Aguinaldo',1);
insert into cuentacontable values('5-01-05','Capacitaciones',1);
insert into cuentacontable values('5-01-06','Honorarios Profesionales',1);
insert into cuentacontable values('5-01-07','Mantenimiento y ReparaciÃ³n',1);
insert into cuentacontable values('5-01-08','Suministros para Operar',1);
insert into cuentacontable values('5-01-09','Atenciones de Clientes',1);
insert into cuentacontable values('5-01-10','Alquiler de Oficinas',1);
insert into cuentacontable values('5-01-11','Alquiler de VehÃ­culos',1);
insert into cuentacontable values('5-01-12','Arrendamiento de Equipos',1);
insert into cuentacontable values('5-01-13','Servicios PÃºblicos (Internet, Telefono, Agua, Electricidad, Cable)',1);
insert into cuentacontable values('5-01-14','Gastos de Transporte',1);
insert into cuentacontable values('5-01-15','Combustible',1);
insert into cuentacontable values('5-01-16','Hospedaje',1);
insert into cuentacontable values('5-01-17','Otros Gastos de MovilizaciÃ³n(peajes,parqueos,etc.)',1);
insert into cuentacontable values('5-01-18','Seguros y PÃ³lizas',1);
insert into cuentacontable values('5-01-19','Suscripciones y MembresÃ­as',1);
insert into cuentacontable values('5-01-20','Impuestos y Tasas Deducibles',1);
insert into cuentacontable values('5-02-01','Publicidad',1);
insert into cuentacontable values('5-03-01','Intereses Financieros',1);
insert into cuentacontable values('5-03-02','Comisiones Bancarias',1);
insert into cuentacontable values('5-03-03','Diferencial Cambiario',1);

-- insert into cuentacontable values('5-04-01','Equipo de Computo',1);
-- insert into cuentacontable values('5-04-02','Equipo de Oficina',1);
-- insert into cuentacontable values('5-04-03','Software',1);
-- insert into cuentacontable values('5-04-04','VehÃ­culo',1);
-- insert into cuentacontable values('5-04-05','Edificio',1);

insert into cuentacontable values('5-05-01','Gastos Deducibles',1);
insert into cuentacontable values('6-01-01','Inventario Inicial',1);
insert into cuentacontable values('6-01-02','Compras',1);
insert into cuentacontable values('6-01-03','Inventario Final',1);
insert into cuentacontable values('7-01-01','Amortizaciones',1);
commit;
