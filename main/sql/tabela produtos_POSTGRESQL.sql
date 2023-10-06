CREATE TABLE produtos
(
    id          serial NOT NULL,
    nome        character varying(350) NOT NULL,
    urlfoto     character varying(350),
    descricao   TEXT,
    CONSTRAINT produtos_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Chinelo','https://havaianas.com.br/dw/image/v2/BDDJ_PRD/on/demandware.static/-/Sites-havaianas-master/default/dw978a6e76/product-images/4001280_0031_HAVAIANAS%20TRADICIONAL_C.png','Este é o modelo que deu início à história de Havaianas e traduz a autenticidade da marca: para alguns é uma Havaianas com preço acessível; para muitos, representa um produto vintage que traz boas lembranças.');

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Carregador de Celular','https://imgs.ponto.com.br/1511673500/2xg.jpg','Os caregadores Turbo utilizam a tecnologia Quick Charge. Eles são capazes de carregar o seu aparelho até 4 vezes mais rápido. Esses carregadores trabalham com tensões e intensidades de corrente mais elevadas, levando mais energia ao mesmo tempo para a bateria do seu aparelho');    

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Almofada de cachorro','https://ae01.alicdn.com/kf/Sfedc4518d6514fa9832df0aa813ddab5q/Travesseiro-decorativo-em-forma-de-cachorro-3d-almofada-de-lance-com-algod-o-pp-interno-decora.jpg','Enchimento:	Algodão
Cor:	Multicolorido
Material:	Algodão
Composição:	100% Algodão
Não veja esse vídeo: http://bit.ly/3REDEW7');    

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Homem aranha da shopee','https://down-br.img.susercontent.com/file/br-11134207-23020-wzsw3fx0mzmv63','Boneco do Homem Aranha Miniatura em pelúcia velboa importada

Perfeito para quem carrega o seu super heróis no peito com muito orgulho. Um bonequinho bonito que seus filhos vão adorar. O brinquedo também é um presente perfeito para todos os fãs do Homem-Aranha.

Um bonequinho lindo e super legal do homem aranha. Ele é fofinho e apalpável com composição em 100% pelúcia velboa
Especificações:
Indicado para crianças acima de 12 meses');  

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Tênis de malha reciclado masculino preto','https://balenciaga.dam.kering.com/m/537620fbfd513896/Large-758483W2DG11090_F.jpg','• Sneaker
• Technical 3D knit
• Balenciaga logo at the edge of the toe and at back
• Contrasted logo printed on exterior
• Ribbed finishing
• Made in Italy
• Do not machine wash and wipe with a soft cloth
Material: 92% polyester, 8% elastane
Product ID: 758483W2DG11090');  

INSERT INTO produtos(nome, urlfoto, descricao) 
    VALUES ('Jogo de cartas Uno minimalista, Mattel, preto','https://m.media-amazon.com/images/I/61mnv5uW8GL._AC_SL1500_.jpg','Edição especial - visual completamente único
Minimalista - projetado com uma estética minimalista, esta versão é um ótimo presente para os colecionadores uno
Visual novo - visual totalmente novo, bonito e simplista idealizado pelo designer warleson oliveira
Jogo - o jogo é como o uno clássico, de 2 a 10 jogadores com 7 anos ou mais');  


    

