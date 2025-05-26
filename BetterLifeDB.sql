create DATABASE BetterLife;

create table usuarios(
id_usuario serial primary key,
nombre varchar(50) not null,
apellidos varchar(50) not null,
edad int not null,
correoE varchar(100) not null,
sexo char(10) not null,
fechaNac date not null,
intereses char(8),
contrasenia bytea not null,
tipoUsuario char(11) not null
);

CREATE TABLE solicitudes (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER NOT NULL,
    objetivo VARCHAR(255),
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);




insert into usuarios values(default, 'Luis Manuel', 'Cardenas Ibarra', 27, 'lcardenas@gmail.com',
'masculino','1998-11-04', null, sha224('1234'),'admin');

insert into usuarios values(default, 'Alejandro', 'Lezama Torres', 21, 'alezama@gmail.com',
'masculino','2004-06-15', null, sha224('5678'),'profesional');

insert into usuarios values(default, 'Jovanny', 'Lobato Garcia', 21, 'jlobato@gmail.com',
'masculino','2004-05-26', 'dieta', sha224('4321'),'usuario');

select * from usuarios order by id_usuario asc;


SELECT id_usuario,nombre,apellidos,tipousuario
            FROM usuarios WHERE correoE='alezama@gmail.com' AND 
            contrasenia=sha224('5678');

