CREATE TABLE categorias
(
    id          serial NOT NULL,
    nome        character varying(350) NOT NULL,        
    CONSTRAINT  categoria_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

INSERT INTO categorias(nome) 
    VALUES ('Vestuário');

INSERT INTO categorias(nome) 
    VALUES ('Eletrônicos');

INSERT INTO categorias(nome) 
    VALUES ('Brinquedos');     