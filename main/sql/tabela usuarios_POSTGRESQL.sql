CREATE TABLE usuarios
(
    id          serial NOT NULL,
    nome        character varying(350) NOT NULL,
    email       character varying(350) NOT NULL,
    senha       character varying(150) NOT NULL,
    CONSTRAINT  usuarios_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;