    CREATE TABLE produtos
    (
        id           INT             NOT NULL    AUTO_INCREMENT,
        nome         VARCHAR(150)    NOT NULL,
        urlfoto      VARCHAR(350)    NULL,    
        descricao    TEXT            NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

    INSERT INTO produtos(nome, urlfoto, descricao) 
        VALUES ('Chinelo','https://havaianas.com.br/dw/image/v2/BDDJ_PRD/on/demandware.static/-/Sites-havaianas-master/default/dw978a6e76/product-images/4001280_0031_HAVAIANAS%20TRADICIONAL_C.png','Este é o modelo que deu início à história de Havaianas e traduz a autenticidade da marca: para alguns é uma Havaianas com preço acessível; para muitos, representa um produto vintage que traz boas lembranças.');

    INSERT INTO produtos(nome, urlfoto, descricao) 
        VALUES ('Carregador De Celular','https://imgs.ponto.com.br/1511673500/2xg.jpg','Os caregadores Turbo utilizam a tecnologia Quick Charge 2.0. Eles são capazes de carregar o seu aparelho até 4 vezes mais rápido. Esses carregadores trabalham com tensões e intensidades de corrente mais elevadas, levando mais energia ao mesmo tempo para a bateria do seu aparelho');    