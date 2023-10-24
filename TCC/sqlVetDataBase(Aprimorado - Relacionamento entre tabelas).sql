drop database VetDataBase;

create database VetDataBase;
use VetDataBase;


create table Funcoes
(
  idCargo int primary key not null,
  descricao varchar(50) not null
);
insert into Funcoes (idCargo, descricao)
values('1', 'Recepcionista'),
('2', 'Veterinário');


create table Usuarios
(
	idUsuario int auto_increment primary key not null,
	nome varchar (150) not null,
	email varchar (150) not null,
	contato varchar(20) not null,
    enderecoE varchar (2) not null,
    enderecoC varchar (50) not null,
    enderecoB varchar (50) not null,
    enderecoRN varchar (100) not null,
	idCargo int not null,
	foreign key (idCargo) references Funcoes(idCargo)
);
insert into  Usuarios (nome, email, contato, idCargo, enderecoE, enderecoC, enderecoB, enderecoRN)
values ('João Silva', 'joao@example.com', '1234567890', 2, 'SP', 'São Paulo', 'Jaguaré', 'Avenida Jaguaré, 125'),
('Marcos Silva', 'marcos@example.com', '0987654321', 2, 'SP', 'São Paulo', 'Jaguaré', 'Avenida Jaguaré, 125'),
('Gabriel Souza', 'gabriel@example.com', '9876543210', 1, 'SP', 'São Paulo', 'Santana', 'Praça Orlando Silva, 126');


create table Acesso(
	idAcesso int auto_increment primary key,
	loginusuario varchar(50) not null,
	senha varchar(150) not null,
	idUsuario int,
	foreign key (idUsuario) references Usuarios(idUsuario)
);
insert into Acesso (loginusuario, senha, idusuario)
values ('recep1', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS', 3),
('vet', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W', 1);	

	
create table Clientes
(
	idCliente int auto_increment primary key,
	nome varchar (150) not null,
	email varchar (150),
	contato varchar(20) not null,
    enderecoE varchar (2),
    enderecoC varchar (50),
    enderecoB varchar (50),
    enderecoRN varchar (100) 
);
insert into Clientes (nome, email, contato, enderecoE, enderecoC, enderecoB, enderecoRN)
values ('Leonardo Otávio Thomas', 'leonardo_otavio_moura@ddfnet.com.br', '(89) 35729023', 'SP', 'Mauá', 'Vila Noêmia', 'Rua Jasson Marques, 123' ),
('Carlos Eduardo Bento Yago', 'carlos-moura88@pp33.com.br', '(81) 99864-0599', 'SP', 'Mauá', 'Vila Noêmia', 'Rua Waldemar Rigout, 80' );

 
create table Animais
(
	idAnimal int auto_increment primary key,
	nome varchar(100) not null,
	especie varchar(50) not null,
	raca varchar(50) not null,
	datanascto date,
	idCliente int not null,
	foreign key (idCliente) references Clientes(idCliente) on delete cascade
);
insert into Animais (nome, especie, raca, datanascto, idCliente)
values ('Bumi', 'Cachorro', 'Golden Retriever', '2018-03-15', 1),
('Sett', 'Gato', 'Siamês', '2019-06-10', 2),
('Tico', 'Pássaro', 'Canário', '2020-02-01', 1),
('Faisca', 'Gato', 'Siamês', '2019-05-10', 2);

 
create table HistoricoMedico (
    idConsulta int,
    dataConsulta date not null,
    horaConsulta varchar(5) not null,
    veterinario int,
    peso varchar(10),
    temperatura varchar(10),
    diagnostico text,
    tratamento text,
    observacoes text,
    idAnimal int not null,
    foreign key (idAnimal) references Animais(idAnimal) on delete cascade
);
insert into HistoricoMedico (idConsulta, dataconsulta, horaConsulta, veterinario, peso, temperatura, diagnostico, tratamento, observacoes, idAnimal)
values (1, '2023-08-20', '13:00', 1, '3kg', '38°C', 'Exame físico normal', 'Nenhum tratamento necessário', 'Animal saudável', 1),
(2, '2023-08-18', '12:00', 1, '2kg','39°C',  'Verificou-se vermifugação necessária', 'Administrar vermífugo', 'Próxima dose em 6 meses', 2),
(3, '2023-09-18', '13:00', 1, '2,5kg', '39°C', 'Exame físico normal', 'Nenhum tratamento necessário', 'Animal saudável', 2),
(4, '2023-08-19', '15:00', 1, '3,5kg', '40°C', 'Infecção de ouvido', 'Prescrição de antibióticos', 'Retorno em uma semana para reavaliação', 3);


create table statusConsulta
(
	idStatus int primary key not null,
    statusConsulta varchar(50)
);
insert into StatusConsulta (idStatus, statusConsulta)
values (0, 'Ausente'),
(1, 'Em espera'),
(2, 'Consultório'),
(3, 'Liberado');
 

create table Agenda
(
	idConsulta int auto_increment primary key,
	dataConsulta date not null,
	horaConsulta varchar(5) not null, 
	veterinario int,
	descricao text,
	idAnimal int not null,
    idStatus int,
    foreign key (idStatus) references statusConsulta(idStatus),
	foreign key (idAnimal) references Animais(idAnimal) on delete cascade
);
insert into Agenda (dataConsulta, horaConsulta, veterinario, idAnimal, descricao, idStatus)
values ('2023-10-24', '14:00', 1, 1, 'Exame de rotina', 1),
('2023-10-24', '10:30', 1, 2, 'Vacinação', 2),
('2023-10-24', '10:30', 1, 4, 'Vacinação', 0),
('2023-08-18', '10:35', 1, 3, 'Avaliação de saúde', 1);


select * from Usuarios;
select * from Clientes;
select * from Animais;
select * from Agenda;
select * from HistoricoMedico;
select * from Acesso;
select * from statusConsulta;




