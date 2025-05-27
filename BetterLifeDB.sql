create table Profesionales(
id_Profesional serial primary key,
nombre varchar(50) not null,
apellidos varchar(50) not null,
email varchar(100) not null,
contrasenia bytea not null,
especialidad varchar(30) not null,
enfoque varchar(600)not null,
eslogan varchar(150),
tipoUsuario char(11) not null
);

create table Clientes(
id_cliente serial primary key,
nombre varchar(50) not null,
apellidos varchar(50) not null,
email varchar(100) not null,
contrasenia bytea not null,
edad int not null,
peso char(5) not null,
estatura char(5) not null,
brazoR char(4) not null,
brazoC char(4) not null,
cintura char(5) not null,
pierna char(4) not null,
intereses varchar(10) not null,
genero varchar(10) not null,
tipoUsuario char(7) not null
);

create table Rutinas(
id_Rutina serial primary key,
id_Cliente int,
id_Profesional int,
descripciónRutina varchar(800),
tipoRutina varchar(15), 
lunes varchar(200) not null,
martes varchar(200) not null,
miercoles varchar(200) not null,
jueves varchar(200) not null,
viernes varchar(200) not null,
sabado varchar(200) not null,
domingo varchar(200) not null,
foreign key (id_Cliente) references Clientes(id_Cliente)
);

CREATE TABLE solicitudes (
    id_Solicitud SERIAL PRIMARY KEY,
    id_Cliente INT NOT NULL,
	id_Profesional int not null,
    TipoRutina VARCHAR(15) not null,
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_Cliente) REFERENCES Clientes(id_Cliente),
	FOREIGN KEY (id_Profesional) REFERENCES Profesionales(id_Profesional)
);

insert into Profesionales values(default, 'Luis Manuel', 'Cardenas Ibarra', 'lcardenas@gmail.com', 
sha224('1234'),'Nutriologo', 'Control de peso y habitos saludables
Asesoria para enfermedades metabólicas',
null, 'profesional');

insert into Profesionales values(default, 'Alejandro', 'Lezama Torres', 'alezama@gmail.com', 
sha224('5678'),'Entrenador', 'Entrenamiento personalizado según objetivos (pérdida de peso, ganancia muscular, tonificación)
Rutinas especializadas para principiantes y avanzados
Preparación para competencias fitness y culturismo
Corrección de técnica y prevención de lesiones
Motivación y hábitos saludables para un cambio duradero',
null, 'profesional');

insert into Clientes values(default, 'Jovanny', 'Lobato Garcia', 'jlobato@gmail.com', sha224('4321'), 21,
'74kg', '174cm', '32cm','35cm','67cm','45cm','dieta','masculino','cliente');

id_Profesional serial primary key,
nombre varchar(50) not null,
apellidos varchar(50) not null,
email varchar(100) not null,
contrasenia bytea not null,
especialidad varchar(30) not null,
enfoque varchar(600)not null,
eslogan varchar(150),
tipoUsuario char(11) not null

insert into Profesionales values (default, 'Manuel', 'Cano Zavala', 'mcano@gmail.com',sha224('8765'),'','',null,'admin');

INSERT INTO rutinas (
    id_cliente,
    id_profesional,
    descripciónrutina,
    tiporutina,
    lunes,
    martes,
    miercoles,
    jueves,
    viernes,
    sabado,
    domingo
) VALUES (
    1,                      -- id_cliente 
    1,                      -- id_profesional 
    'Rutina para pérdida de peso',  -- descripcion
    'dieta',                -- tiporutina
    'avena',      -- lunes
    'huevos',     -- martes
    'yogur',      -- miercoles
    'fruta',      -- jueves
    'cereal',     -- viernes
    'jugo natural', -- sabado
    'pan integral'  -- domingo
);

INSERT INTO rutinas (
    id_cliente,
    id_profesional,
    descripciónrutina,
    tiporutina,
    lunes,
    martes,
    miercoles,
    jueves,
    viernes,
    sabado,
    domingo
) VALUES (
    1,                      -- id_cliente
    1,                      -- id_profesional 
    'Rutina para tonificación muscular', 
    'ejercicio',            -- tiporutina
    'Pecho y tríceps',      -- lunes
    'Espalda y bíceps',     -- martes
    'Cardio',               -- miercoles
    'Piernas',              -- jueves
    'Hombros y abdominales',-- viernes
    'Descanso activo',      -- sabado
    'Descanso'              -- domingo
);

SELECT c.id_cliente, p.id_profesional,
            COALESCE(c.nombre, p.nombre) AS nombre, COALESCE(c.apellidos, p.apellidos) AS apellidos,
            COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario FROM Clientes c
            FULL OUTER JOIN Profesionales p ON 1=0 WHERE (c.email='mcano@gmail.com' AND c.contrasenia=sha224('8765'))
            or (p.email='mcano@gmail.com' AND p.contrasenia=sha224('8765'));
