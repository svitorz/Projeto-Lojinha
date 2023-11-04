drop table administradores;

CREATE TABLE administradores
(
    id          serial NOT NULL,
    nome        character varying(350) NOT NULL,
    email       character varying(350) NOT NULL,
    senha       character varying(150) NOT NULL,
    ativo 	 	boolean	   NOT NULL,
    CONSTRAINT  administradores_pkey   PRIMARY KEY (id),
    CONSTRAINT  email_unico_admin     UNIQUE (email)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

insert into administradores (nome, email, senha, ativo) 
values ('Eder', 'epansani@gmail.com', crypt('123',gen_salt('bf', 8)), true)

select * from administradores;