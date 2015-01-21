
CREATE TABLE grupo (
                grupo_id INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(60) NOT NULL,
                descripcion VARCHAR(300) NOT NULL,
                peso INT NOT NULL,
                estado INT NOT NULL,
                PRIMARY KEY (grupo_id)
);


CREATE TABLE area (
                area_id INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(60) NOT NULL,
                descripcion VARCHAR(300) NOT NULL,
                peso INT NOT NULL,
                estado INT NOT NULL,
                PRIMARY KEY (area_id)
);


CREATE TABLE pregunta (
                pregunta_id INT AUTO_INCREMENT NOT NULL,
                id_excel VARCHAR(4) NOT NULL,
                pregunta_es VARCHAR(1000) NOT NULL,
                pregunta_us VARCHAR(1000) NOT NULL,
                imagen_es VARCHAR(100) NOT NULL,
                imagen_us VARCHAR(100) NOT NULL,
                respuesta VARCHAR(1) NOT NULL,
                opcion_aes VARCHAR(1000) NOT NULL,
                opcion_bes VARCHAR(1000) NOT NULL,
                opcion_ces VARCHAR(1000) NOT NULL,
                opcion_des VARCHAR(1000) NOT NULL,
                opcion_aus VARCHAR(1000) NOT NULL,
                opcion_bus VARCHAR(1000) NOT NULL,
                opcion_cus VARCHAR(1000) NOT NULL,
                opcion_dus VARCHAR(1000) NOT NULL,
                comentario_aes VARCHAR(1000) NOT NULL,
                comentario_bes VARCHAR(1000) NOT NULL,
                comentario_ces VARCHAR(1000) NOT NULL,
                comentario_des VARCHAR(1000) NOT NULL,
                comentario_aus VARCHAR(1000) NOT NULL,
                comentario_bus VARCHAR(1000) NOT NULL,
                comentario_cus VARCHAR(1000) NOT NULL,
                comentario_dus VARCHAR(1000) NOT NULL,
                nivel_dificultad VARCHAR(2) NOT NULL,
                estado INT NOT NULL,
                area_id INT NOT NULL,
                grupo_id INT NOT NULL,
                PRIMARY KEY (pregunta_id)
);


CREATE TABLE curso (
                curso_id INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(100) NOT NULL,
                estado VARCHAR(1) NOT NULL,
                PRIMARY KEY (curso_id)
);


CREATE TABLE ensayo (
                ensayo_id INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(100) NOT NULL,
                tipo INT NOT NULL,
                descripcion VARCHAR(200) NOT NULL,
                tiempo INT NOT NULL,
                intento INT NOT NULL,
                cant_preg INT NOT NULL,
                porc_aprobacion INT NOT NULL,
                estado INT NOT NULL,
                curso_id INT NOT NULL,
                PRIMARY KEY (ensayo_id)
);

ALTER TABLE ensayo MODIFY COLUMN tiempo INTEGER COMMENT '--minutos';


CREATE TABLE role (
                role_id INT AUTO_INCREMENT NOT NULL,
                descripcion VARCHAR(150) NOT NULL,
                estado INT NOT NULL,
                PRIMARY KEY (role_id)
);


CREATE TABLE usuario (
                usuario_id INT AUTO_INCREMENT NOT NULL,
                nombre VARCHAR(50) NOT NULL,
                apellidos VARCHAR(50) NOT NULL,
                username VARCHAR(15) NOT NULL,
                password VARCHAR(50) NOT NULL,
                estado INT NOT NULL,
                role_id INT NOT NULL,
                PRIMARY KEY (usuario_id)
);


CREATE TABLE simulacion (
                simulacion_id INT AUTO_INCREMENT NOT NULL,
                estado_sim INT NOT NULL,
                num_intento INT NOT NULL,
                puntaje DOUBLE PRECISION NOT NULL,
                punt_porcentual DOUBLE PRECISION NOT NULL,
                ensayo_id INT NOT NULL,
                usuario_id INT NOT NULL,
                restante INT NOT NULL,
                respondida INT NOT NULL,
                PRIMARY KEY (simulacion_id)
);


CREATE TABLE sim_resultado (
                sim_resultado_id INT AUTO_INCREMENT NOT NULL,
                revision VARCHAR(1) NOT NULL,
                respuesta INT NOT NULL,
                simulacion_id INT NOT NULL,
                pregunta_id INT NOT NULL,
                estado INT NOT NULL,
                PRIMARY KEY (sim_resultado_id)
);


ALTER TABLE pregunta ADD CONSTRAINT grupo_pregunta_fk
FOREIGN KEY (grupo_id)
REFERENCES grupo (grupo_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE pregunta ADD CONSTRAINT area_pregunta_fk
FOREIGN KEY (area_id)
REFERENCES area (area_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sim_resultado ADD CONSTRAINT pregunta_sim_resultado_fk
FOREIGN KEY (pregunta_id)
REFERENCES pregunta (pregunta_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE ensayo ADD CONSTRAINT cursos_ensayo_fk
FOREIGN KEY (curso_id)
REFERENCES curso (curso_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE simulacion ADD CONSTRAINT ensayo_simulacion_fk
FOREIGN KEY (ensayo_id)
REFERENCES ensayo (ensayo_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE usuario ADD CONSTRAINT perfil_usuario_fk
FOREIGN KEY (role_id)
REFERENCES role (role_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE simulacion ADD CONSTRAINT usuario_simulacion_fk
FOREIGN KEY (usuario_id)
REFERENCES usuario (usuario_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sim_resultado ADD CONSTRAINT simulacion_sim_resultado_fk
FOREIGN KEY (simulacion_id)
REFERENCES simulacion (simulacion_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
