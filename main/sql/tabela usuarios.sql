CREATE TABLE usuarios
(
    id       INT             NOT NULL    AUTO_INCREMENT,
    nome     VARCHAR(350)    NOT NULL,
    email    VARCHAR(350)    NOT NULL,    
    senha    VARCHAR(150)    NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;