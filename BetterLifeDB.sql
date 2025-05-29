CREATE TABLE PROFESIONALES (
	ID_PROFESIONAL SERIAL PRIMARY KEY,
	NOMBRE VARCHAR(50) NOT NULL,
	APELLIDOS VARCHAR(50) NOT NULL,
	EMAIL VARCHAR(100) NOT NULL,
	CONTRASENIA BYTEA NOT NULL,
	ESPECIALIDAD VARCHAR(30) NOT NULL,
	ENFOQUE VARCHAR(600) NOT NULL,
	ESLOGAN VARCHAR(150),
	TIPOUSUARIO CHAR(11) NOT NULL,
	STATUS BOOLEAN DEFAULT TRUE
);

CREATE TABLE CLIENTES (
	ID_CLIENTE SERIAL PRIMARY KEY,
	NOMBRE VARCHAR(50) NOT NULL,
	APELLIDOS VARCHAR(50) NOT NULL,
	EMAIL VARCHAR(100) NOT NULL,
	CONTRASENIA BYTEA NOT NULL,
	EDAD INT NOT NULL,
	PESO CHAR(5) NOT NULL,
	ESTATURA CHAR(5) NOT NULL,
	BRAZOR VARCHAR(5) NOT NULL,
	BRAZOC VARCHAR(5) NOT NULL,
	CINTURA CHAR(5) NOT NULL,
	PIERNA VARCHAR(5) NOT NULL,
	INTERESES VARCHAR(10) NOT NULL,
	GENERO VARCHAR(10) NOT NULL,
	TIPOUSUARIO CHAR(7) NOT NULL,
	STATUS BOOLEAN DEFAULT TRUE
);

CREATE TABLE RUTINAS (
	ID_RUTINA SERIAL PRIMARY KEY,
	ID_CLIENTE INT,
	ID_PROFESIONAL INT,
	DESCRIPCIONRUTINA VARCHAR(1000),
	TIPORUTINA VARCHAR(15),
	LUNES VARCHAR(100) NOT NULL,
	DETALLESL VARCHAR(200) NOT NULL,
	MARTES VARCHAR(100) NOT NULL,
	DETALLESM VARCHAR(200) NOT NULL,
	MIERCOLES VARCHAR(100) NOT NULL,
	DETALLESW VARCHAR(200) NOT NULL,
	JUEVES VARCHAR(100) NOT NULL,
	DETALLESJ VARCHAR(200) NOT NULL,
	VIERNES VARCHAR(100) NOT NULL,
	DETALLESV VARCHAR(200) NOT NULL,
	SABADO VARCHAR(100) NOT NULL,
	DETALLESS VARCHAR(200) NOT NULL,
	DOMINGO VARCHAR(100) NOT NULL,
	DETALLESD VARCHAR(200) NOT NULL,
	FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTES (ID_CLIENTE) ON DELETE CASCADE,
	FOREIGN KEY (ID_PROFESIONAL) REFERENCES PROFESIONALES (ID_PROFESIONAL) ON DELETE CASCADE
);

CREATE TABLE SOLICITUDES (
	ID_SOLICITUD SERIAL PRIMARY KEY,
	ID_CLIENTE INT NOT NULL,
	ID_PROFESIONAL INT NOT NULL,
	TIPORUTINA VARCHAR(15) NOT NULL,
	FECHA_SOLICITUD TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTES (ID_CLIENTE) ON DELETE CASCADE,
	FOREIGN KEY (ID_PROFESIONAL) REFERENCES PROFESIONALES (ID_PROFESIONAL) ON DELETE CASCADE
);

INSERT INTO
	PROFESIONALES
VALUES
	(
		DEFAULT,
		'Luis Manuel',
		'Cardenas Ibarra',
		'lcardenas@gmail.com',
		SHA224('1234'),
		'Nutriologo',
		'Control de peso y habitos saludables
Asesoria para enfermedades metabólicas',
		NULL,
		'profesional'
	);

INSERT INTO
	PROFESIONALES
VALUES
	(
		DEFAULT,
		'Alejandro',
		'Lezama Torres',
		'alezama@gmail.com',
		SHA224('5678'),
		'Entrenador',
		'Entrenamiento personalizado según objetivos (pérdida de peso, ganancia muscular, tonificación)
Rutinas especializadas para principiantes y avanzados
Preparación para competencias fitness y culturismo
Corrección de técnica y prevención de lesiones
Motivación y hábitos saludables para un cambio duradero',
		NULL,
		'profesional'
	);

INSERT INTO
	CLIENTES
VALUES
	(
		DEFAULT,
		'Jovanny',
		'Lobato Garcia',
		'jlobato@gmail.com',
		SHA224('4321'),
		21,
		'74kg',
		'174cm',
		'32cm',
		'35cm',
		'67cm',
		'45cm',
		'dieta',
		'masculino',
		'cliente'
	);

INSERT INTO
	PROFESIONALES
VALUES
	(
		DEFAULT,
		'Manuel',
		'Cano Zavala',
		'mcano@gmail.com',
		SHA224('8765'),
		'',
		'',
		NULL,
		'admin'
	);

INSERT INTO
	RUTINAS
VALUES
	(
		DEFAULT, -- id_Rutina
		1, -- id_cliente 
		1, -- id_profesional 
		'Rutina para pérdida de peso', -- descripcion
		'dieta', -- tiporutina
		'Sanwitch', -- lunes
		'Pan integra, jamon, crema, lechuga, jitomate, cebolla',
		'Ensalada', -- martes
		'Lechuga, aguacate, cebolla morada, jitomate',
		'yogur con fruta', -- miercoles
		'yogur natural, manzana picada, pera picada, fresa picada, avena',
		'pechuga rellena', -- jueves
		'pechuga de pollo, espinaca, queso, apio',
		'cereal', -- viernes
		'cereal integral, leche light',
		'Licuado de manzana', -- sabado
		'leche light, manzana, avena, azucar, esencia de vainilla',
		'espagueti verde', -- domingo
		'pasta de espagueti, brocoli, nata o crema, ajo, cilantro'
	);

INSERT INTO
	RUTINAS
VALUES
	(
		DEFAULT, -- id_rutina
		1, -- id_cliente
		1, -- id_profesional 
		'Rutina para tonificación muscular',
		'ejercicio', -- tiporutina
		'Pecho y triceps', -- lunes
		'Remo 3x10 y copa 3x15',
		'Espalda y biceps', -- martes
		'ejercicios de espalda y bíceps',
		'Cardio', -- miercoles
		'Caminadora 30min.',
		'Piernas', -- jueves
		'prensa 3x20',
		'Hombros y abdominales', -- viernes
		'abdominales 3x10 y ejercicio para hombro',
		'Descanso activo', -- sabado
		'calentamiento',
		'Descanso', -- domingo
		'descanso completo'
	);

INSERT INTO
	SOLICITUDES
VALUES
	(DEFAULT, 1, 1, 'dieta', DEFAULT);

SELECT
	C.ID_CLIENTE,
	P.ID_PROFESIONAL,
	COALESCE(C.NOMBRE, P.NOMBRE) AS NOMBRE,
	COALESCE(C.APELLIDOS, P.APELLIDOS) AS APELLIDOS,
	COALESCE(C.TIPOUSUARIO, P.TIPOUSUARIO) AS TIPOUSUARIO
FROM
	CLIENTES C
	FULL OUTER JOIN PROFESIONALES P ON 1 = 0
WHERE
	(
		C.EMAIL = 'mcano@gmail.com'
		AND C.CONTRASENIA = SHA224('8765')
	)
	OR (
		P.EMAIL = 'mcano@gmail.com'
		AND P.CONTRASENIA = SHA224('8765')
	);

SELECT  id_profesional, nombre, apellidos, tipousuario, email from profesionales where tipousuario != 'admin      ';

-- ejecutar esto (ref pulpito){
-- Agrega columna "status" a Clientes
ALTER TABLE CLIENTES
ADD COLUMN STATUS BOOLEAN DEFAULT TRUE;

-- Agrega columna status a Profesionales
ALTER TABLE PROFESIONALES
ADD COLUMN STATUS BOOLEAN DEFAULT TRUE;

-- Esto es para poner todos los status en true que estaban antes de la 
-- agregacion del campo status, creo que ni es necesario
UPDATE CLIENTES
SET
	STATUS = TRUE
WHERE
	STATUS IS NULL;

UPDATE PROFESIONALES
SET
	STATUS = TRUE
WHERE
	STATUS IS NULL;

-- esto es para cambiar el tipo de dato y permita registrar clientes
-- con una entrada como esta: ... '74kg', '174cm', '32cm','35cm','67cm','45cm' ...
ALTER TABLE CLIENTES
ALTER COLUMN BRAZOR TYPE VARCHAR(5),
ALTER COLUMN BRAZOC TYPE VARCHAR(5),
ALTER COLUMN PIERNA TYPE VARCHAR(5);

--}
SELECT
	C.ID_CLIENTE,
	P.ID_PROFESIONAL,
	COALESCE(C.NOMBRE, P.NOMBRE) AS NOMBRE,
	COALESCE(C.APELLIDOS, P.APELLIDOS) AS APELLIDOS,
	COALESCE(C.TIPOUSUARIO, P.TIPOUSUARIO) AS TIPOUSUARIO COALESCE(C.STATUS, P.STATUS) AS STATUS
FROM
	CLIENTES C
	FULL OUTER JOIN PROFESIONALES P ON 1 = 0
WHERE
	(
		C.EMAIL = 'lcardenas@gmail.com'
		AND C.CONTRASENIA = SHA224('1234')
	)
	OR (
		P.EMAIL = 'lcardenas@gmail.com'
		AND P.CONTRASENIA = SHA224('1234')
	);

INSERT INTO
	CLIENTES
VALUES
	(
		DEFAULT,
		'Guadalupe Elizabeth',
		'Camarena Castro',
		'ecamarena@gmail.com',
		SHA224('2345'),
		21,
		21,
		'74kg',
		'174cm',
		'32cm',
		'35cm',
		'67cm',
		'45cm' 'dieta',
		'femenino',
		'cliente'
	);

select * from rutinas;
