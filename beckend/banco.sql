DROP DATABASE if EXISTS stina_modas;
CREATE DATABASE stina_modas;
USE stina_modas;

CREATE TABLE pecas (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	cod INT NOT NULL,
	tipo VARCHAR(10) NOT NULL,
	cor VARCHAR (20) NOT NULL,
	marca VARCHAR (20) NOT NULL,
	tamanho VARCHAR (2048) NOT NULL,
	comprimento VARCHAR (20) NOT NULL,
	forma_compra VARCHAR (10) NULL,
	forma_venda VARCHAR (10) NULL,
	valor_custo DECIMAL (6,2) NULL,
	valor_pago  DECIMAL (6,2) NULL,
	valor_cheio DECIMAL (6,2) NULL,
	valor_venda DECIMAL (6,2) NULL,
	valor_prazo DECIMAL (6,2) NULL,
	valor_vista DECIMAL (6,2) NULL,
	parcelas INT NULL,
	desconto DECIMAL (5,2) NULL,
	data_compra DATE NULL,
	data_venda DATE NULL,
	descricao VARCHAR (70) NULL,
	med_ombro DECIMAL (3,1) NULL,
	med_busto DECIMAL (3,1) NULL,
	med_cintura DECIMAL (3,1) NULL,
	med_quadril DECIMAL (3,1) NULL,
	situacao VARCHAR (10) NOT NULL,
	UNIQUE (cod)
);

CREATE TABLE imagens (
	id INT PRIMARY KEY AUTO_INCREMENT,
	caminho VARCHAR (100) NULL,
	id_peca INT,

	FOREIGN KEY (id_peca) REFERENCES pecas (id)
);
