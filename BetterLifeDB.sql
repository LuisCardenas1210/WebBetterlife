create table Profesionales(
id_Profesional serial primary key,
nombre varchar(50) not null,
apellidos varchar(50) not null,
email varchar(100) not null,
contrasenia bytea not null,
especialidad varchar(30) not null,
enfoque varchar(600)not null,
eslogan varchar(150),
tipoUsuario char(11) not null,
status BOOLEAN DEFAULT TRUE
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
brazoR varchar(5) not null,
brazoC varchar(5) not null,
cintura char(5) not null,
pierna varchar(5) not null,
intereses varchar(10) not null,
genero varchar(10) not null,
tipoUsuario char(7) not null,
status BOOLEAN DEFAULT TRUE
);

create table Rutinas(
id_Rutina serial primary key,
id_Cliente int,
id_Profesional int,
descripciónRutina varchar(800),
tipoRutina varchar(15), 
lunes varchar(100) not null,
detallesL varchar(200) not null,
martes varchar(100) not null,
detallesM varchar(200) not null,
miercoles varchar(100) not null,
detallesW varchar(200) not null,
jueves varchar(100) not null,
detallesJ varchar(200) not null,
viernes varchar(100) not null,
detallesV varchar(200) not null,
sabado varchar(100) not null,
detallesS varchar(200) not null,
domingo varchar(100) not null,
detallesD varchar(200) not null,
foreign key (id_Cliente) references Clientes(id_Cliente)
on delete cascade,
foreign key (id_Profesional) references Profesionales(id_Profesional)
on delete cascade
);

CREATE TABLE solicitudes (
    id_Solicitud SERIAL PRIMARY KEY,
    id_Cliente INT NOT NULL,
	id_Profesional int not null,
    TipoRutina VARCHAR(15) not null,
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_Cliente) REFERENCES Clientes(id_Cliente)
	on delete cascade,
	FOREIGN KEY (id_Profesional) REFERENCES Profesionales(id_Profesional)
	on delete cascade
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

insert into Profesionales values (default, 'Manuel', 'Cano Zavala', 'mcano@gmail.com',sha224('8765'),'','',null,'admin');

INSERT INTO rutinas VALUES (
	default, 				-- id_Rutina
    1,                      -- id_cliente 
    1,                      -- id_profesional 
    'Rutina para pérdida de peso',  -- descripcion
    'dieta',                -- tiporutina
    'Sanwitch',	  -- lunes
	'Pan integra, jamon, crema, lechuga, jitomate, cebolla',
    'Ensalada',     -- martes
	'Lechuga, aguacate, cebolla morada, jitomate',
    'yogur con fruta',      -- miercoles
	'yogur natural, manzana picada, pera picada, fresa picada, avena',
    'pechuga rellena',      -- jueves
	'pechuga de pollo, espinaca, queso, apio',
    'cereal',     -- viernes
	'cereal integral, leche light',
    'Licuado de manzana', -- sabado
	'leche light, manzana, avena, azucar, esencia de vainilla',
    'espagueti verde',  -- domingo
	'pasta de espagueti, brocoli, nata o crema, ajo, cilantro'
);

INSERT INTO rutinas VALUES (
	default,				-- id_rutina
    1,                      -- id_cliente
    1,                      -- id_profesional 
    'Rutina para tonificación muscular', 
    'ejercicio',            -- tiporutina
    'Pecho y tríceps',      -- lunes
	'Remo 3x10 y copa 3x15',
    'Espalda y bíceps',     -- martes
	'ejercicios de espalda y bíceps',
    'Cardio',               -- miercoles
	'Caminadora 30min.',
    'Piernas',              -- jueves
	'prensa 3x20',
    'Hombros y abdominales',-- viernes
	'abdominales 3x10 y ejercicio para hombro',
    'Descanso activo',      -- sabado
	'calentamiento',
    'Descanso',              -- domingo
	'descanso completo'
);


insert into solicitudes values(default,1,1,'dieta',default);

SELECT c.id_cliente, p.id_profesional,
            COALESCE(c.nombre, p.nombre) AS nombre, COALESCE(c.apellidos, p.apellidos) AS apellidos,
            COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario FROM Clientes c
            FULL OUTER JOIN Profesionales p ON 1=0 WHERE (c.email='mcano@gmail.com' AND c.contrasenia=sha224('8765'))
            or (p.email='mcano@gmail.com' AND p.contrasenia=sha224('8765'));

select * from clientes;

SELECT  id_profesional, nombre, apellidos, tipousuario, email from profesionales where tipousuario != 'admin      ';

-- ejecutar esto (ref pulpito){
-- Agrega columna "status" a Clientes
ALTER TABLE Clientes ADD COLUMN status BOOLEAN DEFAULT TRUE;
-- Agrega columna status a Profesionales
ALTER TABLE Profesionales ADD COLUMN status BOOLEAN DEFAULT TRUE;
-- Esto es para poner todos los status en true que estaban antes de la 
-- agregacion del campo status, creo que ni es necesario
UPDATE Clientes SET status = TRUE WHERE status IS NULL;
UPDATE Profesionales SET status = TRUE WHERE status IS NULL;
-- esto es para cambiar el tipo de dato y permita registrar clientes
-- con una entrada como esta: ... '74kg', '174cm', '32cm','35cm','67cm','45cm' ...
ALTER TABLE Clientes
ALTER COLUMN brazor TYPE varchar(5),
ALTER COLUMN brazoc TYPE varchar(5),
ALTER COLUMN pierna TYPE varchar(5);
--}

SELECT c.id_cliente, p.id_profesional,
            COALESCE(c.nombre, p.nombre) AS nombre, COALESCE(c.apellidos, p.apellidos) AS apellidos,
            COALESCE(c.tipousuario, p.tipousuario) AS tipoUsuario
			COALESCE(c.status, p.status) AS status 
			FROM Clientes c
            FULL OUTER JOIN Profesionales p ON 1=0 WHERE (c.email='lcardenas@gmail.com' AND c.contrasenia=sha224('1234'))
            or (p.email='lcardenas@gmail.com' AND p.contrasenia=sha224('1234'));
			
insert into Clientes values(default, 'Guadalupe Elizabeth', 'Camarena Castro', 'ecamarena@gmail.com', sha224('2345'), 21,
21,
    '74kg', '174cm', '32cm','35cm','67cm','45cm'
    'dieta',
    'femenino',
    'cliente'
);
