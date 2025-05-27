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
foreign key (id_Cliente) references Clientes(id_Cliente),
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

insert into solicitudes values (default,1,1,'dieta','');

select c.nombre, c.apellidos, c.Edad, c.genero, s.tipoRutina, p.nombre
from Clientes c join solicitudes s on c.id_Cliente=s.id_Cliente
join profesionales p on p.id_profesional=s.id_profesional; 
