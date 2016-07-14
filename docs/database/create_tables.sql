CREATE TABLE crossknowledge.enderecos (
  id     INT AUTO_INCREMENT,
  rua    VARCHAR(90),
  numero INT,
  bairro VARCHAR(90),
  cidade VARCHAR(90),
  uf     VARCHAR(45),
  PRIMARY KEY (id)
)
  ENGINE = INNODB;

CREATE TABLE crossknowledge.pessoas (
id           INT NOT NULL,
nome         VARCHAR(45),
sobrenome    VARCHAR(45),
fk_enderecos INT,
PRIMARY KEY (id),
FOREIGN KEY (fk_enderecos)
REFERENCES enderecos (id)
ON DELETE NO ACTION
)
ENGINE = INNODB;



