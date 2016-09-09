CREATE TABLE enderecos
(
  id INT(11) PRIMARY KEY NOT NULL,
  rua VARCHAR(90),
  numero INT(11),
  bairro VARCHAR(90),
  cidade VARCHAR(90),
  uf VARCHAR(45)
);
CREATE TABLE pessoas
(
  id INT(11) PRIMARY KEY NOT NULL,
  nome VARCHAR(45),
  sobrenome VARCHAR(45),
  fk_enderecos INT(11),
  CONSTRAINT pessoas_ibfk_1 FOREIGN KEY (fk_enderecos) REFERENCES enderecos (id)
);
CREATE INDEX fk_enderecos ON pessoas (fk_enderecos);
CREATE UNIQUE INDEX pessoas_id_uindex ON pessoas (id);