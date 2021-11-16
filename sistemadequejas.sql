    --Borra la base de datos
drop database sistemadequejas;
--Crea la base de datos
create database sistemadequejas;
--Usar la base de datos
use sistemadequejas;

--Crea la tabla tipos_suarios
create table tipos_usuario(
    tipo_usuario_id int not null auto_increment primary key,
    tipo_usuario varchar(64) not null
);

--Crea la tabla estados
create table estados(
    estado_id int not null auto_increment primary key,
    estado varchar(64) not null
);

--Crea la tabla filtros
create table filtros(
    filtro_id int not null auto_increment primary key,
    filtro varchar(40) not null
);

--Crea la tabla imagenes
create table imagenes(
    imagen_id int not null auto_increment primary key,
    imagen1 varchar(64) null,
    imagen2 varchar(64) null,
    imagen3 varchar(64) null,
    imagen4 varchar(64) null,
    imagen5 varchar(64) null,
    eliminado int null
);


--Crea la tabla usuario
create table usuarios(
    usuario_id int not null auto_increment primary key,
    usuario varchar(64) not null,
    nombre varchar(64) not null,
    paterno varchar(64) not null,
    materno varchar(64) not null,
    email varchar(64) not null,
    telefono varchar(10) not null,
    contraseña varchar(64) not null,
    tipo_usuario_id int not null,
    eliminado int null,
    FOREIGN KEY (tipo_usuario_id) REFERENCES tipos_usuario(tipo_usuario_id) ON DELETE CASCADE ON UPDATE CASCADE
);

--Crea la tabla quejas
create table quejas(
    queja_id int not null auto_increment primary key,
    asunto varchar(64) null,
    queja varchar(512) null,
    respuesta varchar(255) null,
    filtro_id int not null,
    imagen_id int null,
    estado_id int not null,
    usuario_id int not null,
    tipo_usuario_id int not null,
    eliminado int null,
    fecha timestamp,
    FOREIGN KEY (imagen_id) REFERENCES imagenes(imagen_id) ON DELETE CASCADE ON UPDATE CASCADE, 
    FOREIGN KEY (estado_id) REFERENCES estados(estado_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (filtro_id) REFERENCES filtros(filtro_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (tipo_usuario_id) REFERENCES tipos_usuario(tipo_usuario_id) ON DELETE CASCADE ON UPDATE CASCADE
);

--Inserta datos en la tabla tipos usuario
insert into tipos_usuario (tipo_usuario) VALUES ('Anonimo');
insert into tipos_usuario (tipo_usuario) VALUES ('Usuario');
insert into tipos_usuario (tipo_usuario) VALUES ('Administrador');

--Inserta datos en la tabla estados
insert into estados (estado) VALUES ('En Revision');
insert into estados (estado) VALUES ('Descartada');
insert into estados (estado) VALUES ('Respondida');

--Inserta datos en la tabla filtros
insert into filtros (filtro) VALUES ('Sin Groserias');
insert into filtros (filtro) VALUES ('Con Groserias');

--Inserta datos en la tabla usuarios
insert into usuarios ( usuario, nombre, paterno, materno, email, telefono, contraseña, tipo_usuario_id, eliminado) VALUES ('administrador','Jael Orlando','Osorio','Pérez','jael256or@gmail.com','1234567890','f62d58c40d7280925378f970abed682d', 3, 0);

insert into usuarios ( nombre, usuario, paterno, materno, email, telefono, contraseña, tipo_usuario_id ) VALUES ( 'Anonimo', 'Anonimo', '', '', '', '', '', 1);

delimiter //
create procedure agregarUsuario(in usuario varchar(64), in nombre varchar(64), in paterno varchar(64), in materno varchar(64), in email varchar(64), in telefono varchar(10), in contraseña varchar(64), in tipo_usuario_id int)
begin
insert into usuarios (usuario, nombre, paterno, materno, email, telefono, contraseña, tipo_usuario_id) values (usuario, nombre, paterno, materno, email, telefono, contraseña, tipo_usuario_id);
end;
//

create procedure agregarQueja(in asunto varchar(64), in queja varchar(512), in filtro_id int, in imagen_id int, in estado_id int, in usuario_id int, in tipo_usuario_id int)
begin
insert into quejas (asunto, queja, filtro_id, imagen_id, estado_id, usuario_id, tipo_usuario_id) values (asunto, queja, filtro_id, imagen_id, estado_id, usuario_id, tipo_usuario_id);
end;
//

create trigger insertarUsuario
before insert on usuarios
for each row
begin
set NEW.tipo_usuario_id = 2;
set NEW.eliminado = 0;
end;
//


create trigger insertaQueja
before insert on quejas
for each row
begin
set NEW.eliminado = 0;
end;
//

create trigger actualizaQueja
before update on quejas
for each row
begin
set NEW.fecha = now();
end;
//

create trigger insertaImagen
before insert on imagenes
for each row
begin
set NEW.eliminado = 0;
end;
//

delimiter ;