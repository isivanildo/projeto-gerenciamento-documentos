CREATE DATABASE grupo_tiradentes;
CREATE TABLE documentos(id integer auto_increment primary key, arquivo varchar(200), nome_arquivo varchar(200),
tipo_atividade varchar(100), qtde_horas varchar(20), status_doc varchar(15), 
data_postado timestamp default current_timestamp, usuario integer);

CREATE TABLE usuario(id integer auto_increment primary key, usuario varchar(50));
INSERT INTO usuario(usuario) VALUES('Ivanildo Ferreira');

CREATE TABLE status_doc(id integer auto_increment primary key, status varchar(15));
INSERT INTO status_doc (status) VALUES
('Homologado'),
('Não-Homologado');

